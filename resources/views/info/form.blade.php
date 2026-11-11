@extends('layouts.frontend')

@section('title', 'Formulir pengajuan')
@section('main-class', 'main form-page')

@section('content')
    <section class="intro">
        <a class="back-link" href="{{ route('home') }}">← Kembali ke beranda</a>
        <h1>Formulir pengajuan</h1>
        <p>Isi data berikut untuk mengajukan legalisir dan mendapatkan nomor antrian.</p>
    </section>

    <section class="card">
        @if ($layanan->isEmpty())
            <p class="notice">Belum ada layanan yang tersedia.</p>
        @else
            <form method="post" action="{{ route('pengajuan.store') }}" class="fields">
                @csrf
                <label class="full" for="jenis_layanan_id">Jenis Layanan
                    <select id="jenis_layanan_id" name="jenis_layanan_id" required>
                        <option value="">Pilih jenis layanan</option>
                        @foreach ($layanan as $jenis)
                            <option value="{{ $jenis->id }}" @selected(old('jenis_layanan_id') !== null
                                ? old('jenis_layanan_id') == $jenis->id
                                : ($layanan->count() === 1 || $kodeLayanan === $jenis->kode))>{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                </label>
                <label for="nim">NIM
                    <input id="nim" name="nim" value="{{ old('nim') }}" maxlength="30" required>
                </label>
                <label for="nama_lengkap">Nama Lengkap
                    <input id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" maxlength="150" autocomplete="name" required>
                </label>
                <label for="email">Email Aktif
                    <input id="email" name="email" type="email" value="{{ old('email') }}" maxlength="255" autocomplete="email" required>
                </label>
                <label for="whatsapp">No. WhatsApp
                    <input id="whatsapp" name="whatsapp" type="tel" value="{{ old('whatsapp') }}" maxlength="25" autocomplete="tel" required>
                </label>
                <label for="tanggal_wisuda">Tanggal Wisuda
                    <input id="tanggal_wisuda" name="tanggal_wisuda" type="date" value="{{ old('tanggal_wisuda') }}" required>
                </label>
                <label class="full" for="keperluan">Keperluan
                    <textarea id="keperluan" name="keperluan" rows="4" maxlength="2000" required>{{ old('keperluan') }}</textarea>
                </label>
                @include('info.recaptcha')
                <div class="full">
                    <button class="button" type="submit" @disabled(config('services.recaptcha.enabled') && blank(config('services.recaptcha.site_key')))>Kirim pengajuan</button>
                </div>
            </form>
        @endif
    </section>
@endsection
