@extends('layouts.frontend')

@section('title', 'Pengajuan diterima')
@section('main-class', 'main form-page')

@section('content')
    <section class="intro">
        <h1>Pengajuan diterima</h1>
        <p>Unduh bukti pengajuan untuk menyimpan nomor antrean dan data pengajuan Anda.</p>
    </section>

    <section class="card">
        <dl class="fields">
            <div>
                <dt>Nomor antrean</dt>
                <dd class="ticket">{{ $pengajuan->nomor_antrean }}</dd>
            </div>
            <div>
                <dt>Status</dt>
                <dd><span class="badge badge-{{ $pengajuan->status }}">{{ \App\Models\Pengajuan::STATUS[$pengajuan->status] }}</span></dd>
            </div>
            <div><dt>Jenis Layanan</dt><dd>{{ $pengajuan->jenisLayanan->nama }}</dd></div>
            <div><dt>Tanggal Pengajuan (WIB)</dt><dd>{{ $pengajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</dd></div>
            @include('info.detail-pemohon')
        </dl>
        <div class="receipt-actions">
            <a class="button" href="{{ route('pengajuan.bukti') }}">Unduh bukti PDF</a>
            <a class="button secondary" href="{{ route('pengajuan.create') }}">Kembali ke formulir</a>
            <a class="button secondary" href="{{ route('pengajuan.status') }}">Cek status</a>
        </div>
    </section>
@endsection
