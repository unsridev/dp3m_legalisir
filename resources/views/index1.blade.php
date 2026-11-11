<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPID Universitas Sriwijaya - Portal Informasi Publik</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter & Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --unsri-blue: #003366;
            --unsri-yellow: #ffcc00;
            --unsri-dark-blue: #002142;
            --text-gray: #6c757d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fdfdfd;
            color: #333;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Montserrat', sans-serif;
        }

        /* Top Bar */
        .top-bar {
            background: var(--unsri-dark-blue);
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background: white !important;
            padding: 15px 0;
        }
        .navbar-brand img {
            height: 55px;
        }
        .nav-link {
            font-weight: 500;
            color: var(--unsri-blue) !important;
            margin: 0 5px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: var(--unsri-yellow) !important;
        }

        /* Carousel Customization */
        .carousel-item {
            height: 500px;
            background-color: #000;
        }
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            opacity: 0.6;
        }
        .carousel-caption {
            bottom: 25%;
            text-align: left;
            max-width: 700px;
            left: 10%;
        }
        .carousel-caption h2 {
            font-size: 3rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* Info Cards */
        .info-card {
            border: none;
            border-radius: 16px;
            transition: all 0.3s ease;
            background: white;
            border-bottom: 4px solid transparent;
        }
        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: var(--unsri-yellow);
        }
        .icon-circle {
            width: 70px;
            height: 70px;
            background: #f0f7ff;
            color: var(--unsri-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        /* News Section */
        .news-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .news-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .news-img-wrapper {
            height: 200px;
            overflow: hidden;
        }
        .news-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }
        .news-card:hover .news-img-wrapper img {
            transform: scale(1.1);
        }
        .badge-category {
            background: var(--unsri-yellow);
            color: var(--unsri-blue);
            font-weight: 600;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        /* Promo Banner Area */
        .promo-banner {
            background: linear-gradient(135deg, var(--unsri-blue) 0%, #0056b3 100%);
            border-radius: 20px;
            padding: 50px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .promo-banner::after {
            content: '';
            position: absolute;
            right: -50px;
            top: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        /* Section Title */
        .section-header {
            margin-bottom: 50px;
        }
        .section-header h2 {
            font-weight: 700;
            color: var(--unsri-blue);
            position: relative;
            padding-bottom: 15px;
        }
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--unsri-yellow);
        }

        /* Buttons */
        .btn-unsri {
            background-color: var(--unsri-yellow);
            color: var(--unsri-blue);
            font-weight: 600;
            border-radius: 8px;
            padding: 12px 28px;
            border: none;
        }
        .btn-unsri:hover {
            background-color: #e6b800;
            color: var(--unsri-blue);
        }

        footer {
            background: var(--unsri-dark-blue);
            color: #dee2e6;
            padding: 80px 0 30px;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-2 text-warning"></i> +62 711 580069</span>
                <span><i class="fas fa-envelope me-2 text-warning"></i> ppid@unsri.ac.id</span>
            </div>
            <div>
                <a href="#" class="text-white me-3 text-decoration-none small">SIREMA</a>
                <a href="#" class="text-white me-3 text-decoration-none small">E-Learning</a>
                <a href="#" class="text-white text-decoration-none small">Webmail</a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://unsri.ac.id/images/lambang/979ca5b6-fc69-4efe-ac7b-82429127ef5b.png" alt="Logo UNSRI">
                <div class="ms-3 d-none d-sm-block">
                    <div class="fw-bold lh-1" style="color: var(--unsri-blue); font-size: 1.2rem;">PPID</div>
                    <div class="small text-muted" style="font-size: 0.75rem;">Universitas Sriwijaya</div>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars text-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Tugas & Fungsi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Informasi Publik</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Layanan</a></li>
                    
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-unsri shadow-sm" href="#"><i class="fas fa-paper-plane me-2"></i>Permohonan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel Header -->
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756ebafe3?auto=format&fit=crop&q=80&w=1600" class="d-block w-100" alt="Kampus Unsri">
                <div class="carousel-caption d-none d-md-block">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2">SELAMAT DATANG</span>
                    <h2>Transparansi Informasi di Lingkungan Kampus</h2>
                    <p class="lead">PPID Universitas Sriwijaya berkomitmen memberikan pelayanan informasi publik yang akurat dan transparan.</p>
                    <a href="#" class="btn btn-unsri btn-lg mt-3">Pelajari Selengkapnya</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1523050853064-8521a30d08e4?auto=format&fit=crop&q=80&w=1600" class="d-block w-100" alt="Layanan Publik">
                <div class="carousel-caption d-none d-md-block text-center mx-auto" style="left: 0; right: 0;">
                    <h2>Permohonan Informasi Online</h2>
                    <p class="lead">Kini mendapatkan informasi publik semudah menggerakkan jari. Ajukan permohonan Anda secara daring.</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-light btn-lg me-2">Lihat Prosedur</a>
                        <a href="#" class="btn btn-unsri btn-lg">Ajukan Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1454165833767-027ffea9e778?auto=format&fit=crop&q=80&w=1600" class="d-block w-100" alt="Data Terintegrasi">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Laporan Layanan Informasi Publik</h2>
                    <p class="lead">Akses laporan tahunan dan statistik layanan informasi kami sebagai bentuk pertanggungjawaban publik.</p>
                    <a href="#" class="btn btn-unsri btn-lg mt-3">Lihat Laporan</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Main Features -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 mt-n5 position-relative" style="z-index: 5;">
                <div class="col-md-4">
                    <div class="card info-card p-4 shadow-sm text-center">
                        <div class="icon-circle mx-auto"><i class="fas fa-info-circle"></i></div>
                        <h5 class="fw-bold">Informasi Serta Merta</h5>
                        <p class="text-muted small">Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card info-card p-4 shadow-sm text-center">
                        <div class="icon-circle mx-auto"><i class="fas fa-clock"></i></div>
                        <h5 class="fw-bold">Informasi Berkala</h5>
                        <p class="text-muted small">Informasi publik yang wajib disediakan dan diumumkan secara berkala oleh PPID.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card info-card p-4 shadow-sm text-center">
                        <div class="icon-circle mx-auto"><i class="fas fa-check-double"></i></div>
                        <h5 class="fw-bold">Informasi Setiap Saat</h5>
                        <p class="text-muted small">Daftar informasi yang harus tersedia dan dapat diakses publik kapan saja diperlukan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slot Banner -->
    <section class="py-5">
        <div class="container">
            <div class="promo-banner shadow">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="display-6 fw-bold mb-3">Unduh Aplikasi Mobile PPID</h2>
                        <p class="lead mb-4">Dapatkan kemudahan akses informasi publik Universitas Sriwijaya langsung dari genggaman Anda. Tersedia di Play Store.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-light px-4 py-2 fw-bold"><i class="fab fa-google-play me-2"></i>Play Store</a>
                            <a href="#" class="btn btn-outline-light px-4 py-2 fw-bold disabled opacity-50"><i class="fab fa-apple me-2"></i>App Store (Coming Soon)</a>
                        </div>
                    </div>
                    <div class="col-lg-4 d-none d-lg-block text-end">
                        <i class="fas fa-mobile-alt fa-10x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-header d-flex justify-content-between align-items-end">
                <div>
                    <h2 class="mb-0">Berita Terbaru</h2>
                    <p class="text-muted mt-2">Update informasi terkini seputar layanan PPID UNSRI</p>
                </div>
                <a href="#" class="btn btn-outline-primary btn-sm mb-2 px-3">Lihat Semua Berita</a>
            </div>

            <div class="row g-4">
                <!-- News 1 -->
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <div class="news-img-wrapper position-relative">
                            <span class="badge badge-category position-absolute top-0 start-0 m-3">Kegiatan</span>
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=800" alt="News">
                        </div>
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2"><i class="far fa-calendar-alt me-2"></i>15 Mei 2024</div>
                            <h5 class="card-title fw-bold">Sosialisasi Keterbukaan Informasi Publik di Fakultas Teknik</h5>
                            <p class="card-text text-muted small">Tim PPID UNSRI mengadakan pertemuan untuk meningkatkan pemahaman staf mengenai UU No. 14 Tahun 2008...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <a href="#" class="text-primary text-decoration-none fw-semibold">Baca Selengkapnya <i class="fas fa-chevron-right ms-1" style="font-size: 0.8rem;"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News 2 -->
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <div class="news-img-wrapper position-relative">
                            <span class="badge badge-category position-absolute top-0 start-0 m-3">Pengumuman</span>
                            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&q=80&w=800" alt="News">
                        </div>
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2"><i class="far fa-calendar-alt me-2"></i>10 Mei 2024</div>
                            <h5 class="card-title fw-bold">Laporan Tahunan Layanan Informasi Publik 2023 Telah Rilis</h5>
                            <p class="card-text text-muted small">Sebagai bentuk akuntabilitas, PPID UNSRI merilis laporan statistik pelayanan sepanjang tahun 2023...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <a href="#" class="text-primary text-decoration-none fw-semibold">Baca Selengkapnya <i class="fas fa-chevron-right ms-1" style="font-size: 0.8rem;"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News 3 -->
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <div class="news-img-wrapper position-relative">
                            <span class="badge badge-category position-absolute top-0 start-0 m-3">Edukasi</span>
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&q=80&w=800" alt="News">
                        </div>
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2"><i class="far fa-calendar-alt me-2"></i>05 Mei 2024</div>
                            <h5 class="card-title fw-bold">Cara Mengajukan Keberatan Informasi Lewat Website</h5>
                            <p class="card-text text-muted small">Panduan langkah demi langkah bagi pemohon yang ingin melakukan keberatan atas jawaban permohonan...</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-4 pt-0">
                            <a href="#" class="text-primary text-decoration-none fw-semibold">Baca Selengkapnya <i class="fas fa-chevron-right ms-1" style="font-size: 0.8rem;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <img src="https://unsri.ac.id/images/lambang/979ca5b6-fc69-4efe-ac7b-82429127ef5b.png" alt="Logo" height="60">
                        <div class="ms-3 text-white">
                            <h5 class="fw-bold mb-0">PPID UNSRI</h5>
                            <p class="small mb-0">Portal Informasi Publik</p>
                        </div>
                    </div>
                    <p class="text-white-50">Lembaga pengelola informasi dan dokumentasi Universitas Sriwijaya yang berdedikasi melayani hak akses informasi publik masyarakat luas.</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" style="width: 36px; height: 36px;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" style="width: 36px; height: 36px;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2" style="width: 36px; height: 36px;"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-white fw-bold mb-4">Profil</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Tentang PPID</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Visi & Misi</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Maklumat Pelayanan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Struktur PPID</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-white fw-bold mb-4">Layanan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Permohonan Informasi</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Status Permohonan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Prosedur Keberatan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">FAQ</a></li>
                    </ul>
                </div>

                 <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="text-white fw-bold mb-4">Layanan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Permohonan Informasi</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Status Permohonan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">Prosedur Keberatan</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none hover-white">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="text-white fw-bold mb-4">Lokasi & Kontak</h6>
                    <p class="text-white-50 small mb-2"><i class="fas fa-map-marker-alt me-2"></i> Gedung KPA Lt. 1, Universitas Sriwijaya Indralaya, Ogan Ilir, Sumsel.</p>
                    <p class="text-white-50 small mb-2"><i class="fas fa-phone me-2"></i> (0711) 580069</p>
                    <p class="text-white-50 small mb-4"><i class="fas fa-envelope me-2"></i> ppid@unsri.ac.id</p>
                    
                    <div class="p-3 bg-dark rounded-3 d-flex align-items-center">
                        <i class="fas fa-headset fa-2x text-warning me-3"></i>
                        <div>
                            <div class="small text-white-50">Butuh Bantuan?</div>
                            <div class="fw-bold text-white">Live Chat via WhatsApp</div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-5 border-secondary opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small text-white-50 mb-0">&copy; 2024 PPID Universitas Sriwijaya. Seluruh Hak Cipta Dilindungi.</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <a href="#" class="text-white-50 text-decoration-none small me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-white-50 text-decoration-none small">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>