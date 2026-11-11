<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    use HasFactory;

    public const STATUS = [
        'dalam_antrean' => 'Dalam antrian',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];

    public const KETERANGAN_STATUS = [
        'dalam_antrean' => 'Pengajuan diterima dan menunggu pemeriksaan petugas.',
        'diproses' => 'Petugas sedang memeriksa atau memproses pengajuan.',
        'selesai' => 'Proses pengajuan legalisir sudah selesai.',
        'ditolak' => 'Pengajuan ditolak oleh petugas.',
    ];

    protected $fillable = [
        'jenis_layanan_id', 'nomor_antrean', 'nim', 'nama_lengkap',
        'email', 'whatsapp', 'tanggal_wisuda', 'keperluan', 'status', 'keterangan_status',
    ];

    protected $attributes = ['status' => 'dalam_antrean'];

    public function jenisLayanan(): BelongsTo
    {
        return $this->belongsTo(JenisLayanan::class);
    }

    protected function casts(): array
    {
        return ['tanggal_wisuda' => 'date'];
    }
}
