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
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-logo i {
            font-size: 1.8rem;
            color: var(--accent);
        }

        .sidebar-logo span {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        .nav-item:hover {
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .nav-item.active {
            background: rgba(233, 69, 96, 0.1);
            color: var(--accent);
        }

        .nav-item.active i {
            color: var(--accent);
        }

        .nav-item i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #f0f0f0;
        }

        .nav-item.logout {
            color: #ef4444;
        }

        .nav-item.logout:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 20px 40px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
        }

        .menu-toggle:hover {
            background: var(--bg-light);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px 8px 8px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .user-dropdown:hover {
            background: var(--bg-light);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--accent);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .user-dropdown i {
            color: var(--text-light);
            font-size: 1rem;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            border: 1px solid #e5e7eb;
            min-width: 200px;
            padding: 8px;
            display: none;
            z-index: 100;
        }

        .dropdown-menu-custom.show {
            display: block;
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-item-custom:hover {
            background: var(--bg-light);
        }

        .dropdown-item-custom i {
            font-size: 1.2rem;
            color: var(--text-light);
        }

        .dropdown-item-custom.text-danger {
            color: #ef4444;
        }

        .dropdown-item-custom.text-danger:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .dropdown-item-custom.text-danger i {
            color: #ef4444;
        }

        .page-content {
            flex: 1;
            padding: 40px 48px;
            max-width: 1400px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 32px;
        }

        .content-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
        }

        .venue-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .venue-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.3;
        }

        .btn-favorite {
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid var(--accent);
            background: transparent;
            white-space: nowrap;
        }

        .btn-favorite.active {
            background: rgba(233, 69, 96, 0.1);
            color: var(--accent);
        }

        .btn-favorite:hover {
            background: var(--accent);
            color: white;
        }

        .btn-favorite.active:hover {
            background: var(--accent);
            color: white;
        }

        .btn-favorite i {
            font-size: 1.3rem;
        }

        .venue-meta {
            display: flex;
            align-items: center;
            gap: 32px;
            color: var(--text-light);
            margin-bottom: 28px;
            font-size: 1.1rem;
        }

        .venue-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .venue-meta i {
            color: var(--accent);
        }

        .venue-image-container {
            width: 100%;
            height: 420px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
        }

        .venue-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .venue-description-customer {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #f0f0f0;
        }

        .venue-description-customer h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .venue-description-customer p {
            color: var(--text-light);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .facilities-grid-customer {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .facility-item-customer {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: var(--bg-light);
            border-radius: 10px;
        }

        .facility-icon-customer {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(233, 69, 96, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-size: 0.9rem;
        }

        .facility-text-customer {
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
            position: sticky;
            top: 100px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(233, 69, 96, 0.1);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        .form-hint {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 6px;
        }

        .form-error {
            font-size: 0.85rem;
            color: #ef4444;
            margin-top: 6px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.3);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .btn-back-customer {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 24px;
            transition: all 0.2s ease;
        }

        .btn-back-customer:hover {
            color: #d63651;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        .overlay.active {
            display: block;
        }

        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .form-card {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 12px 16px;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .page-content {
                padding: 20px 16px;
            }

            .venue-header {
                flex-direction: column;
            }

            .venue-title {
                font-size: 1.5rem;
            }

            .venue-meta {
                flex-wrap: wrap;
                gap: 12px;
            }

            .user-info {
                display: none;
            }

            .venue-image-container {
                height: 280px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <div class="dashboard-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('customer.dashboard') }}" class="sidebar-logo">
                    <i class="bi bi-building"></i>
                    <span>Bukutamu</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <a href="{{ route('customer.dashboard') }}" class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i>
                        Dashboard
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <a href="{{ route('customer.venues') }}" class="nav-item {{ request()->routeIs('customer.venues*') ? 'active' : '' }}">
                        <i class="bi bi-search"></i>
                        Cari Venue
                    </a>
                    <a href="{{ route('customer.reservations') }}" class="nav-item {{ request()->routeIs('customer.reservations') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        Reservasi Saya
                    </a>
                    <a href="{{ route('customer.favorites') }}" class="nav-item {{ request()->routeIs('customer.favorites*') ? 'active' : '' }}">
                        <i class="bi bi-heart"></i>
                        Favorit
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-item logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1 class="page-title">Detail Venue</h1>
                </div>

                <div class="topbar-right">
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                        <i class="bi bi-chevron-down"></i>

                        <div class="dropdown-menu-custom" id="dropdown-menu">
                            <a href="{{ route('customer.profile') }}" class="dropdown-item-custom">
                                <i class="bi bi-person"></i>
                                Profil
                            </a>
                            <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item-custom text-danger">
                                    <i class="bi bi-box-arrow-right"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="bi bi-x-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('customer.venues') }}" class="btn-back-customer">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Daftar Venue
                </a>

                <div class="content-grid">
                    <div class="content-card">
                        <div class="venue-header">
                            <h1 class="venue-title">{{ $venue->nama_venue }}</h1>

                            @if($isFavorite)
                                <form action="{{ route('customer.favorites.destroy', $venue->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-favorite active" title="Hapus dari favorit">
                                        <i class="bi bi-heart-fill"></i>
                                        <span>Hapus Favorit</span>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('customer.favorites.store', $venue->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-favorite" title="Tambah ke favorit">
                                        <i class="bi bi-heart"></i>
                                        <span>Tambah Favorit</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="venue-meta">
                            <span>
                                <i class="bi bi-geo-alt"></i>
                                {{ $venue->lokasi ?? 'Lokasi belum diatur' }}
                            </span>
                            <span>
                                <i class="bi bi-people"></i>
                                Kapasitas: {{ $venue->kapasitas }} Orang
                            </span>
                        </div>

                        @if($venue->foto)
                            <div class="venue-image-container">
                                <img
                                    src="{{ asset('storage/' . $venue->foto) }}"
                                    alt="{{ $venue->nama_venue }}"
                                >
                            </div>
                        @endif

                        <div class="venue-description-customer">
                            <h3>Deskripsi Ruangan</h3>
                            <p>{{ $venue->deskripsi ?? 'Deskripsi venue belum tersedia.' }}</p>
                        </div>

                        @if($venue->fasilitas && is_array($venue->fasilitas) && count($venue->fasilitas) > 0)
                            <div class="venue-description-customer">
                                <h3>Fasilitas</h3>
                                <div class="facilities-grid-customer">
                                    @foreach($venue->fasilitas as $fasilitas)
                                        @php
                                            $fasilitasConfig = [
                                                'wifi' => ['icon' => 'bi-wifi', 'label' => 'WiFi Gratis'],
                                                'parkir' => ['icon' => 'bi-p-circle', 'label' => 'Area Parkir'],
                                                'ac' => ['icon' => 'bi-snow', 'label' => 'AC'],
                                                'sound_system' => ['icon' => 'bi-speaker', 'label' => 'Sound System'],
                                                'proyektor' => ['icon' => 'bi bi-projector', 'label' => 'Proyektor'],
                                                'whiteboard' => ['icon' => 'bi bi-easel2', 'label' => 'Whiteboard'],
                                                'tv' => ['icon' => 'bi bi-tv', 'label' => 'TV/Layar'],
                                                'telepon' => ['icon' => 'bi bi-telephone', 'label' => 'Telepon Konferensi'],
                                            ];
                                            $config = $fasilitasConfig[$fasilitas] ?? ['icon' => 'bi-check-circle', 'label' => ucfirst($fasilitas)];
                                        @endphp
                                        <div class="facility-item-customer">
                                            <div class="facility-icon-customer">
                                                <i class="bi {{ $config['icon'] }}"></i>
                                            </div>
                                            <span class="facility-text-customer">{{ $config['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-card">
                        <h2 class="form-title">
                            <i class="bi bi-building" style="color: var(--accent);"></i>
                            {{ $venue->nama_venue }}
                        </h2>

                        <ul class="venue-meta-list" style="list-style: none; padding: 0; margin: 0 0 20px 0;">
                            <li class="venue-meta-item" style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="venue-meta-icon" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(233, 69, 96, 0.1); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--text-light);">Lokasi</div>
                                    <div style="font-size: 0.95rem; font-weight: 600; color: var(--text-dark);">{{ $venue->lokasi ?? 'Belum tersedia' }}</div>
                                </div>
                            </li>
                            <li class="venue-meta-item" style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="venue-meta-icon" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(233, 69, 96, 0.1); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--text-light);">Kapasitas</div>
                                    <div style="font-size: 0.95rem; font-weight: 600; color: var(--text-dark);">{{ $venue->kapasitas }} Orang</div>
                                </div>
                            </li>
                            <li class="venue-meta-item" style="display: flex; align-items: center; gap: 12px; padding: 10px 0;">
                                <div class="venue-meta-icon" style="width: 36px; height: 36px; border-radius: 8px; background: rgba(233, 69, 96, 0.1); display: flex; align-items: center; justify-content: center; color: var(--accent);">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <div style="font-size: 0.75rem; color: var(--text-light);">Status</div>
                                    <div style="font-size: 0.95rem; font-weight: 600; color: #16a34a;">Tersedia</div>
                                </div>
                            </li>
                        </ul>

                        <h2 class="form-title" style="border-top: 2px solid #f0f0f0; padding-top: 20px; margin-top: 8px;">
                            <i class="bi bi-calendar-check" style="color: var(--accent);"></i>
                            Form Reservasi
                        </h2>

                        <form action="{{ route('customer.reservations.store', $venue->slug) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai', \Carbon\Carbon::today()->addDays(2)->format('Y-m-d')) }}"
                                    min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
                                    class="form-input @error('tanggal_mulai') is-invalid @enderror"
                                    required
                            >
                                @error('tanggal_mulai')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Selesai</label>
                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', \Carbon\Carbon::today()->addDays(2)->format('Y-m-d')) }}"
                                    min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
                                    class="form-input @error('tanggal_selesai') is-invalid @enderror"
                                    required
                                >
                                @error('tanggal_selesai')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jam Mulai</label>
                                <input
                                    type="time"
                                    name="waktu_mulai"
                                    value="{{ old('waktu_mulai', '09:00') }}"
                                    class="form-input @error('waktu_mulai') is-invalid @enderror"
                                    required
                                >
                                @error('waktu_mulai')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jam Selesai</label>
                                <input
                                    type="time"
                                    name="waktu_selesai"
                                    value="{{ old('waktu_selesai', '17:00') }}"
                                    class="form-input @error('waktu_selesai') is-invalid @enderror"
                                    required
                                >
                                @error('waktu_selesai')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jumlah Peserta</label>
                                <input
                                    type="number"
                                    name="jumlah_peserta"
                                    value="{{ old('jumlah_peserta', '1') }}"
                                    min="1"
                                    max="{{ $venue->kapasitas }}"
                                    class="form-input @error('jumlah_peserta') is-invalid @enderror"
                                    required
                                >
                                <p class="form-hint">Maksimal {{ $venue->kapasitas }} orang</p>
                                @error('jumlah_peserta')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Keterangan / Keperluan</label>
                                <textarea
                                    name="keterangan"
                                    rows="3"
                                    class="form-input"
                                    placeholder="Contoh: Rapat Koordinasi Tim"
                                >{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <p class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send"></i> Ajukan Reservasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const overlay = document.getElementById('overlay');
        const userDropdown = document.getElementById('user-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
