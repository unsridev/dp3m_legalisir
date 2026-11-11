<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use App\Models\Pengajuan;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanPengajuanController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $this->filter($request);
        $query = $this->pengajuan($filter);
        $jumlahPerStatus = (clone $query)->toBase()
            ->select('status')->selectRaw('COUNT(*) AS jumlah')
            ->groupBy('status')->pluck('jumlah', 'status');

        return view('admin.laporan.pengajuan', [
            'filter' => $filter,
            'layanan' => JenisLayanan::orderBy('nama')->get(['id', 'nama']),
            'status' => Pengajuan::STATUS,
            'jumlahPerStatus' => $jumlahPerStatus,
            'total' => $jumlahPerStatus->sum(),
            'pengajuan' => $query->orderByDesc('id')->paginate(20)->appends($filter),
        ]);
    }

    public function export(Request $request): StreamedResponse
    {
        $query = $this->pengajuan($this->filter($request));

        return response()->streamDownload(function () use ($query): void {
            $csv = fopen('php://output', 'w');
            fwrite($csv, "\xEF\xBB\xBF");
            fputcsv($csv, ['Nomor antrean', 'NIM', 'Nama lengkap', 'Jenis layanan', 'Diajukan (WIB)', 'Status'], escape: '');

            foreach ($query->lazyByIdDesc(500) as $ajuan) {
                $row = [
                    $ajuan->nomor_antrean,
                    $ajuan->nim,
                    $ajuan->nama_lengkap,
                    $ajuan->jenisLayanan->nama,
                    $ajuan->created_at->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    Pengajuan::STATUS[$ajuan->status],
                ];

                fputcsv($csv, array_map(
                    fn (string $value): string => preg_match('/^[\s\x00-\x1f]*[=+\-@]|^[\t\r\n]/u', $value) ? "'".$value : $value,
                    $row,
                ), escape: '');
            }

            fclose($csv);
        }, 'laporan-legalisir-'.now('Asia/Jakarta')->format('Y-m-d').'.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'private, no-store',
        ]);
    }

    private function filter(Request $request): array
    {
        $validator = Validator::make($request->query(), [
            'mulai' => ['nullable', 'date_format:Y-m-d'],
            'sampai' => ['nullable', 'date_format:Y-m-d', Rule::when($request->filled('mulai'), 'after_or_equal:mulai')],
            'jenis_layanan_id' => ['nullable', 'integer', Rule::exists('jenis_layanans', 'id')],
            'status' => ['nullable', Rule::in(array_keys(Pengajuan::STATUS))],
        ], [
            'mulai.date_format' => 'Tanggal awal tidak valid.',
            'sampai.date_format' => 'Tanggal akhir tidak valid.',
            'sampai.after_or_equal' => 'Tanggal akhir harus sama dengan atau sesudah tanggal awal.',
            'jenis_layanan_id.exists' => 'Pilih jenis layanan yang tersedia.',
            'status.in' => 'Pilih status pengajuan yang tersedia.',
        ]);

        if ($validator->fails()) {
            throw (new ValidationException($validator))->redirectTo(route('admin.laporan'));
        }

        return array_filter($validator->validated(), fn (mixed $value): bool => $value !== null);
    }

    /** @return Builder<Pengajuan> */
    private function pengajuan(array $filter): Builder
    {
        $query = Pengajuan::query()
            ->select('id', 'jenis_layanan_id', 'nomor_antrean', 'nim', 'nama_lengkap', 'created_at', 'status')
            ->with('jenisLayanan:id,nama');

        if (isset($filter['mulai'])) {
            $mulai = CarbonImmutable::createFromFormat('!Y-m-d', $filter['mulai'], 'Asia/Jakarta');
            $query->where('created_at', '>=', $mulai->setTimezone(config('app.timezone')));
        }

        if (isset($filter['sampai'])) {
            $sampai = CarbonImmutable::createFromFormat('!Y-m-d', $filter['sampai'], 'Asia/Jakarta')->addDay();
            $query->where('created_at', '<', $sampai->setTimezone(config('app.timezone')));
        }

        foreach (['jenis_layanan_id', 'status'] as $kolom) {
            if (isset($filter[$kolom])) {
                $query->where($kolom, $filter[$kolom]);
            }
        }

        return $query;
    }
}
