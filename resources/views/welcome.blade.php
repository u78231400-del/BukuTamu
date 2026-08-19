<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukutamu - Reservasi Ruangan & Fasilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #1a1a2e;
            --secondary: #16213e;
            --accent: #e94560;
            --gold: #c9a959;
            --text-dark: #1a1a2e;
            --text-light: #6b7280;
            --bg-light: #fafbfc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-light);
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand-custom i {
            color: var(--accent);
        }

        .nav-link-custom {
            color: var(--text-dark) !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 20px !important;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link-custom:hover {
            color: var(--accent) !important;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 20px;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover::after {
            width: calc(100% - 40px);
        }

        .btn-masuk {
            color: var(--primary);
            font-weight: 600;
            padding: 8px 24px !important;
            border: none;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-masuk:hover {
            color: var(--accent);
        }

        .btn-daftar {
            background: var(--accent);
            color: white !important;
            font-weight: 600;
            padding: 10px 24px !important;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
        }

        .btn-daftar:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
        }

        .navbar-toggler-custom {
            border: none;
            padding: 8px;
            background: transparent;
        }

        .navbar-toggler-custom:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon-custom {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(26, 26, 46, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Hero Section */
        .hero-section {
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #fafbfc 0%, #f0f4f8 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 70%;
            height: 150%;
            background: linear-gradient(135deg, rgba(233, 69, 96, 0.08) 0%, rgba(201, 169, 89, 0.08) 100%);
            border-radius: 50%;
            transform: rotate(-15deg);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(233, 69, 96, 0.1);
            color: var(--accent);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .hero-title {
            font-size: 3.2rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--accent), #ff6b81);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 32px;
            max-width: 500px;
        }

        .search-box {
            background: white;
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .search-box .search-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.2rem;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .search-box input::placeholder {
            color: #9ca3af;
        }

        .search-box .btn-search {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-box .btn-search:hover {
            background: #d63651;
        }

        .popular-tags {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .popular-label {
            font-size: 0.85rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .tag-item {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .tag-item:hover {
            color: var(--accent);
        }

        .tag-divider {
            color: #d1d5db;
        }

        .hero-visual {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            max-width: 520px;
        }

        .hero-image {
            width: 100%;
            height: 480px;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
        }

        .floating-card {
            position: absolute;
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: float 3s ease-in-out infinite;
        }

        .floating-card-1 {
            top: 20%;
            left: -30px;
        }

        .floating-card-2 {
            bottom: 15%;
            right: -30px;
            animation-delay: 1.5s;
        }

        .floating-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .icon-pink {
            background: rgba(233, 69, 96, 0.1);
            color: var(--accent);
        }

        .icon-gold {
            background: rgba(201, 169, 89, 0.15);
            color: var(--gold);
        }

        .floating-card-text {
            font-size: 0.85rem;
        }

        .floating-card-text .title {
            font-weight: 600;
            color: var(--primary);
        }

        .floating-card-text .subtitle {
            color: var(--text-light);
            font-size: 0.75rem;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive Styles */
        @media (max-width: 991px) {
            .navbar-custom .navbar-collapse {
                background: white;
                padding: 20px;
                border-radius: 16px;
                margin-top: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            }

            .nav-link-custom {
                padding: 12px 16px !important;
            }

            .nav-link-custom::after {
                display: none;
            }

            .btn-masuk, .btn-daftar {
                width: 100%;
                margin: 6px 0;
                text-align: center;
            }

            .btn-daftar {
                margin-bottom: 0;
            }

            .hero-section {
                padding: 80px 0 60px;
                min-height: auto;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .search-box {
                flex-direction: column;
                padding: 12px;
            }

            .search-box .search-icon {
                display: none;
            }

            .search-box input {
                width: 100%;
                text-align: center;
            }

            .search-box .btn-search {
                width: 100%;
            }

            .hero-visual {
                margin-top: 40px;
            }

            .hero-image {
                height: 350px;
            }

            .floating-card {
                padding: 12px 16px;
            }

            .floating-card-1 {
                left: 10px;
                top: 10px;
            }

            .floating-card-2 {
                right: 10px;
                bottom: 10px;
            }

            .popular-tags {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-image {
                height: 280px;
            }

            .floating-card {
                display: none;
            }
        }

        /* Kategori Venue Section */
        .kategori-section {
            padding: 80px 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .section-subtitle {
            font-size: 1rem;
            color: var(--text-light);
        }

        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }

        .kategori-card {
            background: var(--bg-light);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .kategori-card:hover {
            background: white;
            border-color: var(--accent);
            box-shadow: 0 8px 30px rgba(233, 69, 96, 0.12);
            transform: translateY(-4px);
        }

        .kategori-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: white;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .kategori-card:hover .kategori-icon {
            background: var(--accent);
            color: white;
        }

        .kategori-nama {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--primary);
        }

        @media (max-width: 1199px) {
            .kategori-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 576px) {
            .kategori-section {
                padding: 60px 0;
            }

            .section-title {
                font-size: 1.6rem;
            }

            .kategori-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }

            .kategori-card {
                padding: 20px 12px;
            }

            .kategori-icon {
                width: 48px;
                height: 48px;
                font-size: 1.5rem;
                margin-bottom: 12px;
            }

            .kategori-nama {
                font-size: 0.85rem;
            }
        }

        /* Venue Pilihan Section */
        .venue-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .venue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .venue-header-left {
            flex: 1;
        }

        .venue-header-right {
            flex-shrink: 0;
        }

        .section-title-left {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .section-subtitle-left {
            font-size: 1rem;
            color: var(--text-light);
        }

        .lihat-semua {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
            white-space: nowrap;
        }

        .lihat-semua:hover {
            color: #d63651;
        }

        .venue-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .venue-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .venue-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .venue-image-wrapper {
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .venue-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .venue-card:hover .venue-image {
            transform: scale(1.05);
        }

        .venue-favorite {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d5db;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .venue-favorite:hover,
        .venue-favorite.active {
            color: var(--accent);
        }

        .venue-body {
            padding: 20px;
        }

        .venue-nama {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .venue-info {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .venue-lokasi {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .venue-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.85rem;
            color: var(--gold);
            font-weight: 600;
        }

        .venue-harga {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .venue-harga span {
            font-weight: 500;
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .btn-detail {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: white;
        }

        @media (max-width: 1199px) {
            .venue-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .venue-section {
                padding: 60px 0;
            }

            .venue-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .section-title-left {
                font-size: 1.6rem;
            }

            .venue-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .venue-image-wrapper {
                height: 200px;
            }
        }

        /* Kenapa Memilih Section */
        .kenapa-section {
            padding: 80px 0;
            background: white;
        }

        .kenapa-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .kenapa-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .kenapa-card {
            background: var(--bg-light);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .kenapa-card:hover {
            background: white;
            border-color: var(--accent);
            box-shadow: 0 8px 30px rgba(233, 69, 96, 0.1);
            transform: translateY(-4px);
        }

        .kenapa-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            color: var(--accent);
        }

        .kenapa-judul {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .kenapa-deskripsi {
            font-size: 0.9rem;
            color: var(--text-light);
            line-height: 1.6;
        }

        @media (max-width: 1199px) {
            .kenapa-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .kenapa-section {
                padding: 60px 0;
            }

            .kenapa-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .kenapa-card {
                padding: 24px 20px;
            }
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand-custom" href="#">
                <i class="bi bi-building"></i>
                Bukutamu
            </a>

            <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon-custom"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Venue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#">Tentang</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="/login" class="btn btn-masuk">Masuk</a>
                    <a href="#" class="btn btn-daftar">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="hero-badge">
                        <i class="bi bi-star-fill"></i>
                        Platform Reservasi Venue Terpercaya
                    </div>

                    <h1 class="hero-title">
                        Temukan Ruang yang Tepat untuk <span class="highlight">Momen yang Berarti.</span>
                    </h1>

                    <p class="hero-description">
                        Temukan venue untuk pernikahan, meeting, lomba, jamuan, seminar, dan berbagai acara lainnya.
                    </p>

                    <div class="search-box">
                        <div class="search-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <input type="text" placeholder="Cari venue, lokasi, atau jenis acara...">
                        <button class="btn-search">Cari</button>
                    </div>

                    <div class="popular-tags">
                        <span class="popular-label">Populer:</span>
                        <a class="tag-item">Pernikahan</a>
                        <span class="tag-divider">•</span>
                        <a class="tag-item">Meeting</a>
                        <span class="tag-divider">•</span>
                        <a class="tag-item">Lomba</a>
                        <span class="tag-divider">•</span>
                        <a class="tag-item">Seminar</a>
                    </div>
                </div>

                <div class="col-lg-6 hero-visual">
                    <div class="hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&q=80" alt="Elegant Venue" class="hero-image">

                        <div class="floating-card floating-card-1">
                            <div class="floating-card-icon icon-pink">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="floating-card-text">
                                <div class="title">500+ Venue</div>
                                <div class="subtitle">Tersedia di seluruh Indonesia</div>
                            </div>
                        </div>

                        <div class="floating-card floating-card-2">
                            <div class="floating-card-icon icon-gold">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="floating-card-text">
                                <div class="title">Verified</div>
                                <div class="subtitle">Semua venue terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Venue Section --}}
    <section class="kategori-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Temukan Venue Sesuai Kebutuhanmu</h2>
                <p class="section-subtitle">Pilih jenis tempat yang sesuai dengan acara yang ingin kamu adakan.</p>
            </div>

            <div class="kategori-grid">
                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="kategori-nama">Aula</div>
                </div>

                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="kategori-nama">Pernikahan</div>
                </div>

                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-easel"></i>
                    </div>
                    <div class="kategori-nama">Meeting</div>
                </div>

                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-cup-hot"></i>
                    </div>
                    <div class="kategori-nama">Jamuan</div>
                </div>

                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="kategori-nama">Lomba</div>
                </div>

                <div class="kategori-card">
                    <div class="kategori-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="kategori-nama">Event</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Venue Pilihan Section --}}
    <section class="venue-section">
        <div class="container">
            <div class="venue-header">
                <div class="venue-header-left">
                    <h2 class="section-title-left">Venue Pilihan</h2>
                    <p class="section-subtitle-left">Temukan tempat yang cocok untuk acara dan momen spesial Anda.</p>
                </div>
                <div class="venue-header-right">
                    <a href="#" class="lihat-semua">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="venue-grid">
                <div class="venue-card">
                    <div class="venue-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=600&q=80" alt="Grand Ballroom" class="venue-image">
                        <div class="venue-favorite">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    <div class="venue-body">
                        <h3 class="venue-nama">Grand Ballroom</h3>
                        <div class="venue-info">
                            <span class="venue-lokasi">
                                <i class="bi bi-geo-alt"></i> Jakarta
                            </span>
                            <span class="venue-rating">
                                <i class="bi bi-star-fill"></i> 4.8
                            </span>
                        </div>
                        <div class="venue-harga">Rp10.000.000 <span>/ hari</span></div>
                        <button class="btn-detail">Lihat Detail</button>
                    </div>
                </div>

                <div class="venue-card">
                    <div class="venue-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=600&q=80" alt="Harmony Event Hall" class="venue-image">
                        <div class="venue-favorite">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    <div class="venue-body">
                        <h3 class="venue-nama">Harmony Event Hall</h3>
                        <div class="venue-info">
                            <span class="venue-lokasi">
                                <i class="bi bi-geo-alt"></i> Bandung
                            </span>
                            <span class="venue-rating">
                                <i class="bi bi-star-fill"></i> 4.7
                            </span>
                        </div>
                        <div class="venue-harga">Rp7.500.000 <span>/ hari</span></div>
                        <button class="btn-detail">Lihat Detail</button>
                    </div>
                </div>

                <div class="venue-card">
                    <div class="venue-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=600&q=80" alt="Garden Celebration" class="venue-image">
                        <div class="venue-favorite">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    <div class="venue-body">
                        <h3 class="venue-nama">Garden Celebration</h3>
                        <div class="venue-info">
                            <span class="venue-lokasi">
                                <i class="bi bi-geo-alt"></i> Yogyakarta
                            </span>
                            <span class="venue-rating">
                                <i class="bi bi-star-fill"></i> 4.9
                            </span>
                        </div>
                        <div class="venue-harga">Rp6.000.000 <span>/ hari</span></div>
                        <button class="btn-detail">Lihat Detail</button>
                    </div>
                </div>

                <div class="venue-card">
                    <div class="venue-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80" alt="Meeting Space" class="venue-image">
                        <div class="venue-favorite">
                            <i class="bi bi-heart"></i>
                        </div>
                    </div>
                    <div class="venue-body">
                        <h3 class="venue-nama">Meeting Space</h3>
                        <div class="venue-info">
                            <span class="venue-lokasi">
                                <i class="bi bi-geo-alt"></i> Surabaya
                            </span>
                            <span class="venue-rating">
                                <i class="bi bi-star-fill"></i> 4.6
                            </span>
                        </div>
                        <div class="venue-harga">Rp2.500.000 <span>/ hari</span></div>
                        <button class="btn-detail">Lihat Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kenapa Memilih Section --}}
    <section class="kenapa-section">
        <div class="container">
            <div class="kenapa-header">
                <h2 class="section-title">Kenapa Memilih Bukutamu?</h2>
                <p class="section-subtitle">Semua yang Anda butuhkan untuk menemukan dan mengatur reservasi venue dengan lebih mudah.</p>
            </div>

            <div class="kenapa-grid">
                <div class="kenapa-card">
                    <div class="kenapa-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 class="kenapa-judul">Mudah Menemukan Venue</h3>
                    <p class="kenapa-deskripsi">Temukan berbagai tempat yang sesuai dengan kebutuhan acara Anda.</p>
                </div>

                <div class="kenapa-card">
                    <div class="kenapa-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="kenapa-judul">Reservasi Lebih Mudah</h3>
                    <p class="kenapa-deskripsi">Ajukan reservasi tanpa proses yang rumit dan berbelit-belit.</p>
                </div>

                <div class="kenapa-card">
                    <div class="kenapa-icon">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </div>
                    <h3 class="kenapa-judul">Pilihan Venue Beragam</h3>
                    <p class="kenapa-deskripsi">Temukan berbagai ruangan dan fasilitas untuk berbagai jenis acara.</p>
                </div>

                <div class="kenapa-card">
                    <div class="kenapa-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <h3 class="kenapa-judul">Reservasi Terorganisir</h3>
                    <p class="kenapa-deskripsi">Pantau dan kelola status reservasi Anda dengan lebih mudah.</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
