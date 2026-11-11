<?php

use App\Http\Controllers\Admin\JenisLayananController;
use App\Http\Controllers\Admin\LaporanPengajuanController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PengajuanController::class, 'index'])->name('home');
Route::get('/pengajuan', [PengajuanController::class, 'create'])->name('pengajuan.create');
Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::get('/cekstatus', [PengajuanController::class, 'status'])->name('pengajuan.status');
Route::post('/cekstatus', [PengajuanController::class, 'cekStatus'])
    ->middleware('throttle:10,1,cek-status:')->name('pengajuan.cek-status');
Route::get('/pengajuan/sukses', [PengajuanController::class, 'success'])->name('pengajuan.sukses');

Route::redirect('/info-kampus', '/');
Route::redirect('/lapor', '/pengajuan');
Route::redirect('/index1', '/');

Route::prefix('admin')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::get('/logout', [LoginController::class, 'confirmLogout'])->name('admin.logout.confirm');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:10,1')->name('admin.login');

    Route::middleware(['auth', 'can:kelola-legalisir'])->name('admin.')->group(function (): void {
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
        Route::redirect('/', '/admin/pengajuan')->name('home');
        Route::redirect('/dashboard', '/admin/laporan')->name('dashboard');
        Route::get('/laporan', [LaporanPengajuanController::class, 'index'])->name('laporan');
        Route::get('/laporan/export', [LaporanPengajuanController::class, 'export'])->name('laporan.export');
        Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/{pengajuan}', [AdminPengajuanController::class, 'show'])->name('pengajuan.show');
        Route::patch('/pengajuan/{pengajuan}', [AdminPengajuanController::class, 'update'])->name('pengajuan.update');
        Route::resource('jenis-layanan', JenisLayananController::class)
            ->parameters(['jenis-layanan' => 'jenisLayanan'])
            ->only(['index', 'store', 'update']);
    });
});
