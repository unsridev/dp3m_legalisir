<?php

namespace Tests\Feature;

use App\Models\JenisLayanan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PengajuanTest extends TestCase
{
    use RefreshDatabase;

    public function test_cek_status_memerlukan_pasangan_nomor_antrean_dan_nim_yang_sesuai(): void
    {
        config(['services.recaptcha.enabled' => false]);
        $pengajuan = Pengajuan::factory()->create([
            'nomor_antrean' => 'LA202611100001',
            'nim' => '0012345',
            'status' => 'ditolak',
            'keterangan_status' => 'Tanggal wisuda perlu diperbaiki.',
        ]);

        $this->post(route('pengajuan.cek-status'), [
            'nomor_antrean' => $pengajuan->nomor_antrean,
            'nim' => '12345',
        ])->assertSessionHasErrorsIn('cekStatus', ['nomor_antrean'])
            ->assertSessionMissing('hasil_cek_status_id');

        $this->post(route('pengajuan.cek-status'), [
            'nomor_antrean' => strtolower($pengajuan->nomor_antrean),
            'nim' => $pengajuan->nim,
        ])->assertRedirectToRoute('pengajuan.status')
            ->assertSessionHas('hasil_cek_status_id', $pengajuan->id);

        $this->get(route('pengajuan.status'))->assertOk()
            ->assertSee($pengajuan->nomor_antrean)
            ->assertSee('Ditolak')
            ->assertSee('Tanggal wisuda perlu diperbaiki.')
            ->assertSee($pengajuan->nim)
            ->assertSee($pengajuan->nama_lengkap)
            ->assertSee($pengajuan->email)
            ->assertSee($pengajuan->whatsapp)
            ->assertSee($pengajuan->tanggal_wisuda->format('d/m/Y'))
            ->assertSee($pengajuan->keperluan)
            ->assertSee($pengajuan->jenisLayanan->nama)
            ->assertSee($pengajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i'));

        $this->get(route('pengajuan.status'))->assertOk()->assertDontSee($pengajuan->email);
    }

    public function test_cek_status_memverifikasi_recaptcha_sebelum_menampilkan_hasil(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.site_key' => 'uji-site',
            'services.recaptcha.secret_key' => 'uji-secret',
        ]);
        $pengajuan = Pengajuan::factory()->create(['nomor_antrean' => 'LA202611100001']);
        $form = ['nomor_antrean' => $pengajuan->nomor_antrean, 'nim' => $pengajuan->nim];
        $endpoint = 'https://www.google.com/recaptcha/api/siteverify';
        Http::fake([$endpoint => Http::sequence()
            ->push(['success' => false])
            ->push(['success' => true, 'hostname' => 'situs-lain.test'])
            ->push(['success' => true, 'hostname' => parse_url(route('home'), PHP_URL_HOST)])]);
        Http::preventStrayRequests();

        $this->get(route('pengajuan.status'))->assertOk()->assertSee('data-sitekey="uji-site"', false);
        $this->post(route('pengajuan.cek-status'), $form)
            ->assertSessionHasErrorsIn('cekStatus', ['g-recaptcha-response']);
        Http::assertNothingSent();

        foreach (['ditolak', 'hostname-berbeda'] as $token) {
            $this->post(route('pengajuan.cek-status'), $form + ['g-recaptcha-response' => $token])
                ->assertSessionHasErrorsIn('cekStatus', ['g-recaptcha-response'])
                ->assertSessionMissing('hasil_cek_status_id')
                ->assertSessionMissing('_old_input.g-recaptcha-response');
        }

        $this->post(route('pengajuan.cek-status'), $form + ['g-recaptcha-response' => 'valid'])
            ->assertSessionHas('hasil_cek_status_id', $pengajuan->id);
        Http::assertSent(fn ($request): bool => $request->url() === $endpoint
            && $request->data() === ['secret' => 'uji-secret', 'response' => 'valid']);
    }

    public function test_pengajuan_hanya_disimpan_setelah_recaptcha_valid(): void
    {
        config([
            'services.recaptcha.enabled' => true,
            'services.recaptcha.site_key' => 'uji-site',
            'services.recaptcha.secret_key' => 'uji-secret',
        ]);
        $data = $this->data(JenisLayanan::where('kode', 'LA')->firstOrFail());
        Http::fake(['https://www.google.com/recaptcha/api/siteverify' => Http::sequence()
            ->push(['success' => false])
            ->push(['success' => true, 'hostname' => parse_url(route('home'), PHP_URL_HOST)])]);
        Http::preventStrayRequests();

        $this->get(route('home'))->assertOk()
            ->assertDontSee('data-sitekey=', false)
            ->assertDontSee('Masuk admin');
        $this->get(route('pengajuan.create'))->assertOk()->assertSee('data-sitekey="uji-site"', false);
        $this->post(route('pengajuan.store'), $data)
            ->assertSessionHasErrors('g-recaptcha-response');
        Http::assertNothingSent();
        $this->post(route('pengajuan.store'), $data + ['g-recaptcha-response' => 'ditolak'])
            ->assertSessionHasErrors('g-recaptcha-response')
            ->assertSessionMissing('_old_input.g-recaptcha-response');
        $this->assertDatabaseEmpty('pengajuans');
        $this->assertDatabaseEmpty('urutan_antrean');

        $this->post(route('pengajuan.store'), $data + ['g-recaptcha-response' => 'valid'])
            ->assertRedirectToRoute('pengajuan.sukses');
        $this->assertDatabaseCount('pengajuans', 1);
    }

    public function test_nomor_antrean_berurutan_per_layanan_dan_berganti_pada_tengah_malam_wib(): void
    {
        $this->travelTo(now('Asia/Jakarta')->setDate(2026, 11, 10)->setTime(23, 59));
        $akreditasi = JenisLayanan::where('kode', 'LA')->firstOrFail();
        $ijazah = JenisLayanan::factory()->create(['kode' => 'LI']);

        $this->post(route('pengajuan.store'), $this->data($akreditasi))
            ->assertRedirectToRoute('pengajuan.sukses');
        $this->get(route('pengajuan.sukses'))
            ->assertOk()
            ->assertSee('LA202611100001')
            ->assertSee('Dalam antrian');

        $this->post(route('pengajuan.store'), $this->data($akreditasi))
            ->assertSessionHas('nomor_antrean', 'LA202611100002');
        $this->post(route('pengajuan.store'), $this->data($ijazah))
            ->assertSessionHas('nomor_antrean', 'LI202611100001');

        $this->travel(1)->minute();

        $this->post(route('pengajuan.store'), $this->data($akreditasi))
            ->assertSessionHas('nomor_antrean', 'LA202611110001');

        $this->assertDatabaseHas('pengajuans', [
            'nomor_antrean' => 'LA202611110001',
            'nim' => '0012345',
            'status' => 'dalam_antrean',
        ]);
    }

    public function test_layanan_nonaktif_dan_data_tidak_valid_ditolak(): void
    {
        $layanan = JenisLayanan::factory()->create(['aktif' => false]);

        $this->post(route('pengajuan.store'), array_replace($this->data($layanan), [
            'email' => 'bukan-email',
            'tanggal_wisuda' => '2026-02-30',
            'whatsapp' => 'bukan nomor',
        ]))->assertSessionHasErrors(['jenis_layanan_id', 'email', 'tanggal_wisuda', 'whatsapp']);

        $this->assertDatabaseEmpty('pengajuans');
        $this->assertDatabaseEmpty('urutan_antrean');
    }

    public function test_antrean_penuh_mempertahankan_format_empat_digit(): void
    {
        $layanan = JenisLayanan::where('kode', 'LA')->firstOrFail();

        $this->seedNomorTerakhir($layanan, 9998);

        $this->post(route('pengajuan.store'), $this->data($layanan))
            ->assertSessionHas('nomor_antrean', 'LA'.now('Asia/Jakarta')->format('Ymd').'9999');

        $this->post(route('pengajuan.store'), $this->data($layanan))
            ->assertSessionHasErrors('jenis_layanan_id');

        $this->assertDatabaseCount('pengajuans', 1);
    }

    public function test_admin_dapat_masuk_melihat_pengajuan_dan_mengubah_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $pengajuan = Pengajuan::factory()->create();

        $this->get(route('admin.pengajuan.index'))->assertRedirectToRoute('login');
        $this->get(route('login'))->assertOk();
        $this->post(route('admin.login'), ['email' => $admin->email, 'password' => 'password'])
            ->assertRedirectToRoute('admin.pengajuan.index');

        $this->get(route('admin.pengajuan.index'))->assertOk()->assertSee($pengajuan->nomor_antrean);
        $this->get(route('admin.pengajuan.show', $pengajuan))->assertOk()->assertSee($pengajuan->email);

        foreach (['diproses', 'selesai', 'ditolak'] as $status) {
            $this->patch(route('admin.pengajuan.update', $pengajuan), [
                'status' => $status,
                'keterangan_status' => 'Catatan untuk pemohon.',
            ])
                ->assertRedirectToRoute('admin.pengajuan.show', $pengajuan);
            $this->assertDatabaseHas('pengajuans', [
                'id' => $pengajuan->id,
                'status' => $status,
                'keterangan_status' => 'Catatan untuk pemohon.',
            ]);
        }

        $this->patch(route('admin.pengajuan.update', $pengajuan), ['status' => 'tidak-valid'])
            ->assertSessionHasErrors('status');
        $this->post(route('admin.logout'))->assertRedirectToRoute('login');
        $this->assertGuest();
    }

    public function test_pengguna_biasa_tidak_dapat_mengakses_panel_admin(): void
    {
        $pengguna = User::factory()->create();

        $this->post(route('admin.login'), ['email' => $pengguna->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');

        $this->actingAs($pengguna)->get(route('admin.pengajuan.index'))->assertForbidden();
        $this->post(route('admin.jenis-layanan.store'), ['nama' => 'Layanan baru', 'kode' => 'LB'])
            ->assertForbidden();
    }

    public function test_jenis_layanan_yang_dikelola_admin_memperbarui_pilihan_formulir(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->get(route('admin.jenis-layanan.index'))->assertOk()->assertSee('Legalisir Akreditasi');

        $this->post(route('admin.jenis-layanan.store'), ['nama' => 'Legalisir Ijazah', 'kode' => 'li'])
            ->assertRedirectToRoute('admin.jenis-layanan.index');
        $layanan = JenisLayanan::where('kode', 'LI')->firstOrFail();

        $this->get(route('home'))->assertSee('Legalisir Ijazah');
        $this->get(route('pengajuan.create', ['layanan' => 'LI']))
            ->assertOk()
            ->assertSee('value="'.$layanan->id.'" selected', false);

        $this->patch(route('admin.jenis-layanan.update', $layanan), [
            'nama' => 'Legalisir Salinan Ijazah',
            'aktif' => false,
        ])->assertSessionHasNoErrors();

        $this->get(route('home'))->assertDontSee('Legalisir Salinan Ijazah');
        $this->get(route('pengajuan.create'))->assertDontSee('Legalisir Salinan Ijazah');
        $this->assertDatabaseHas('jenis_layanans', ['id' => $layanan->id, 'aktif' => false]);
    }

    private function data(JenisLayanan $layanan): array
    {
        return [
            'jenis_layanan_id' => $layanan->id,
            'nim' => '0012345',
            'nama_lengkap' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'whatsapp' => '081234567890',
            'tanggal_wisuda' => '2026-09-10',
            'keperluan' => 'Melengkapi dokumen lamaran.',
        ];
    }

    private function seedNomorTerakhir(JenisLayanan $layanan, int $urutan): void
    {
        DB::table('urutan_antrean')->insert([
            'jenis_layanan_id' => $layanan->id,
            'tanggal' => now('Asia/Jakarta')->toDateString(),
            'urutan' => $urutan,
        ]);
    }
}
