<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{

protected $table = 'laporan';

protected $fillable = [
'kode_tiket',
'klasifikasi',
'kategori',
'nama_pelapor',
'alamat',
'email',
'no_hp',
'file_identitas',
'file_badan_hukum',
'judul_laporan',
'isi_laporan',
'tanggal_kejadian',
'lokasi_kejadian',
'unit_kerja',
'status'
];

}