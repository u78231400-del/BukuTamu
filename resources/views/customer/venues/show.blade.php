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
            --accent-light: rgba(233, 69, 96, 0.1);
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
            background: var(--accent-light);
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

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 16px 32px;
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
            font-size: 1.4rem;
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
            padding: 6px 12px 6px 6px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .user-dropdown:hover {
            background: var(--bg-light);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--accent);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            text-align: left;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .user-dropdown i {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            border: 1px solid #e5e7eb;
            min-width: 180px;
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
            padding: 10px 14px;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
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
            font-size: 1.1rem;
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
            padding: 32px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
        }

        .venue-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 16px;
        }

        .venue-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .btn-favorite {
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid var(--accent);
            background: transparent;
            white-space: nowrap;
        }

        .btn-favorite.active {
            background: var(--accent-light);
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
            font-size: 1.2rem;
        }

        .venue-meta {
            display: flex;
            align-items: center;
            gap: 24px;
            color: var(--text-light);
            margin-bottom: 24px;
            font-size: 1rem;
        }

        .venue-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .venue-description h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .venue-description p {
            color: var(--text-light);
            line-height: 1.7;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            position: sticky;
            top: 100px;
        }

        .form-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
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
            min-height: 80px;
        }

        .form-hint {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-top: 4px;
        }

        .form-error {
            font-size: 0.8rem;
            color: #ef4444;
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-submit:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
        }

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.95rem;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
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
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <div class="dashboard-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="/" class="sidebar-logo">
                    <i class="bi bi-building"></i>
                    <span>Bukutamu</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Menu Utama</div>
                    <a href="{{ route('customer.dashboard') }}" class="nav-item">
                        <i class="bi bi-grid-1x2"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('customer.venues') }}" class="nav-item active">
                        <i class="bi bi-search"></i>
                        Cari Venue
                    </a>
                    <a href="{{ route('customer.reservations') }}" class="nav-item">
                        <i class="bi bi-calendar-check"></i>
                        Reservasi Saya
                    </a>
                    <a href="{{ route('customer.favorites') }}" class="nav-item">
                        <i class="bi bi-heart"></i>
                        Favorit
                    </a>
                </div>
            </nav>
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
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
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
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('customer.venues') }}" class="btn-back">
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

                        <div class="venue-description">
                            <h3>Deskripsi Ruangan</h3>
                            <p>{{ $venue->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="form-card">
                        <h2 class="form-title">Form Reservasi</h2>

                        <form action="{{ route('customer.reservations.store', $venue->slug) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input
                                    type="date"
                                    name="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}"
                                    min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
                                    class="form-input"
                                    required
                                >
                                @error('tanggal_mulai')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Selesai</label>
                                <input
                                    type="date"
                                    name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai') }}"
                                    min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
                                    class="form-input"
                                    required
                                >
                                @error('tanggal_selesai')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jam Mulai</label>
                                <input
                                    type="time"
                                    name="waktu_mulai"
                                    value="{{ old('waktu_mulai') }}"
                                    class="form-input"
                                    required
                                >
                                @error('waktu_mulai')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jam Selesai</label>
                                <input
                                    type="time"
                                    name="waktu_selesai"
                                    value="{{ old('waktu_selesai') }}"
                                    class="form-input"
                                    required
                                >
                                @error('waktu_selesai')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jumlah Peserta</label>
                                <input
                                    type="number"
                                    name="jumlah_peserta"
                                    value="{{ old('jumlah_peserta') }}"
                                    min="1"
                                    max="{{ $venue->kapasitas }}"
                                    class="form-input"
                                    required
                                >
                                <p class="form-hint">Maksimal {{ $venue->kapasitas }} orang</p>
                                @error('jumlah_peserta')
                                    <p class="form-error">{{ $message }}</p>
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
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn-submit">
                                Ajukan Reservasi
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
