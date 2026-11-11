<div><dt>NIM</dt><dd>{{ $pengajuan->nim }}</dd></div>
<div><dt>Nama Lengkap</dt><dd>{{ $pengajuan->nama_lengkap }}</dd></div>
<div><dt>Email Aktif</dt><dd>{{ $pengajuan->email }}</dd></div>
<div><dt>No. WhatsApp</dt><dd>{{ $pengajuan->whatsapp }}</dd></div>
<div><dt>Tanggal Wisuda</dt><dd>{{ $pengajuan->tanggal_wisuda->format('d/m/Y') }}</dd></div>
<div class="full"><dt>Keperluan</dt><dd class="multiline">{{ $pengajuan->keperluan }}</dd></div>
