<?php

namespace Tests\Feature;

use App\Models\JenisLayanan;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaporanPengajuanTest extends TestCase
{
    use RefreshDatabase;

    public function test_laporan_dan_csv_memakai_filter_yang_sama_dengan_batas_hari_wib(): void
    {
        $layanan = JenisLayanan::factory()->create();
        $pengajuan = Pengajuan::factory()->create([
            'jenis_layanan_id' => $layanan->id,
            'nama_lengkap' => '=1+1',
            'status' => 'selesai',
            'created_at' => '2026-11-10 17:00:00',
        ]);
        $sebelumnya = Pengajuan::factory()->create([
            'jenis_layanan_id' => $layanan->id,
            'status' => 'selesai',
            'created_at' => '2026-11-10 16:59:59',
        ]);
        $besok = Pengajuan::factory()->create([
            'jenis_layanan_id' => $layanan->id,
            'status' => 'selesai',
            'created_at' => '2026-11-11 17:00:00',
        ]);
        $statusLain = Pengajuan::factory()->create([
            'jenis_layanan_id' => $layanan->id,
            'status' => 'diproses',
            'created_at' => '2026-11-11 16:59:59',
        ]);
        $layananLain = Pengajuan::factory()->create([
            'status' => 'selesai',
            'created_at' => '2026-11-11 16:59:59',
        ]);

        $filter = [
            'mulai' => '2026-11-11',
            'sampai' => '2026-11-11',
            'jenis_layanan_id' => $layanan->id,
            'status' => 'selesai',
        ];

        $this->actingAs(User::factory()->create(['is_admin' => true]));
        $laporan = $this->get(route('admin.laporan', $filter))->assertOk()
            ->assertViewHas('total', 1)
            ->assertSee($pengajuan->nomor_antrean)
            ->assertSee(route('admin.laporan.export', $filter));

        $csv = $this->get(route('admin.laporan.export', $filter))->assertOk()
            ->assertHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->streamedContent();

        $this->assertStringContainsString($pengajuan->nomor_antrean, $csv);
        $this->assertStringContainsString("'=1+1", $csv);
        $this->assertStringContainsString('2026-11-11 00:00:00', $csv);

        foreach ([$sebelumnya, $besok, $statusLain, $layananLain] as $diLuarFilter) {
            $laporan->assertDontSee($diLuarFilter->nomor_antrean);
            $this->assertStringNotContainsString($diLuarFilter->nomor_antrean, $csv);
        }
    }

    public function test_laporan_dan_csv_hanya_bisa_diakses_admin(): void
    {
        $this->get(route('admin.laporan'))->assertRedirectToRoute('login');
        $this->get(route('admin.laporan.export'))->assertRedirectToRoute('login');

        $this->actingAs(User::factory()->create());
        $this->get(route('admin.laporan'))->assertForbidden();
        $this->get(route('admin.laporan.export'))->assertForbidden();
    }

    public function test_periode_terbalik_ditolak(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->get(route('admin.laporan', ['mulai' => '2026-11-11', 'sampai' => '2026-11-10']))
            ->assertRedirectToRoute('admin.laporan')
            ->assertSessionHasErrors('sampai');
    }
}
