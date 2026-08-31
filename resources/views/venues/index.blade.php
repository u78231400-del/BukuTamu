<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Venue - Bukutamu</title>
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
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 12px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            z-index: 1030;
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

        .hero-search {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 56px 0 72px;
            margin-bottom: 0;
        }

        .hero-search-title {
            color: white;
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 14px;
            text-align: center;
        }

        .hero-search-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.6;
            text-align: center;
            margin-bottom: 30px;
        }

        .search-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .search-form {
            background: white;
            border-radius: 16px;
            padding: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .search-icon-wrapper {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 1.2rem;
            padding-left: 12px;
        }

        .search-input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .btn-search {
            background: var(--accent);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: #d63651;
        }

        .venues-section {
            padding: 56px 0 72px;
            background: var(--bg-light);
            min-height: 60vh;
        }

        .section-header {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1.3;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .venues-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }

        .venue-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .venue-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .venue-image-wrapper {
            position: relative;
            height: 210px;
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

        .venue-category {
            position: absolute;
            top: 12px;
            left: 12px;
            background: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .venue-body {
            padding: 22px;
        }

        .venue-name {
            font-size: 1.15rem;
            font-weight: 600;
            line-height: 1.4;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .venue-info {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 10px;
        }

        .venue-location {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--text-light);
        }

        .venue-capacity {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.9rem;
            line-height: 1.5;
            color: var(--text-light);
            margin-bottom: 18px;
        }

        .venue-price {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--text-light);
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .empty-state p {
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .empty-state .btn-primary {
            background: var(--accent);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .empty-state .btn-primary:hover {
            background: #d63651;
        }

        .footer {
            background: var(--primary);
            color: white;
            padding: 40px 0 20px;
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

        @media (max-width: 1199px) {
            .venues-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
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

            .venues-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .venues-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .search-form {
                flex-direction: column;
                padding: 16px;
            }

            .search-icon-wrapper {
                display: none;
            }

            .search-input {
                width: 100%;
                text-align: center;
            }

            .btn-search {
                width: 100%;
            }

            .hero-search-title {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 576px) {
            .venues-grid {
                grid-template-columns: 1fr;
            }

            .hero-search {
                padding: 48px 0 56px;
            }

            .section-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
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
                    <a href="{{ route('login') }}" class="btn btn-masuk">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-daftar">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-search">
        <div class="container">
            <h1 class="hero-search-title">Temukan Venue Impian Anda</h1>
            <p class="hero-search-subtitle">Jelajahi berbagai venue terbaik untuk acara spesial Anda.</p>

            <div class="search-container">
                <form action="{{ route('venues.index') }}" method="GET" class="search-form">
                    <div class="search-icon-wrapper">
                        <i class="bi bi-search"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input" 
                        placeholder="Cari venue, lokasi, atau jenis acara..." 
                        value="{{ request('search') }}"
                    >
                    <button type="submit" class="btn-search">Cari</button>
                </form>
            </div>
        </div>
    </section>

    <section class="venues-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Venue Tersedia</h2>
                <p class="section-subtitle">Berikut adalah venue yang siap untuk dipesan.</p>
            </div>

            <div class="venues-grid">
                @forelse($venues as $venue)
                    <div class="venue-card">
                        <div class="venue-image-wrapper">
                            @if($venue->foto)
                                <img 
                                    src="{{ asset('storage/' . $venue->foto) }}" 
                                    alt="{{ $venue->nama_venue }}" 
                                    class="venue-image"
                                >
                            @else
                                <img 
                                    src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=600&q=80" 
                                    alt="{{ $venue->nama_venue }}" 
                                    class="venue-image"
                                >
                            @endif
                            <span class="venue-category">Venue</span>
                        </div>

                        <div class="venue-body">
                            <h3 class="venue-name">{{ $venue->nama_venue }}</h3>

                            <div class="venue-info">
                                <span class="venue-location">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $venue->lokasi ?? 'Lokasi tidak tersedia' }}
                                </span>
                            </div>

                            <div class="venue-capacity">
                                <i class="bi bi-people"></i>
                                Kapasitas {{ $venue->kapasitas }} orang
                            </div>

                            <a
                                href="{{ route('venues.show', $venue->slug) }}"
                                class="btn-detail"
                            >
                                @auth
                                    Lihat Detail & Reservasi
                                @else
                                    Lihat Detail
                                @endauth
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-building"></i>
                        <h3>Venue Tidak Ditemukan</h3>
                        <p>
                            @if(request('search'))
                                Maaf, tidak ada venue yang cocok dengan "{{ request('search') }}".
                            @else
                                Maaf, belum ada venue yang tersedia saat ini.
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('venues.index') }}" class="btn-primary">
                                Lihat Semua Venue
                            </a>
                        @endif
                    </div>
                @endforelse
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
                        <li style="margin-bottom: 8px;">
                            <a href="{{ url('/') }}#tentang" style="color: rgba(255,255,255,0.7); text-decoration: none;">Tentang</a>
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
