@extends('layouts.frontend')

@section('title', 'Cek status pengajuan')

@section('content')
    <section id="cek-status" class="form-page" aria-labelledby="judul-cek-status">
        <div class="section-heading">
            <h2 id="judul-cek-status">Cek status pengajuan</h2>
            <p>Masukkan nomor antrean dan NIM yang digunakan saat mengajukan legalisir.</p>
        </div>

        @if ($pengajuan)
            <section class="card" aria-labelledby="judul-hasil-cek">
                <h2 id="judul-hasil-cek">Detail pengajuan</h2>
                <p class="notice" role="status">
                    <strong>{{ $pengajuan->nomor_antrean }}</strong>
                    <span class="badge badge-{{ $pengajuan->status }}">{{ \App\Models\Pengajuan::STATUS[$pengajuan->status] }}</span>
                </p>
                <p>{{ \App\Models\Pengajuan::KETERANGAN_STATUS[$pengajuan->status] }}</p>
                @if (filled($pengajuan->keterangan_status))
                    <div class="notice">
                        <strong>Keterangan petugas</strong>
                        <div class="multiline">{{ $pengajuan->keterangan_status }}</div>
                    </div>
                @endif
                <dl class="fields">
                    <div><dt>Jenis Layanan</dt><dd>{{ $pengajuan->jenisLayanan->nama }}</dd></div>
                    <div><dt>Tanggal Pengajuan (WIB)</dt><dd>{{ $pengajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</dd></div>
                    @include('info.detail-pemohon')
                </dl>
            </section>
        @endif

        <div class="card">
            @if ($errors->cekStatus->any())
                <div class="notice error" role="alert">
                    <ul>
                        @foreach ($errors->cekStatus->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="fields" method="post" action="{{ route('pengajuan.cek-status') }}">
                @csrf
                <label for="cek-nomor-antrean">Nomor antrean
                    <input id="cek-nomor-antrean" name="nomor_antrean" value="{{ old('nomor_antrean') }}"
                           placeholder="LA202611100001" maxlength="20" autocapitalize="characters" spellcheck="false" required>
                </label>
                <label for="cek-nim">NIM
                    <input id="cek-nim" name="nim" value="{{ old('nim') }}" maxlength="30" spellcheck="false" required>
                </label>
                @include('info.recaptcha')
                <div class="full">
                    <button class="button" type="submit" @disabled(config('services.recaptcha.enabled') && blank(config('services.recaptcha.site_key')))>Cek status</button>
                </div>
            </form>
        </div>
    </section>
@endsection
