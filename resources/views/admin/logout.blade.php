@extends('layouts.frontend')

@section('title', 'Keluar dari panel admin')

@section('content')
    <section class="intro">
        <h1>Keluar dari panel admin</h1>
    </section>

    <form class="card narrow inline-form" method="post" action="{{ route('admin.logout') }}">
        @csrf
        <button class="button" type="submit">Keluar</button>
        <a href="{{ route('admin.pengajuan.index') }}">Kembali ke panel admin</a>
    </form>
@endsection
