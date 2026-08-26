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

        .topbar-search {
            position: relative;
        }

        .topbar-search input {
            width: 280px;
            padding: 10px 16px 10px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-light);
            transition: all 0.2s ease;
        }

        .topbar-search input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
        }

        .topbar-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .topbar-icons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .topbar-icon:hover {
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
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

        .page-header {
            margin-bottom: 32px;
        }

        .page-title-main {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 1rem;
            color: var(--text-light);
        }

        .search-filter-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            margin-bottom: 32px;
        }

        .search-form {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-input-group {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-input-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .search-input-group input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s ease;
        }

        .search-input-group input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(233, 69, 96, 0.1);
        }

        .filter-select {
            min-width: 180px;
        }

        .filter-select select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .filter-select select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(233, 69, 96, 0.1);
        }

        .btn-search {
            padding: 14px 32px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-search:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .btn-link {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-link:hover {
            color: #d63651;
        }

        .venues-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .venue-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .venue-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
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

        .venue-favorite-btn {
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
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            z-index: 10;
        }

        .venue-favorite-btn:hover {
            color: var(--accent);
            background: var(--accent-light);
            transform: scale(1.1);
        }

        .venue-favorite-btn.active {
            color: var(--accent);
            background: var(--accent-light);
        }

        .venue-favorite-btn i {
            font-size: 1.2rem;
        }

        .venue-favorite-btn.loading {
            pointer-events: none;
        }

        .venue-favorite-btn.loading i {
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .venue-body {
            padding: 20px;
        }

        .venue-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .venue-info {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px;
        }

        .venue-location {
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

        .venue-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .venue-price span {
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
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: white;
        }

        .empty-state {
            background: white;
            border-radius: 16px;
            padding: 60px 20px;
            text-align: center;
            border: 1px solid #f0f0f0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
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
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .empty-state p {
            color: var(--text-light);
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

        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: white;
            border-radius: 10px;
            padding: 16px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
            animation: slideIn 0.3s ease;
        }

        .toast.error {
            border-left: 4px solid #ef4444;
        }

        .toast.success {
            border-left: 4px solid #22c55e;
        }

        .toast i {
            font-size: 1.3rem;
        }

        .toast.error i {
            color: #ef4444;
        }

        .toast.success i {
            color: #22c55e;
        }

        .toast-message {
            font-size: 0.9rem;
            color: var(--text-dark);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 1199px) {
            .venues-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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

            .venues-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-form {
                flex-direction: column;
            }

            .search-input-group,
            .filter-select {
                min-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .topbar {
                padding: 12px 16px;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .topbar-search {
                display: none;
            }

            .page-content {
                padding: 20px 16px;
            }

            .page-title-main {
                font-size: 1.5rem;
            }

            .search-filter-section {
                padding: 20px;
            }

            .venues-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .user-info {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>
    <div class="toast-container" id="toastContainer"></div>

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
                    <h1 class="page-title">Cari Venue</h1>
                </div>

                <div class="topbar-right">
                    <div class="topbar-search">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Cari venue...">
                    </div>

                    <div class="topbar-icons">
                        <a href="#" class="topbar-icon">
                            <i class="bi bi-bell"></i>
                            <span class="notification-badge"></span>
                        </a>
                        <a href="#" class="topbar-icon">
                            <i class="bi bi-chat-dots"></i>
                        </a>
                    </div>

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
                <div class="page-header">
                    <h1 class="page-title-main">Cari Venue</h1>
                    <p class="page-subtitle">Temukan tempat terbaik untuk acara spesialmu.</p>
                </div>

                <div class="search-filter-section">
                    <form class="search-form">
                        <div class="search-input-group">
                            <i class="bi bi-search"></i>
                            <input type="text" placeholder="Cari nama venue atau lokasi...">
                        </div>

                        <div class="filter-select">
                            <select>
                                <option value="">Semua Lokasi</option>
                                <option value="jakarta">Jakarta</option>
                                <option value="bandung">Bandung</option>
                                <option value="yogyakarta">Yogyakarta</option>
                                <option value="surabaya">Surabaya</option>
                                <option value="bali">Bali</option>
                            </select>
                        </div>

                        <div class="filter-select">
                            <select>
                                <option value="">Semua Kategori</option>
                                <option value="aula">Aula</option>
                                <option value="pernikahan">Pernikahan</option>
                                <option value="meeting">Meeting</option>
                                <option value="jamuan">Jamuan</option>
                                <option value="lomba">Lomba</option>
                                <option value="seminar">Seminar</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-search">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>
                    </form>
                </div>

                <div class="section-header">
                    <h2 class="section-title">Venue Tersedia</h2>
                    <a href="{{ route('customer.favorites') }}" class="btn-link">
                        Lihat Favorit <i class="bi bi-heart"></i>
                    </a>
                </div>

                <div class="venues-grid">

                    @forelse($venues as $venue)

                        <div class="venue-card">

                            <div class="venue-image-wrapper">

                                <img
                                    src="{{ $venue->foto ? asset('storage/' . $venue->foto) : 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=600&q=80' }}"
                                    alt="{{ $venue->nama_venue }}"
                                    class="venue-image"
                                >

                                <span class="venue-category">
                                    Venue
                                </span>

                                @if(Auth::check())
                                    <button
                                        type="button"
                                        class="venue-favorite-btn {{ in_array($venue->id, $favoriteVenueIds) ? 'active' : '' }}"
                                        data-venue-id="{{ $venue->id }}"
                                        data-is-favorite="{{ in_array($venue->id, $favoriteVenueIds) ? 'true' : 'false' }}"
                                        title="{{ in_array($venue->id, $favoriteVenueIds) ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}"
                                    >
                                        <i class="bi {{ in_array($venue->id, $favoriteVenueIds) ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="venue-favorite-btn" title="Login untuk menambahkan favorit">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                @endif

                            </div>

                            <div class="venue-body">

                                <h3 class="venue-name">
                                    {{ $venue->nama_venue }}
                                </h3>

                                <div class="venue-info">

                                    <span class="venue-location">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $venue->lokasi ?? 'Lokasi belum tersedia' }}
                                    </span>

                                </div>

                                <div class="venue-price">
                                    Kapasitas {{ $venue->kapasitas }} orang
                                </div>

                                <a
                                    href="{{ route('customer.venues.show', $venue->slug) }}"
                                    class="btn-detail"
                                >
                                    Lihat Detail
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="empty-state" style="grid-column: 1 / -1;">
                            <i class="bi bi-building"></i>
                            <h3>Belum ada venue tersedia</h3>
                            <p>Belum ada venue yang dapat dipesan saat ini.</p>
                        </div>

                    @endforelse

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

        function showToast(message, type = 'error') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="bi ${type === 'error' ? 'bi-exclamation-circle' : 'bi-check-circle'}"></i>
                <span class="toast-message">${message}</span>
            `;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        document.querySelectorAll('.venue-favorite-btn[data-venue-id]').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const btn = this;
                const venueId = btn.dataset.venueId;
                const isFavorite = btn.dataset.isFavorite === 'true';
                const icon = btn.querySelector('i');

                if (btn.classList.contains('loading')) {
                    return;
                }

                btn.classList.add('loading');
                const originalIconClass = icon.className;
                icon.className = 'bi bi-arrow-repeat';

                const wasFavorite = isFavorite;
                if (wasFavorite) {
                    btn.classList.remove('active');
                    icon.className = 'bi bi-heart';
                    btn.dataset.isFavorite = 'false';
                } else {
                    btn.classList.add('active');
                    icon.className = 'bi bi-heart-fill';
                    btn.dataset.isFavorite = 'true';
                }

                const url = wasFavorite
                    ? `/customer/favorites/${venueId}`
                    : `/customer/favorites/${venueId}`;

                const method = wasFavorite ? 'DELETE' : 'POST';

                fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(function(response) {
                    if (response.status === 401) {
                        window.location.href = '{{ route("login") }}';
                        return null;
                    }

                    if (!response.ok) {
                        throw new Error('Request failed');
                    }

                    return response.json();
                })
                .then(function(data) {
                    btn.classList.remove('loading');
                    if (data && data.success) {
                        if (!wasFavorite) {
                            btn.classList.add('active');
                            icon.className = 'bi bi-heart-fill';
                            btn.dataset.isFavorite = 'true';
                        }
                    }
                })
                .catch(function(error) {
                    btn.classList.remove('loading');

                    if (wasFavorite) {
                        btn.classList.add('active');
                        icon.className = 'bi bi-heart-fill';
                        btn.dataset.isFavorite = 'true';
                    } else {
                        btn.classList.remove('active');
                        icon.className = 'bi bi-heart';
                        btn.dataset.isFavorite = 'false';
                    }

                    showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                });
            });
        });
    </script>
</body>
</html>
