<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Bukutamu</title>
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

        .page-content {
            flex: 1;
            padding: 32px;
        }

        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 16px;
            padding: 32px;
            color: white;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: linear-gradient(135deg, rgba(233, 69, 96, 0.2) 0%, rgba(201, 169, 89, 0.1) 100%);
            border-radius: 50%;
            transform: rotate(-15deg);
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .stat-icon.accent {
            background: var(--accent-light);
            color: var(--accent);
        }

        .stat-icon.gold {
            background: rgba(201, 169, 89, 0.15);
            color: var(--gold);
        }

        .stat-icon.primary {
            background: rgba(26, 26, 46, 0.08);
            color: var(--primary);
        }

        .stat-icon.success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .content-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            margin-bottom: 24px;
        }

        .content-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .content-card-title {
            font-size: 1.1rem;
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

        .placeholder-content {
            min-height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            text-align: center;
            padding: 40px;
        }

        .placeholder-content i {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .placeholder-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .placeholder-content p {
            font-size: 0.95rem;
            max-width: 400px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .quick-action-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background: var(--bg-light);
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        .quick-action-btn i {
            font-size: 1.8rem;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .quick-action-btn span {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: center;
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

        @media (max-width: 1199px) {
            .stats-grid {
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

            .topbar-search {
                display: none;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-actions {
                grid-template-columns: repeat(2, 1fr);
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

            .welcome-banner {
                padding: 24px;
            }

            .welcome-title {
                font-size: 1.3rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 20px;
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
                    <a href="#" class="nav-item active">
                        <i class="bi bi-grid-1x2"></i>
                        Dashboard
                    </a>
                    <a href="#" class="nav-item">
                        <i class="bi bi-search"></i>
                        Cari Venue
                    </a>
                    <a href="#" class="nav-item">
                        <i class="bi bi-calendar-check"></i>
                        Reservasi Saya
                    </a>
                    <a href="#" class="nav-item">
                        <i class="bi bi-heart"></i>
                        Favorit
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Akun</div>
                    <a href="#" class="nav-item">
                        <i class="bi bi-person"></i>
                        Profil
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <form id="logout-form" action="#" method="POST">
                    <a href="#" class="nav-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1 class="page-title">Dashboard</h1>
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

                    <div class="user-dropdown">
                        <div class="user-avatar">JD</div>
                        <div class="user-info">
                            <div class="user-name">John Doe</div>
                            <div class="user-role">Customer</div>
                        </div>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="welcome-banner">
                    <div class="welcome-content">
                        <h2 class="welcome-title">Selamat Datang, John!</h2>
                        <p class="welcome-subtitle">Temukan venue terbaik untuk acara spesialmu hari ini.</p>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon accent">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Reservasi Aktif</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon gold">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Venue Favorit</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon primary">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Riwayat Reservasi</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Reservasi Selesai</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="content-card">
                            <div class="content-card-header">
                                <h3 class="content-card-title">Venue Populer</h3>
                                <a href="#" class="btn-link">
                                    Lihat Semua <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="placeholder-content">
                                <i class="bi bi-building"></i>
                                <h4>Belum Ada Venue</h4>
                                <p>Mulai jelajahi venue-venue terbaik untuk acara spesialmu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="content-card">
                            <div class="content-card-header">
                                <h3 class="content-card-title">Aksi Cepat</h3>
                            </div>
                            <div class="quick-actions">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-search"></i>
                                    <span>Cari Venue</span>
                                </a>
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-calendar-plus"></i>
                                    <span>Reservasi Baru</span>
                                </a>
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-heart"></i>
                                    <span>Favorit</span>
                                </a>
                            </div>
                        </div>
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

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                
                if (window.innerWidth < 992) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
