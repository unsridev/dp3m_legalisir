@extends('layouts.frontend')

@section('body-class', 'landing-page')
@section('wrapper-class', 'landing')
@section('main-class', 'landing-content')

@section('content')
    <section class="hero" aria-labelledby="judul-beranda">
        <div class="shell hero-inner">
            <div class="hero-copy">
                <p class="eyebrow">Layanan Universitas Sriwijaya</p>
                <h1 id="judul-beranda">Pengajuan<br><span>Legalisir Online</span></h1>
                <p>Ajukan legalisir dokumen dari mana saja. Isi formulir dan dapatkan nomor antrean setelah pengajuan diterima.</p>
                <div class="hero-actions">
                    <a class="button gold" href="{{ route('pengajuan.create') }}">Ajukan legalisir <span aria-hidden="true">→</span></a>
                    <a class="button outline" href="{{ route('pengajuan.status') }}">Cek status</a>
                </div>
            </div>

            <figure class="hero-photo">
                <img src="https://unsri.ac.id/frontend/images/slider/home1/unsri_landmark_idl.jpg"
                     alt="Landmark Universitas Sriwijaya dengan tulisan UNSRI di depan gedung kampus"
                     fetchpriority="high" width="800" height="540">
                <figcaption>Kampus UNSRI, Indralaya</figcaption>
            </figure>
        </div>
    </section>



    <section id="alur" class="shell landing-section" aria-labelledby="judul-alur">
        <div class="section-heading">
            <h2 id="judul-alur">Alur pengajuan</h2>
            <p>Dari pengisian data hingga pengajuan selesai.</p>
        </div>

        <ol class="step-grid">
            <li>
                <span class="step-number" aria-hidden="true">01</span>
                <h3>Isi formulir</h3>
                <p>Pilih jenis layanan dan lengkapi data diri, kontak aktif, serta keperluan legalisir.</p>
            </li>
            <li>
                <span class="step-number" aria-hidden="true">02</span>
                <h3>Simpan nomor antrean</h3>
                <p>Nomor antrean muncul setelah formulir terkirim. Simpan sebagai bukti pengajuan.</p>
            </li>
            <li>
                <span class="step-number" aria-hidden="true">03</span>
                <h3>Pengajuan diproses</h3>
                <p>Petugas memeriksa pengajuan dan memperbarui status saat mulai diproses dan ketika selesai.</p>
            </li>
        </ol>
    </section>

    <section class="shell landing-section services-section" aria-labelledby="judul-layanan">
        <div class="service-panel">
            <div>
                <h2 id="judul-layanan">Layanan tersedia</h2>
                <p>Pilih layanan yang sesuai dengan dokumen Anda.</p>
            </div>
            <ul class="service-links">
                @forelse ($layanan as $jenis)
                    <li><a href="{{ route('pengajuan.create', ['layanan' => $jenis->kode]) }}">
                        <span>{{ $jenis->nama }}</span><span aria-hidden="true">↗</span>
                    </a></li>
                @empty
                    <li>Belum ada jenis layanan yang aktif.</li>
                @endforelse
            </ul>
        </div>
    </section>
@endsection
