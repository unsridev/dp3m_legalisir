@extends('layouts.frontend')

@section('title', 'Pengajuan diterima')

@section('content')
    <section class="intro">
        <h1>Pengajuan diterima</h1>
        <p>Simpan nomor antrian ini sebagai bukti pengajuan.</p>
    </section>

    <section class="card receipt">
        <dl>
            <dt>Nomor antrian</dt>
            <dd class="ticket">{{ $nomorAntrean }}</dd>
            <dt>Status</dt>
            <dd><span class="badge">Dalam antrian</span></dd>
        </dl>
        <a class="button" href="{{ route('pengajuan.create') }}">Kembali ke formulir</a>
        <a class="button secondary" href="{{ route('pengajuan.status') }}">Cek status</a>
    </section>
@endsection
