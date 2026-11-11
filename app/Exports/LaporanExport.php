<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Laporan::select('kode_tiket', 'klasifikasi', 'kategori', 'judul_laporan', 'nama_pelapor', 'unit_kerja', 'status')->get();
    }

    public function headings(): array
    {
        return [
            'KODE TIKET',
            'KLASIFIKASI',
            'KATEGORI',
            'JUDUL LAPORAN',
            'NAMA PELAPOR',
            'UNIT KERJA',
            'STATUS'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Tebalkan header (baris 1)
            1 => ['font' => ['bold' => true]],
        ];
    }
}