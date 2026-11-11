<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0c2239">
    <title>@yield('title', 'Pengajuan Legalisir') | Universitas Sriwijaya</title>
    <link rel="stylesheet" href="{{ asset('legalisir.css') }}">
    @stack('head')
</head>
<body class="@yield('body-class')">
<a class="skip-link" href="#konten">Lewati ke konten</a>
<header class="topbar">
    <div class="shell navigation">
        <a class="brand" href="{{ route('home') }}">
            <img src="https://unsri.ac.id/images/lambang/979ca5b6-fc69-4efe-ac7b-82429127ef5b.png" width="42" height="42" alt="">
            <span><strong>Legalisir UNSRI</strong><small>Universitas Sriwijaya</small></span>
        </a>
        @section('navigation')
            <nav aria-label="Navigasi utama">
                <a href="{{ route('home') }}#alur">Alur pengajuan</a>
                <a href="{{ route('pengajuan.status') }}">Cek status</a>
                <a href="{{ route('pengajuan.create') }}" @if (request()->routeIs('pengajuan.create')) aria-current="page" @endif>Formulir</a>
            </nav>
        @show
    </div>
</header>
<div class="@yield('wrapper-class', 'shell')">
    @yield('sidebar')
    <main id="konten" class="@yield('main-class', 'main')">
        @if (session('pesan'))
            <p class="notice" role="status">{{ session('pesan') }}</p>
        @endif
        @if ($errors->any())
            <div class="notice error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</div>
<footer class="footer">
    <div class="shell footer-inner">
        <strong>Legalisir UNSRI</strong>
        <span>Universitas Sriwijaya</span>
    </div>
</footer>
</body>
</html>
