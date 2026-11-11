@extends('layouts.admin')

@section('title', 'Daftar pengajuan')

@section('content')
    <section class="intro">
        <h1>Daftar pengajuan</h1>
        <p>Buka nomor antrean untuk melihat detail dan memperbarui status.</p>
    </section>

    <section class="card">
        @include('admin.pengajuan.tabel')
    </section>
@endsection
