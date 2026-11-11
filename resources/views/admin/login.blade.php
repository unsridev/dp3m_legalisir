@extends('layouts.frontend')

@section('title', 'Masuk admin')

@section('navigation')
    <a href="{{ route('pengajuan.create') }}">Formulir pengajuan</a>
@endsection

@section('content')
    <section class="intro"><h1>Masuk admin</h1></section>

    <form class="card fields narrow" method="post" action="{{ route('admin.login') }}">
        @csrf
        <label class="full" for="email">Email
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required>
        </label>
        <label class="full" for="password">Kata sandi
            <input id="password" name="password" type="password" autocomplete="current-password" required>
        </label>
        <div class="full"><button class="button" type="submit">Masuk</button></div>
    </form>
@endsection
