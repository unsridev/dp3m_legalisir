<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class JenisLayananController extends Controller
{
    public function index(): View
    {
        return view('admin.jenis-layanan', [
            'layanan' => JenisLayanan::orderBy('nama')->paginate(15),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge(['kode' => Str::upper($request->string('kode', strict: true)->toString())]);

        JenisLayanan::create($request->validateWithBag('tambahLayanan', [
            'nama' => ['required', 'string', 'max:120'],
            'kode' => ['required', 'string', 'regex:/^[A-Z]{1,8}$/', 'unique:jenis_layanans,kode'],
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'nama.max' => 'Nama layanan maksimal 120 karakter.',
            'kode.required' => 'Kode antrean wajib diisi.',
            'kode.regex' => 'Kode antrean harus terdiri dari 1–8 huruf.',
            'kode.unique' => 'Kode antrean sudah digunakan.',
        ]));

        return to_route('admin.jenis-layanan.index')->with('pesan', 'Jenis layanan ditambahkan.');
    }

    public function update(Request $request, JenisLayanan $jenisLayanan): RedirectResponse
    {
        $jenisLayanan->update($request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'aktif' => ['required', 'boolean'],
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'nama.max' => 'Nama layanan maksimal 120 karakter.',
            'aktif.required' => 'Pilih status layanan.',
            'aktif.boolean' => 'Pilih status layanan yang valid.',
        ]));

        return back()->with('pesan', 'Jenis layanan diperbarui.');
    }
}
