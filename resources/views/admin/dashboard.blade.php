@extends('layouts.admin')

@section('content')
<div class="header-welcome mb-4">
    <h2 style="font-weight: 600;">Welcome, Admin!</h2>
    <p class="text-muted">Monitor data laporan kampus Anda secara real-time.</p>
</div>

<div class="row">
    @php
        $stats = [
            ['title' => 'Total Laporan', 'val' => $total, 'color' => '#5d78ff', 'icon' => 'fa-clipboard-list'],
            ['title' => 'Laporan Baru', 'val' => $baru, 'color' => '#ffb822', 'icon' => 'fa-plus-circle'],
            ['title' => 'Diproses', 'val' => $proses, 'color' => '#36a3f7', 'icon' => 'fa-sync'],
            ['title' => 'Selesai', 'val' => $selesai, 'color' => '#34bfa3', 'icon' => 'fa-check-double'],
        ];
    @endphp

    @foreach($stats as $s)
    <div class="col-md-3">
        <div class="stat-card" style="background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;">
            <p class="text-muted" style="font-size: 14px; margin-bottom: 5px;">{{ $s['title'] }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="margin: 0; font-weight: 700; color: #333;">{{ $s['val'] }}</h2>
                <i class="fas {{ $s['icon'] }}" style="color: {{ $s['color'] }}; opacity: 0.2; font-size: 24px;"></i>
            </div>
            <a href="#" style="font-size: 12px; color: {{ $s['color'] }}; text-decoration: none;">More info →</a>
        </div>
    </div>
    @endforeach
</div>

@endsection