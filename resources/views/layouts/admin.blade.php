@extends('layouts.frontend')

@section('body-class', 'admin-page')
@section('wrapper-class', 'shell admin-shell')

@section('navigation')
    <a href="{{ route('home') }}">Buka situs publik <span aria-hidden="true">↗</span></a>
@endsection

@section('sidebar')
    <aside class="admin-sidebar">
        <nav aria-label="Menu admin">
            <p>Panel admin</p>
            <a href="{{ route('admin.pengajuan.index') }}" @if (request()->routeIs('admin.pengajuan.*')) aria-current="page" @endif>Pengajuan</a>
            <a href="{{ route('admin.laporan') }}" @if (request()->routeIs('admin.laporan*')) aria-current="page" @endif>Laporan</a>
            <a href="{{ route('admin.jenis-layanan.index') }}" @if (request()->routeIs('admin.jenis-layanan.*')) aria-current="page" @endif>Jenis layanan</a>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <button class="link-button" type="submit">Keluar</button>
            </form>
        </nav>
    </aside>
@endsection
