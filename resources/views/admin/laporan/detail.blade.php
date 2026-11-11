@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="/admin/laporan" class="btn btn-link p-0 text-decoration-none text-muted mb-2">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
    <h3 style="font-weight: 700;">Detail Laporan <span class="text-danger">#{{ $data->kode_tiket }}</span></h3>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 30px;">
            <div class="card-body" style="padding: 30px;">
                <h5 style="font-weight: 700; border-bottom: 2px solid #f4f7f6; padding-bottom: 15px; margin-bottom: 20px;">Informasi Kejadian</h5>
                
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Judul Laporan</div>
                    <div class="col-sm-8" style="font-weight: 600;">{{ $data->judul_laporan }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Isi Laporan</div>
                    <div class="col-sm-8" style="line-height: 1.6;">{!! nl2br(e($data->isi_laporan)) !!}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 text-muted">Lokasi & Tanggal</div>
                    <div class="col-sm-8">{{ $data->lokasi_kejadian }} | {{ $data->tanggal_kejadian }}</div>
                </div>
                
                <h5 style="font-weight: 700; border-bottom: 2px solid #f4f7f6; padding-bottom: 15px; margin-top: 40px; margin-bottom: 20px;">Data Pelapor</h5>
                
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="30%">Nama Lengkap</td>
                        <td style="font-weight: 600;">{{ $data->nama_pelapor }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ $data->email }} </td>
                    </tr>
                    <tr>
                        <td class="text-muted">HP</td>
                        <td> {{ $data->no_hp }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat</td>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                </table>

                <div class="mt-4">
                    <p class="text-muted mb-2">Lampiran Berkas:</p>
                    @if($data->file_identitas)
                        <a href="{{ asset('storage/'.$data->file_identitas) }}" target="_blank" class="btn btn-outline-primary btn-sm mr-2" style="border-radius: 8px;">
                            <i class="fas fa-id-card"></i> Identitas
                        </a>
                    @endif
                    @if($data->file_badan_hukum)
                        <a href="{{ asset('storage/'.$data->file_badan_hukum) }}" target="_blank" class="btn btn-outline-primary btn-sm" style="border-radius: 8px;">
                            <i class="fas fa-gavel"></i> Badan Hukum
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card" style="border: none; border-radius: 15px; background: #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
            <div class="card-body" style="padding: 25px;">
                <h5 style="font-weight: 700; margin-bottom: 20px;">Status Saat Ini</h5>
                
                <div class="text-center p-4 mb-4" style="background: #f8f9fa; border-radius: 12px;">
                    <span class="badge" style="background: #36a3f7; font-size: 14px; padding: 10px 20px; border-radius: 30px;">
                        {{ strtoupper($data->status) }}
                    </span>
                </div>

                <form method="POST" action="/admin/laporan/status/{{ $data->id }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="small text-muted font-weight-bold">UBAH STATUS</label>
                        <select name="status" class="form-control" style="border-radius: 10px; border: 1px solid #eee; height: 45px;">
                            <option value="baru" {{ $data->status=='baru'?'selected':'' }}>Baru</option>
                            <option value="proses" {{ $data->status=='proses'?'selected':'' }}>Diproses</option>
                            <option value="selesai" {{ $data->status=='selesai'?'selected':'' }}>Selesai</option>
                        </select>
                    </div>
                    <button class="btn btn-danger w-100" style="border-radius: 10px; padding: 12px; font-weight: 600; box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3);">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection