<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use App\Models\Pengajuan;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function index(): View
    {
        return view('info.beranda', [
            'layanan' => JenisLayanan::where('aktif', true)->orderBy('nama')->get(['nama', 'kode']),
        ]);
    }

    public function status(Request $request): Response
    {
        $id = $request->session()->pull('hasil_cek_status_id');
        $pengajuan = $id === null ? null : Pengajuan::with('jenisLayanan:id,nama')->find($id);

        return response()->view('info.cek-status', compact('pengajuan'))
            ->header('Cache-Control', 'private, no-store');
    }

    public function cekStatus(Request $request): RedirectResponse
    {
        $kembali = to_route('pengajuan.status');
        $captchaAktif = config('services.recaptcha.enabled');
        $input = [
            'nomor_antrean' => strtoupper($request->string('nomor_antrean', strict: true)->toString()),
            'nim' => $request->string('nim', strict: true)->toString(),
        ];
        $rules = [
            'nomor_antrean' => ['required', 'regex:/^[A-Z]{1,8}[0-9]{12}$/D'],
            'nim' => ['required', 'string', 'max:30'],
        ];

        if ($captchaAktif) {
            $rules['g-recaptcha-response'] = ['required', 'string', 'max:4096'];
        }

        $validator = Validator::make($input + $request->only('g-recaptcha-response'), $rules, [
            'nomor_antrean.required' => 'Masukkan nomor antrean.',
            'nomor_antrean.regex' => 'Format nomor antrean tidak valid.',
            'nim.required' => 'Masukkan NIM.',
            'nim.max' => 'NIM maksimal 30 karakter.',
            'g-recaptcha-response.*' => 'Silakan selesaikan reCAPTCHA terlebih dahulu.',
        ]);

        if ($validator->fails()) {
            return $kembali->withErrors($validator, 'cekStatus')->withInput($input);
        }

        if ($captchaAktif && ! $this->verifikasiCaptcha($validator->validated()['g-recaptcha-response'], $request->getHost())) {
            return $kembali->withErrors([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ], 'cekStatus')->withInput($input);
        }

        $pengajuan = Pengajuan::where('nomor_antrean', $input['nomor_antrean'])
            ->first(['id', 'nim']);

        if (! $pengajuan || $pengajuan->nim !== $input['nim']) {
            return $kembali->withErrors([
                'nomor_antrean' => 'Pengajuan tidak ditemukan. Periksa kembali nomor antrean dan NIM.',
            ], 'cekStatus')->withInput($input);
        }

        return $kembali->with('hasil_cek_status_id', $pengajuan->id);
    }

    private function verifikasiCaptcha(string $token, string $hostname): bool
    {
        $secret = config('services.recaptcha.secret_key');
        $kunciUjiGoogle = $secret === '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

        if (blank($secret) || ($kunciUjiGoogle && (! app()->isLocal() || $hostname !== 'akreditasi.test'))) {
            return false;
        }

        try {
            $response = Http::asForm()->connectTimeout(3)->timeout(5)
                ->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $secret,
                    'response' => $token,
                ]);
        } catch (ConnectionException) {
            return false;
        }

        return $response->successful()
            && $response->json('success') === true
            && $response->json('hostname') === ($kunciUjiGoogle ? 'testkey.google.com' : $hostname);
    }

    public function create(Request $request): View
    {
        return view('info.form', [
            'layanan' => JenisLayanan::where('aktif', true)->orderBy('nama')->get(),
            'kodeLayanan' => $request->query('layanan'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'jenis_layanan_id' => ['required', 'integer', Rule::exists('jenis_layanans', 'id')->where('aktif', true)],
            'nim' => ['required', 'string', 'max:30'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:25', 'regex:/^\+?[0-9][0-9 ()-]*$/'],
            'tanggal_wisuda' => ['required', 'date_format:Y-m-d'],
            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => 'Masukkan alamat email yang valid.',
            'whatsapp.regex' => 'Masukkan nomor WhatsApp yang valid.',
            'jenis_layanan_id.exists' => 'Jenis layanan tersebut tidak tersedia.',
            'tanggal_wisuda.date_format' => 'Masukkan tanggal wisuda yang valid.',
            'max.string' => ':attribute maksimal :max karakter.',
        ], [
            'jenis_layanan_id' => 'Jenis layanan',
            'nim' => 'NIM',
            'nama_lengkap' => 'Nama lengkap',
            'email' => 'Email aktif',
            'whatsapp' => 'No. WhatsApp',
            'tanggal_wisuda' => 'Tanggal wisuda',
            'keperluan' => 'Keperluan',
        ]);

        if (config('services.recaptcha.enabled')) {
            $captcha = $request->validate([
                'g-recaptcha-response' => ['required', 'string', 'max:4096'],
            ], [
                'g-recaptcha-response.*' => 'Silakan selesaikan reCAPTCHA terlebih dahulu.',
            ]);

            if (! $this->verifikasiCaptcha($captcha['g-recaptcha-response'], $request->getHost())) {
                throw ValidationException::withMessages([
                    'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
                ]);
            }
        }

        $tanggal = now('Asia/Jakarta');

        $layanan = JenisLayanan::findOrFail($data['jenis_layanan_id']);

        $pengajuan = DB::transaction(function () use ($data, $tanggal, $layanan): Pengajuan {
            $kunci = ['jenis_layanan_id' => $layanan->id, 'tanggal' => $tanggal->toDateString()];

            DB::table('urutan_antrean')->upsert($kunci, ['jenis_layanan_id', 'tanggal'], ['tanggal']);
            $antrean = DB::table('urutan_antrean')->where($kunci);

            if (! $antrean->where('urutan', '<', 9999)->increment('urutan')) {
                throw ValidationException::withMessages([
                    'jenis_layanan_id' => 'Antrean layanan ini penuh untuk hari ini. Silakan ajukan kembali besok.',
                ]);
            }

            $urutan = DB::table('urutan_antrean')->where($kunci)->value('urutan');

            return Pengajuan::create($data + [
                'nomor_antrean' => sprintf('%s%s%04d', $layanan->kode, $tanggal->format('Ymd'), $urutan),
            ]);
        }, 5);

        return to_route('pengajuan.sukses')->with('nomor_antrean', $pengajuan->nomor_antrean);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $nomorAntrean = $request->session()->get('nomor_antrean');

        return $nomorAntrean
            ? view('info.sukses', compact('nomorAntrean'))
            : to_route('home');
    }
}
