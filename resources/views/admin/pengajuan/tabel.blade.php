<div class="table-wrap" tabindex="0" role="region" aria-label="Tabel pengajuan">
    <table aria-label="Daftar pengajuan legalisir">
        <thead>
            <tr>
                <th scope="col">Nomor antrean</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama lengkap</th>
                <th scope="col">Jenis layanan</th>
                <th scope="col">Diajukan (WIB)</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuan as $ajuan)
                <tr>
                    <td><a class="queue-link" href="{{ route('admin.pengajuan.show', $ajuan) }}">{{ $ajuan->nomor_antrean }}</a></td>
                    <td>{{ $ajuan->nim }}</td>
                    <td>{{ $ajuan->nama_lengkap }}</td>
                    <td>{{ $ajuan->jenisLayanan->nama }}</td>
                    <td>{{ $ajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
                    <td><span class="badge badge-{{ $ajuan->status }}">{{ \App\Models\Pengajuan::STATUS[$ajuan->status] }}</span></td>
                </tr>
            @empty
                <tr><td class="empty-state" colspan="6">{{ $emptyMessage ?? 'Belum ada pengajuan.' }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@include('layouts.pagination', ['paginator' => $pengajuan])
