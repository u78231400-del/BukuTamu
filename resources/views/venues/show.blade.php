<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $venue->nama_venue }} - Bukutamu</title>
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

        .nav-link-custom.active {
            color: var(--accent) !important;
        }

        .nav-link-custom.active::after {
            width: calc(100% - 40px);
        }

        .btn-masuk {
            color: var(--primary);
            font-weight: 600;
            padding: 8px 24px !important;
            border: none;
            background: transparent;
            transition: all 0.3s ease;
            text-decoration: none;
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
            text-decoration: none;
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

        .venue-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 80px 0;
            color: white;
        }

        .venue-hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 24px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            color: white;
        }

        .venue-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .venue-hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .venue-hero-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .venue-hero-meta i {
            color: var(--gold);
        }

        .venue-detail-section {
            padding: 60px 0;
            background: var(--bg-light);
        }

        .venue-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .venue-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
        }

        .venue-image-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .venue-main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .venue-info-card {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .venue-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .venue-meta-list {
            list-style: none;
            padding: 0;
            margin: 0 0 24px 0;
        }

        .venue-meta-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .venue-meta-item:last-child {
            border-bottom: none;
        }

        .venue-meta-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(233, 69, 96, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.1rem;
        }

        .venue-meta-text {
            flex: 1;
        }

        .venue-meta-label {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .venue-meta-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .btn-reservasi {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-reservasi:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
            color: white;
        }

        .btn-login-reservasi {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-login-reservasi:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 26, 46, 0.3);
        }

        .reservation-notice {
            background: rgba(233, 69, 96, 0.1);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 16px;
            font-size: 0.85rem;
            color: var(--text-light);
            text-align: center;
        }

        .description-section {
            margin-top: 32px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .venue-description {
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            line-height: 1.8;
            color: var(--text-light);
        }

        .facilities-section {
            margin-top: 32px;
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            background: white;
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--bg-light);
            border-radius: 10px;
        }

        .facility-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(233, 69, 96, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        .facility-text {
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .footer {
            background: var(--primary);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }

        .footer-brand {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-brand i {
            color: var(--accent);
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            margin-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

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

            .venue-grid {
                grid-template-columns: 1fr;
            }

            .venue-info-card {
                position: static;
            }

            .venue-hero-title {
                font-size: 2rem;
            }

            .facilities-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .venue-hero {
                padding: 60px 0;
            }

            .venue-hero-title {
                font-size: 1.6rem;
            }

            .venue-hero-meta {
                flex-direction: column;
                gap: 12px;
            }

            .venue-main-image {
                height: 250px;
            }

            .venue-name {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand-custom" href="{{ url('/') }}">
                <i class="bi bi-building"></i>
                Bukutamu
            </a>

            <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon-custom"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="{{ route('venues.index') }}">Venue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ url('/') }}#cara-kerja">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ url('/') }}#tentang">Tentang</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="btn btn-masuk">Dashboard</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();" class="btn btn-daftar">Logout</a>
                        <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-masuk">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-daftar">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="venue-hero">
        <div class="venue-hero-content">
            <a href="{{ route('venues.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Daftar Venue
            </a>

            <h1 class="venue-hero-title">{{ $venue->nama_venue }}</h1>

            <div class="venue-hero-meta">
                <span>
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $venue->lokasi ?? 'Lokasi belum tersedia' }}
                </span>
                <span>
                    <i class="bi bi-people-fill"></i>
                    Kapasitas {{ $venue->kapasitas }} Orang
                </span>
            </div>
        </div>
    </section>

    <section class="venue-detail-section">
        <div class="venue-container">
            <div class="venue-grid">
                <div class="venue-content">
                    <div class="venue-image-card">
                        @if($venue->foto)
                            <img 
                                src="{{ asset('storage/' . $venue->foto) }}" 
                                alt="{{ $venue->nama_venue }}" 
                                class="venue-main-image"
                            >
                        @else
                            <img 
                                src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=800&q=80" 
                                alt="{{ $venue->nama_venue }}" 
                                class="venue-main-image"
                            >
                        @endif
                    </div>

                    <div class="description-section">
                        <h2 class="section-title">Deskripsi Venue</h2>
                        <div class="venue-description">
                            {{ $venue->deskripsi ?? 'Deskripsi venue belum tersedia.' }}
                        </div>
                    </div>

                    <div class="facilities-section">
                        <h2 class="section-title">Fasilitas</h2>
                        <div class="facilities-grid">
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <i class="bi bi-wifi"></i>
                                </div>
                                <span class="facility-text">WiFi Gratis</span>
                            </div>
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <i class="bi bi-p-circle"></i>
                                </div>
                                <span class="facility-text">Area Parkir</span>
                            </div>
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <i class="bi bi-snow"></i>
                                </div>
                                <span class="facility-text">AC</span>
                            </div>
                            <div class="facility-item">
                                <div class="facility-icon">
                                    <i class="bi bi-speaker"></i>
                                </div>
                                <span class="facility-text">Sound System</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="venue-info-card">
                    <h3 class="venue-name">{{ $venue->nama_venue }}</h3>

                    <ul class="venue-meta-list">
                        <li class="venue-meta-item">
                            <div class="venue-meta-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="venue-meta-text">
                                <div class="venue-meta-label">Lokasi</div>
                                <div class="venue-meta-value">{{ $venue->lokasi ?? 'Belum tersedia' }}</div>
                            </div>
                        </li>
                        <li class="venue-meta-item">
                            <div class="venue-meta-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="venue-meta-text">
                                <div class="venue-meta-label">Kapasitas</div>
                                <div class="venue-meta-value">{{ $venue->kapasitas }} Orang</div>
                            </div>
                        </li>
                        <li class="venue-meta-item">
                            <div class="venue-meta-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="venue-meta-text">
                                <div class="venue-meta-label">Status</div>
                                <div class="venue-meta-value">Tersedia</div>
                            </div>
                        </li>
                    </ul>

                    @auth
                        <a href="{{ route('customer.reservations.store', $venue->slug) }}" class="btn-reservasi">
                            <i class="bi bi-calendar-check"></i> Reservasi Sekarang
                        </a>
                        <p style="font-size: 0.8rem; color: var(--text-light); text-align: center; margin-top: 12px;">
                            <i class="bi bi-person"></i> {{ Auth::user()->name }}
                        </p>
                        <p style="font-size: 0.75rem; color: var(--text-light); text-align: center; margin-top: 8px;">
                            <a href="{{ route('customer.venues.show', $venue->slug) }}" style="color: var(--accent);">Lihat detail & reservasi lengkap</a>
                        </p>
                    @else
                        <a href="{{ route('register', ['redirect' => url()->current()]) }}" class="btn-reservasi">
                            <i class="bi bi-user-plus"></i> Daftar untuk Reservasi
                        </a>
                        <p style="font-size: 0.85rem; color: var(--text-light); text-align: center; margin-top: 16px;">
                            Sudah punya akun? <a href="{{ route('login', ['redirect' => url()->current()]) }}" style="color: var(--accent); font-weight: 600;">Masuk</a>
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <i class="bi bi-building"></i>
                        Bukutamu
                    </div>
                    <p class="footer-text">
                        Platform reservasi venue terpercaya untuk berbagai acara Anda.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 style="font-weight: 600; margin-bottom: 16px;">Menu</h6>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 8px;">
                            <a href="{{ url('/') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Beranda</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="{{ route('venues.index') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Venue</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="{{ url('/') }}#cara-kerja" style="color: rgba(255,255,255,0.7); text-decoration: none;">Cara Kerja</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 style="font-weight: 600; margin-bottom: 16px;">Akun</h6>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 8px;">
                            <a href="{{ route('login') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Masuk</a>
                        </li>
                        <li style="margin-bottom: 8px;">
                            <a href="{{ route('register') }}" style="color: rgba(255,255,255,0.7); text-decoration: none;">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; {{ date('Y') }} Bukutamu. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
