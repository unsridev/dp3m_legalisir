@extends('layouts.admin')

@section('title', 'Jenis layanan')

@section('content')
    <section class="intro"><h1>Jenis layanan</h1></section>

    <section class="card">
        <h2>Tambah jenis layanan</h2>
        @if ($errors->tambahLayanan->any())
            <div class="notice error" role="alert">
                <ul>
                    @foreach ($errors->tambahLayanan->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="inline-form" method="post" action="{{ route('admin.jenis-layanan.store') }}">
            @csrf
            <label for="nama-baru">Nama layanan
                <input id="nama-baru" name="nama" value="{{ $errors->tambahLayanan->any() ? old('nama') : '' }}" maxlength="120" required>
            </label>
            <label for="kode-baru">Kode antrean
                <input id="kode-baru" name="kode" value="{{ old('kode') }}" maxlength="8" pattern="[A-Za-z]{1,8}" placeholder="Contoh LA" required>
            </label>
            <button class="button" type="submit">Tambah layanan</button>
        </form>
    </section>

    <section class="card">
        <h2>Layanan terdaftar</h2>
        @foreach ($layanan as $jenis)
            <form class="inline-form service" method="post" action="{{ route('admin.jenis-layanan.update', $jenis) }}">
                @csrf
                @method('PATCH')
                <div><strong>Kode antrean</strong><span class="badge">{{ $jenis->kode }}</span></div>
                <label for="nama-{{ $jenis->id }}">Nama layanan
                    <input id="nama-{{ $jenis->id }}" name="nama" value="{{ $jenis->nama }}" maxlength="120" required>
                </label>
                <label for="aktif-{{ $jenis->id }}">Status layanan
                    <select id="aktif-{{ $jenis->id }}" name="aktif">
                        <option value="1" @selected($jenis->aktif)>Aktif</option>
                        <option value="0" @selected(! $jenis->aktif)>Nonaktif</option>
                    </select>
                </label>
                <button class="button secondary" type="submit">Simpan</button>
            </form>
        @endforeach
        @include('layouts.pagination', ['paginator' => $layanan])
    </section>
@endsection
