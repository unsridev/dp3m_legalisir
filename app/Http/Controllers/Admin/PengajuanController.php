<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function index(): View
    {
        return view('admin.pengajuan.index', [
            'pengajuan' => Pengajuan::with('jenisLayanan')->orderByDesc('id')->paginate(15),
        ]);
    }

    public function show(Pengajuan $pengajuan): View
    {
        $pengajuan->load('jenisLayanan');

        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    public function update(Request $request, Pengajuan $pengajuan): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Pengajuan::STATUS))],
            'keterangan_status' => ['nullable', 'string', 'max:2000'],
        ], [
            'status.in' => 'Pilih status yang tersedia.',
            'keterangan_status.max' => 'Keterangan status maksimal 2.000 karakter.',
        ]);

        if ($data['status'] !== $pengajuan->status) {
            $data += ['keterangan_status' => null];
        }

        $pengajuan->update($data);

        return to_route('admin.pengajuan.show', $pengajuan)->with('pesan', 'Status pengajuan diperbarui.');
    }
}
