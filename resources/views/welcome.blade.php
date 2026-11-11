@extends('layouts.frontend')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">Layanan Aspirasi & Pengaduan <span>Online</span>.</h1>
                <p class="hero-subtitle">Sampaikan laporan Anda langsung kepada unit kerja berwenang di lingkungan Universitas Sriwijaya secara aman dan nyaman.</p>
                <div class="d-flex gap-3">
                    <a href="{{ Route('lapor') }}" class="btn btn-dark btn-action px-5 py-3">Buat Laporan</a>
                    <a href="#" class="btn btn-outline-dark btn-action px-5 py-3">Lihat Panduan</a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="stat-card">
                            <span class="stat-number">1,240</span>
                            <span class="stat-label">Total Laporan</span>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="stat-card">
                            <span class="stat-number">98%</span>
                            <span class="stat-label">Selesai</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <span class="stat-number">24</span>
                            <span class="stat-label">Unit Kerja</span>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="stat-card">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Hari Rata-rata</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Action Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="action-card card-lapor">
                    <div class="mb-4"><i class="bi bi-pencil-square display-4"></i></div>
                    <h3>Sampaikan Laporan</h3>
                    <p>Laporkan masalah, saran, atau aspirasi Anda melalui formulir daring yang telah kami sediakan.</p>
                    <a href="{{ Route('lapor') }}" class="btn-action btn-white">Mulai Melapor</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="action-card card-cek">
                    <div class="mb-4"><i class="bi bi-search display-4"></i></div>
                    <h3>Cek Status Laporan</h3>
                    <p>Pantau perkembangan tindak lanjut laporan Anda cukup dengan memasukkan ID Laporan atau Email.</p>
                    <a href="#" class="btn-action btn-dark">Cek Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Alur Pengaduan</h2>
            <p class="text-muted">Proses penanganan laporan Anda dilakukan secara profesional dan transparan.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="step-item">
                    <div class="step-icon-wrapper"><i class="bi bi-chat-left-dots"></i></div>
                    <h5>Tulis Laporan</h5>
                    <p class="small text-muted">Isi formulir pengaduan dengan data yang benar.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-item">
                    <div class="step-icon-wrapper"><i class="bi bi-shield-check"></i></div>
                    <h5>Verifikasi</h5>
                    <p class="small text-muted">Tim kami akan meninjau validitas laporan Anda.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-item">
                    <div class="step-icon-wrapper"><i class="bi bi-arrow-right-circle"></i></div>
                    <h5>Tindak Lanjut</h5>
                    <p class="small text-muted">Laporan diteruskan ke unit terkait untuk ditangani.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="step-item">
                    <div class="step-icon-wrapper"><i class="bi bi-check2-all"></i></div>
                    <h5>Selesai</h5>
                    <p class="small text-muted">Dapatkan solusi dan tanggapan atas masalah Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 footer-links">
                <div class="footer-logo">
                    <img src="https://upload.wikimedia.org/wikipedia/id/thumb/d/d0/Logo_Universitas_Sriwijaya.png/200px-Logo_Universitas_Sriwijaya.png" alt="Unsri">
                </div>
                <p class="opacity-75">Layanan resmi Universitas Sriwijaya untuk pengelolaan aspirasi dan pengaduan civitas akademika.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 footer-links">
                <h5>Layanan</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Buat Laporan</a></li>
                    <li><a href="#">Cek Status</a></li>
                    <li><a href="#">Statistik</a></li>
                    <li><a href="#">Panduan</a></li>
                </ul>
            </div>
            <div class="col-lg-2 footer-links">
                <h5>Tentang</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Profil Kampus</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Bantuan</a></li>
                </ul>
            </div>
            <div class="col-lg-3 footer-links">
                <h5>Kontak Kami</h5>
                <p class="small opacity-75 mb-2"><i class="bi bi-geo-alt me-2 text-warning"></i> Kampus Indralaya KM 32, Ogan Ilir, Sumatera Selatan.</p>
                <p class="small opacity-75 mb-2"><i class="bi bi-envelope me-2 text-warning"></i> helpdesk@unsri.ac.id</p>
                <p class="small opacity-75"><i class="bi bi-telephone me-2 text-warning"></i> (0711) 580069</p>
            </div>
        </div>
        <hr class="my-5 opacity-25">
        <div class="text-center small opacity-50">
            &copy; 2024 Universitas Sriwijaya. All Rights Reserved.
        </div>
    </div>
</footer>

<!-- JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

@endsection