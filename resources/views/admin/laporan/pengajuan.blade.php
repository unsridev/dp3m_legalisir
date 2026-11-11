@extends('layouts.admin')

@section('title', 'Laporan pengajuan')

@section('content')
    <section class="intro report-heading">
        <div>
            <h1>Laporan pengajuan</h1>
            <p>Rekap berdasarkan tanggal pengajuan, jenis layanan, dan status saat ini.</p>
        </div>
        <a class="button secondary" href="{{ route('admin.laporan.export', $filter) }}">Unduh CSV <span aria-hidden="true">↓</span></a>
    </section>

    <form class="card report-filter" method="get" action="{{ route('admin.laporan') }}">
        <label for="mulai">Tanggal awal
            <input id="mulai" name="mulai" type="date" value="{{ $filter['mulai'] ?? '' }}">
        </label>
        <label for="sampai">Tanggal akhir
            <input id="sampai" name="sampai" type="date" value="{{ $filter['sampai'] ?? '' }}">
        </label>
        <label for="jenis_layanan_id">Jenis layanan
            <select id="jenis_layanan_id" name="jenis_layanan_id">
                <option value="">Semua layanan</option>
                @foreach ($layanan as $jenis)
                    <option value="{{ $jenis->id }}" @selected(($filter['jenis_layanan_id'] ?? null) == $jenis->id)>{{ $jenis->nama }}</option>
                @endforeach
            </select>
        </label>
        <label for="status">Status
            <select id="status" name="status">
                <option value="">Semua status</option>
                @foreach ($status as $nilai => $label)
                    <option value="{{ $nilai }}" @selected(($filter['status'] ?? null) === $nilai)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <div class="filter-actions">
            <button class="button" type="submit">Terapkan filter</button>
            @if ($filter)
                <a href="{{ route('admin.laporan') }}">Reset filter</a>
            @endif
        </div>
    </form>

    <dl class="stats" aria-label="Ringkasan laporan">
        <div class="stat stat-total">
            <dt>Total pengajuan</dt>
            <dd>{{ number_format($total, 0, ',', '.') }}</dd>
        </div>
        @foreach ($status as $nilai => $label)
            <div class="stat stat-{{ $nilai }}">
                <dt>{{ $label }}</dt>
                <dd>{{ number_format($jumlahPerStatus[$nilai] ?? 0, 0, ',', '.') }}</dd>
            </div>
        @endforeach
    </dl>

    <section class="card" aria-labelledby="hasil-laporan">
        <h2 id="hasil-laporan">Rincian pengajuan</h2>
        @include('admin.pengajuan.tabel', ['emptyMessage' => 'Tidak ada pengajuan yang cocok dengan filter.'])
    </section>
@endsection
