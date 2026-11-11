@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 style="font-weight: 700;">Data Laporan</h3>
    
    <div>
    <style>
    .btn-export {
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-export:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(46, 204, 113, 0.3);
        color: white;
    }
</style>



       
    </div>
</div>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: transparent; padding: 0;">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
    </nav>
</div>
<a href="/admin/laporan/export" 
   onclick="this.innerHTML='<i class=\'fas fa-spinner fa-spin\'></i> Generating...'; setTimeout(()=>location.reload(), 3000);"
   class="btn btn-success" 
   style="border-radius: 12px; font-weight: 600; padding: 10px 20px; background: #27ae60; border: none;">
    <i class="fas fa-file-excel mr-2"></i> Download XLSX
</a>
<br><br>
<div class="card" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
    <div class="card-body" style="padding: 0;">
        <table class="table table-hover" style="margin-bottom: 0;">
            <thead style="background: #fcfcfc; border-bottom: 2px solid #f1f1f1;">
                <tr>
                    <th style="padding: 20px; color: #888; font-weight: 600;">KODE</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">KLASIFIKASI</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">KATEGORI</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">JUDUL</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">PELAPOR</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">UNIT</th>
                    <th style="padding: 20px; color: #888; font-weight: 600;">STATUS</th>
                    <th style="padding: 20px; color: #888; font-weight: 600; text-align: center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr style="border-bottom: 1px solid #f9f9f9;">
                    <td style="padding: 20px; font-weight: 600; color: #e74c3c;">#{{ $d->kode_tiket }}</td>
                    <td style="padding: 20px;">{{ $d->klasifikasi }}</td>
                    <td style="padding: 20px;">{{ $d->kategori }}</td>
                    <td style="padding: 20px;">{{ $d->judul_laporan }}</td>
                    <td style="padding: 20px; color: #666;">{{ $d->nama_pelapor }}</td>
                    <td style="padding: 20px;">{{ $d->unit_kerja }}</td>
                    <td style="padding: 20px;">
                        @php
                            $badgeColor = ['baru' => '#ffb822', 'proses' => '#36a3f7', 'selesai' => '#34bfa3'];
                            $color = $badgeColor[$d->status] ?? '#999';
                        @endphp
                        <span class="badge" style="background-color: {{ $color }}; color: #fff; padding: 6px 12px; border-radius: 20px; font-weight: 500; text-transform: uppercase; font-size: 10px;">
                            {{ $d->status }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: center;">
                        <a href="/admin/laporan/{{ $d->id }}" class="btn btn-light btn-sm" style="border-radius: 10px; border: 1px solid #eee; transition: 0.3s;">
                            <i class="fas fa-eye text-muted"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection