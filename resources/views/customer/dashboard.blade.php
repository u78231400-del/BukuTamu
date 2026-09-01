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
            font-weight: 600;
        }

        .nav-item.active i {
            color: var(--accent);
        }

        .nav-item i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
            pointer-events: auto;
        }

        .nav-section-title {
            pointer-events: none;
        }

        .nav-item {
            pointer-events: auto;
            position: relative;
            z-index: 1;
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
            top: 4px;
            right: 4px;
            background: var(--accent);
            color: white;
            font-size: 10px;
            font-weight: 700;
            min-width: 16px;
            height: 16px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
        }

        .notif-dropdown {
            width: 340px;
            padding: 0;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0,0,0,.12);
            margin-top: 10px !important;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .notif-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .notif-mark-read {
            font-size: 12px;
            color: var(--accent);
            text-decoration: none;
        }

        .notif-mark-read:hover {
            text-decoration: underline;
        }

        .notif-list {
            max-height: 320px;
            overflow-y: auto;
        }

        .notif-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            transition: background .15s ease;
            position: relative;
        }

        .notif-item:hover {
            background: var(--bg-light);
        }

        .notif-item.unread {
            background: var(--accent-light);
        }

        .notif-icon-wrap {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notif-icon-wrap i {
            font-size: 16px;
        }

        .notif-content {
            flex: 1;
            min-width: 0;
        }

        .notif-text {
            font-size: 13px;
            color: var(--text-dark);
            font-weight: 500;
            line-height: 1.4;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .notif-time {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 2px;
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
            margin-top: 6px;
        }

        .notif-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            color: var(--text-light);
        }

        .notif-empty i {
            font-size: 32px;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        .notif-empty span {
            font-size: 13px;
        }

        .notif-footer {
            display: block;
            text-align: center;
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
            text-decoration: none;
            border-top: 1px solid #e5e7eb;
        }

        .notif-footer:hover {
            background: var(--bg-light);
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

        .welcome-banner {
            background: var(--accent);
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
            background: rgba(255, 255, 255, 0.08);
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
            background: rgba(201, 169, 89, 0.12);
            color: #b8963f;
        }

        .stat-icon.primary {
            background: rgba(100, 116, 139, 0.1);
            color: #64748b;
        }

        .stat-icon.success {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
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
                        <div class="dropdown">
                            <a href="#" class="topbar-icon" data-bs-toggle="dropdown" aria-expanded="false" id="custNotifDropdown">
                                <i class="bi bi-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="notification-badge" style="width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center;">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end notif-dropdown" id="custNotifMenu">
                                <div class="notif-header">
                                    <span class="notif-title">Notifikasi</span>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a href="#" class="notif-mark-read" onclick="event.preventDefault(); markAllNotifications();">Tandai semua dibaca</a>
                                    @endif
                                </div>
                                <div class="notif-list">
                                    @forelse(auth()->user()->notifications->take(5) as $notif)
                                        <a href="{{ $notif->link ? route($notif->link) : '#' }}"
                                           class="notif-item {{ $notif->is_read ? 'read' : 'unread' }}"
                                           data-id="{{ $notif->id }}">
                                            <div class="notif-icon-wrap" style="background: {{ $notif->type === 'success' ? '#ecfdf5' : ($notif->type === 'warning' ? '#fffbeb' : ($notif->type === 'danger' ? '#fff1f2' : 'var(--accent-light)')) }};">
                                                <i class="bi {{ $notif->icon ?: 'bi-bell' }}" style="color: {{ $notif->type === 'success' ? '#16a34a' : ($notif->type === 'warning' ? '#ca8a04' : ($notif->type === 'danger' ? '#dc2626' : 'var(--accent)')) }};"></i>
                                            </div>
                                            <div class="notif-content">
                                                <div class="notif-text">{{ $notif->title }}</div>
                                                <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                                            </div>
                                            @if(!$notif->is_read)
                                                <div class="notif-dot"></div>
                                            @endif
                                        </a>
                                    @empty
                                        <div class="notif-empty">
                                            <i class="bi bi-bell-slash"></i>
                                            <span>Tidak ada notifikasi</span>
                                        </div>
                                    @endforelse
                                </div>
                                <a href="{{ route('notifications.index') }}" class="notif-footer">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a href="#" class="topbar-icon" data-bs-toggle="dropdown" aria-expanded="false" id="custMsgDropdown">
                                <i class="bi bi-chat-dots"></i>
                                @if(auth()->user()->unreadMessages->count() > 0)
                                    <span class="notification-badge" style="width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center;">{{ auth()->user()->unreadMessages->count() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end notif-dropdown" id="custMsgMenu">
                                <div class="notif-header">
                                    <span class="notif-title">Pesan</span>
                                </div>
                                <div class="notif-list">
                                    @forelse(auth()->user()->receivedMessages()->latest()->take(5)->get() as $msg)
                                        <a href="{{ route('messages.show', $msg->id) }}"
                                           class="notif-item {{ $msg->read_at ? 'read' : 'unread' }}">
                                            <div class="notif-icon-wrap" style="background: {{ $msg->read_at ? '#f8fafc' : 'var(--accent-light)' }};">
                                                <i class="bi bi-envelope" style="color: {{ $msg->read_at ? '#94a3b8' : 'var(--accent)' }};"></i>
                                            </div>
                                            <div class="notif-content">
                                                <div class="notif-text">{{ $msg->subject }}</div>
                                                <div class="notif-time">{{ $msg->created_at->diffForHumans() }}</div>
                                            </div>
                                            @if(!$msg->read_at)
                                                <div class="notif-dot"></div>
                                            @endif
                                        </a>
                                    @empty
                                        <div class="notif-empty">
                                            <i class="bi bi-inbox"></i>
                                            <span>Tidak ada pesan</span>
                                        </div>
                                    @endforelse
                                </div>
                                <a href="{{ route('messages.index') }}" class="notif-footer">
                                    Lihat semua pesan
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                        <i class="bi bi-chevron-down"></i>

                        <div class="dropdown-menu-custom" id="dropdown-menu">
                            <a href="{{ route('profile.index') }}" class="dropdown-item-custom">
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
                <div class="welcome-banner">
                    <div class="welcome-content">
                        <h2 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="welcome-subtitle">Temukan venue terbaik untuk acara spesialmu hari ini.</p>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon accent">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="stat-value">{{ $activeReservations }}</div>
                        <div class="stat-label">Reservasi Aktif</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon gold">
                            <i class="bi bi-heart-fill"></i>
                        </div>
                        <div class="stat-value">{{ $userFavoriteCount }}</div>
                        <div class="stat-label">Venue Favorit</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon primary">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-value">{{ $historyReservations }}</div>
                        <div class="stat-label">Riwayat Reservasi</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value">{{ $completedReservations }}</div>
                        <div class="stat-label">Reservasi Selesai</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="content-card">
                            <div class="content-card-header">
                                <h3 class="content-card-title">Venue Populer</h3>
                                <a href="{{ route('customer.venues') }}" class="btn-link">
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
                                <a href="{{ route('customer.venues') }}" class="quick-action-btn">
                                    <i class="bi bi-search"></i>
                                    <span>Cari Venue</span>
                                </a>
                                <a href="{{ route('customer.venues') }}" class="quick-action-btn">
                                    <i class="bi bi-calendar-plus"></i>
                                    <span>Reservasi Baru</span>
                                </a>
                                <a href="{{ route('customer.favorites') }}" class="quick-action-btn">
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

        document.querySelectorAll('.notif-item[data-id]').forEach(function(item) {
            item.addEventListener('click', function(e) {
                const notifId = this.dataset.id;
                fetch('/notifications/' + notifId + '/read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
            });
        });
    </script>
    <script>
    function markAllNotifications() {
        fetch('{{ route('notifications.markAllRead') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.notif-item.unread').forEach(item => {
                    item.classList.remove('unread');
                    item.classList.add('read');
                });
                document.querySelectorAll('.notif-dot').forEach(dot => dot.remove());
                document.querySelectorAll('.notification-badge').forEach(badge => badge.remove());
                document.querySelector('.notif-mark-read')?.remove();
            }
        });
    }
    </script>
</body>
</html>
