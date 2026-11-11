<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

Artisan::command('legalisir:buat-admin {email}', function (): int {
    $nama = $this->ask('Nama admin');
    $password = $this->secret('Kata sandi (minimal 12 karakter)');
    $data = [
        'name' => $nama,
        'email' => $this->argument('email'),
        'password' => $password,
        'password_confirmation' => $this->secret('Ulangi kata sandi'),
    ];

    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:12', 'confirmed'],
    ]);

    if ($validator->fails()) {
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        return 1;
    }

    $admin = new User($validator->validated());
    $admin->is_admin = true;
    $admin->save();

    $this->info('Akun admin legalisir dibuat.');

    return 0;
})->purpose('Membuat akun admin untuk aplikasi pengajuan legalisir');

Artisan::command('inspire', function (): void {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
