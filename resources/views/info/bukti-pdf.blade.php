<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Bukti Pengajuan {{ $pengajuan->nomor_antrean }}</title>
    <style>
        @page { margin: 12pt; }
        body { margin: 0; color: #102954; font: 8.5pt/1.3 "DejaVu Sans", sans-serif; }
        .brand { margin: 0 auto 8pt; border-collapse: collapse; }
        .brand img { display: block; width: 44pt; height: 44pt; }
        .brand-name { border-left: 1pt solid #102954; padding-left: 8pt; font-size: 15pt; font-weight: bold; line-height: 1.08; }
        .brand-logo { padding-right: 8pt; }
        h1 { margin: 0 0 6pt; padding: 5pt 0; border-radius: 5pt; background: #073374; color: white; font-size: 14pt; text-align: center; }
        .queue { width: 100%; margin-bottom: 7pt; border: 1pt solid #123875; border-radius: 5pt; border-spacing: 0; }
        .queue th, .queue td { padding: 6pt; }
        .queue th { width: 78pt; border-right: 1pt solid #123875; text-align: left; }
        .queue td { font-size: 13pt; font-weight: bold; text-align: center; overflow-wrap: break-word; }
        .details { width: 100%; border-collapse: collapse; }
        .details th, .details td { padding: 4pt 2pt; vertical-align: top; border-bottom: .6pt solid #31558a; }
        .details th { width: 94pt; text-align: left; }
        .details td { color: #151b25; overflow-wrap: break-word; }
        .details .mark { width: 12pt; color: #073374; font-weight: bold; text-align: center; }
        .details .separator { width: 6pt; color: #123875; }
        .purpose-label { margin: 5pt 0 1pt; font-weight: bold; page-break-after: avoid; }
        .purpose { margin: 0; padding: 1pt 2pt 5pt; color: #151b25; white-space: pre-wrap; overflow-wrap: break-word; border-bottom: .6pt solid #31558a; }
    </style>
</head>
<body>
    <table class="brand">
        <tr>
            <td class="brand-logo"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('unsri-bukti.png'))) }}" alt=""></td>
            <td class="brand-name">Universitas<br>Sriwijaya</td>
        </tr>
    </table>
    <h1>Bukti Pengajuan Legalisir</h1>
    <table class="queue">
        <tr><th>Nomor Antrean</th><td>{{ $pengajuan->nomor_antrean }}</td></tr>
    </table>

    <table class="details">
        @foreach ([
            ['✓', 'Status', \App\Models\Pengajuan::STATUS[$pengajuan->status]],
            ['⚖', 'Jenis Layanan', $pengajuan->jenisLayanan->nama],
            ['▦', 'Tanggal Pengajuan (WIB)', $pengajuan->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y H:i')],
            ['#', 'NIM', $pengajuan->nim],
            ['●', 'Nama Lengkap', $pengajuan->nama_lengkap],
            ['✉', 'Email Aktif', $pengajuan->email],
            ['☎', 'No. WhatsApp', $pengajuan->whatsapp],
            ['▦', 'Tanggal Wisuda', $pengajuan->tanggal_wisuda->format('d/m/Y')],
        ] as [$icon, $label, $value])
            <tr>
                <td class="mark">{{ $icon }}</td>
                <th scope="row">{{ $label }}</th>
                <td class="separator">:</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
    <p class="purpose-label">Keperluan</p>
    <p class="purpose">{{ $pengajuan->keperluan }}</p>
</body>
</html>
