@extends('layouts.admin')

@section('title', 'Detail pengajuan')

@section('content')
    <section class="intro">
        <a href="{{ route('admin.pengajuan.index') }}">Kembali ke daftar pengajuan</a>
        <h1>{{ $pengajuan->nomor_antrean }}</h1>
        <p>{{ $pengajuan->jenisLayanan->nama }}</p>
    </section>

    <section class="card">
        <dl class="fields">
            @include('info.detail-pemohon')
        </dl>
        <p>{{ \App\Models\Pengajuan::KETERANGAN_STATUS[$pengajuan->status] }}</p>
        <form class="fields" method="post" action="{{ route('admin.pengajuan.update', $pengajuan) }}">
            @csrf
            @method('PATCH')
            <label for="status">Status
                <select id="status" name="status" required>
                    @foreach (\App\Models\Pengajuan::STATUS as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $pengajuan->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            <label class="full" for="keterangan_status">Keterangan status
                <textarea id="keterangan_status" name="keterangan_status" rows="3" maxlength="2000" aria-describedby="petunjuk-keterangan">{{ old('keterangan_status', $pengajuan->keterangan_status) }}</textarea>
                <small id="petunjuk-keterangan">Opsional. Keterangan ini dapat dibaca pemohon di halaman Cek Status.</small>
            </label>
            <div class="full"><button class="button" type="submit">Simpan status</button></div>
        </form>
    </section>
@endsection
