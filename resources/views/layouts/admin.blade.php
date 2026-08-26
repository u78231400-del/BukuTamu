<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel') - Bukutamu
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --primary: #f0445d;
            --primary-dark: #dc354d;
            --primary-soft: #fff1f3;
            --primary-soft-hover: #ffe4e7;

            --dark: #1d1d35;
            --text: #475569;
            --muted: #94a3b8;

            --bg: #f8fafc;
            --border: #edf0f4;
            --white: #ffffff;

            --sidebar-width: 250px;
            --topbar-height: 76px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--dark);
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .admin-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;

            width: var(--sidebar-width);

            background: var(--white);

            border-right: 1px solid var(--border);

            display: flex;
            flex-direction: column;

            z-index: 1050;

            transition: transform .3s ease;
        }

        .brand {
            height: var(--topbar-height);

            display: flex;
            align-items: center;

            padding: 0 24px;

            border-bottom: 1px solid var(--border);
        }

        .brand-icon {
            width: 36px;
            height: 36px;

            border-radius: 10px;

            background: var(--primary-soft);
            color: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 10px;

            font-size: 18px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;

            color: var(--dark);
        }

        .brand-name span {
            color: var(--primary);
        }

        /* =========================
           NAVIGATION
        ========================= */

        .admin-nav {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-label {
            padding: 0 12px;
            margin-bottom: 8px;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .08em;

            color: #a1a8b5;
        }

        .admin-nav .nav-link {
            display: flex;
            align-items: center;

            height: 44px;

            padding: 0 12px;

            margin-bottom: 4px;

            border-radius: 10px;

            color: #64748b;

            font-size: 13px;
            font-weight: 500;

            text-decoration: none;

            transition: all .2s ease;
        }

        .admin-nav .nav-link i {
            width: 20px;

            margin-right: 10px;

            font-size: 16px;
        }

        .admin-nav .nav-link:hover {
            background: var(--primary-soft);
            color: var(--primary);
            transform: translateX(2px);
        }

        .admin-nav .nav-link.active {
            background: var(--primary);
            color: white;

            box-shadow:
                0 4px 12px rgba(240, 68, 93, .25);
        }

        /* =========================
           LOGOUT
        ========================= */

        .sidebar-bottom {
            padding: 12px;

            border-top: 1px solid var(--border);
        }

        .logout-link {
            color: #ef4444 !important;
        }

        .logout-link:hover {
            background: #fff1f2 !important;
            color: #dc2626 !important;
        }

        /* =========================
           MOBILE MENU TOGGLE
        ========================= */

        .mobile-toggle {
            display: none;

            position: fixed;

            top: 16px;
            left: 16px;

            width: 42px;
            height: 42px;

            background: var(--white);

            border: 1px solid var(--border);

            border-radius: 10px;

            align-items: center;
            justify-content: center;

            font-size: 20px;

            color: var(--dark);

            cursor: pointer;

            z-index: 1060;

            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }

        .sidebar-overlay {
            display: none;

            position: fixed;

            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            background: rgba(0,0,0,.4);

            z-index: 1040;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .admin-main {
            margin-left: var(--sidebar-width);

            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .admin-topbar {
            height: var(--topbar-height);

            background: var(--white);

            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 28px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-page-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--dark);
        }

        .topbar-page-subtitle {
            font-size: 12px;
            color: var(--muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification {
            width: 38px;
            height: 38px;

            border-radius: 10px;

            background: #f8fafc;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #64748b;

            text-decoration: none;

            border: none;
            cursor: pointer;
        }

        .notification:hover {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px 6px 6px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .topbar-profile:hover {
            background: var(--primary-soft);
            border-color: var(--primary-soft);
        }

        .topbar-profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
        }

        .topbar-profile-info {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .topbar-profile-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            line-height: 1.2;
        }

        .topbar-profile-role {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.2;
        }

        /* =========================
           CONTENT WRAPPER
        ========================= */

        .admin-content {
            padding: 28px;
        }

        /* =========================
           ALERT
        ========================= */

        .admin-alert {
            border: none;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-alert i {
            font-size: 18px;
        }

        .alert-success {
            background: #ecfdf3;
            color: #15803d;
        }

        .alert-danger {
            background: #fff1f2;
            color: #be123c;
        }

        .alert-warning {
            background: #fffbeb;
            color: #b45309;
        }

        /* =========================
           CARD
        ========================= */

        .admin-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, .04);
        }

        /* =========================
           BUTTONS
        ========================= */

        .btn-primary-custom {
            background: var(--primary);
            border: none;
            color: white;
            border-radius: 9px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s ease;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(240, 68, 93, .25);
        }

        .btn-secondary-custom {
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 9px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all .2s ease;
        }

        .btn-secondary-custom:hover {
            background: #f1f5f9;
            color: var(--dark);
        }

        .btn-sm-custom {
            padding: 6px 10px;
            font-size: 12px;
        }

        /* =========================
           TABLE
        ========================= */

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table thead th {
            background: #fafbfc;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .02em;
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .admin-table tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            color: #475569;
            vertical-align: middle;
        }

        .admin-table tbody tr {
            transition: background .15s ease;
        }

        .admin-table tbody tr:hover {
            background: #fffafb;
        }

        /* =========================
           STATUS BADGES
        ========================= */

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-approved {
            background: #ecfdf5;
            color: #15803d;
        }

        .status-rejected {
            background: #fff1f2;
            color: #be123c;
        }

        .status-available {
            background: #ecfdf5;
            color: #15803d;
        }

        .status-unavailable {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* =========================
           ACTION BUTTONS
        ========================= */

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-action-sm {
            width: 28px;
            height: 28px;
            font-size: 12px;
            border-radius: 6px;
        }

        .btn-edit {
            background: #fff7ed;
            color: #ea580c;
        }

        .btn-edit:hover {
            background: #ea580c;
            color: white;
        }

        .btn-delete {
            background: #fff1f2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        .btn-approve {
            background: #ecfdf5;
            color: #15803d;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-approve:hover {
            background: #16a34a;
            color: white;
            border-color: #16a34a;
        }

        .btn-reject {
            background: #fff1f2;
            color: #dc2626;
            border: 1px solid #fecdd3;
            border-radius: 8px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-reject:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        .action-group {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        /* =========================
           RESPONSIVE - TABLE SCROLL
        ========================= */

        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* =========================
           RESPONSIVE - TABLE CONTROLS
        ========================= */

        @media (max-width: 1024px) {
            .admin-table thead th,
            .admin-table tbody td {
                padding: 12px 10px;
            }
        }

        /* =========================
           RESPONSIVE - TABLETS
        ========================= */

        @media (max-width: 900px) {
            :root {
                --sidebar-width: 220px;
            }

            .admin-content {
                padding: 24px;
            }

            .admin-topbar {
                padding: 0 24px;
            }
        }

        /* =========================
           RESPONSIVE - MOBILE
        ========================= */

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 260px;
            }

            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .mobile-toggle {
                display: flex;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                padding-left: 70px;
            }

            .admin-content {
                padding: 20px 16px;
            }

            .topbar-page-subtitle {
                display: none;
            }
        }

        /* =========================
           RESPONSIVE - SMALL MOBILE
        ========================= */

        @media (max-width: 480px) {
            .admin-topbar {
                padding: 0 16px 0 70px;
            }

            .notification {
                display: none;
            }

            .admin-content {
                padding: 16px 12px;
            }

            .admin-card {
                border-radius: 12px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

{{-- MOBILE TOGGLE --}}
<button class="mobile-toggle" id="mobileToggle">
    <i class="bi bi-list"></i>
</button>

{{-- SIDEBAR OVERLAY --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- SIDEBAR --}}
<aside class="admin-sidebar" id="adminSidebar">

    {{-- BRAND --}}
    <div class="brand">

        <div class="brand-icon">
            <i class="bi bi-building"></i>
        </div>

        <div class="brand-name">
            Buku<span>tamu</span>
        </div>

    </div>


    {{-- NAV --}}
    <nav class="admin-nav">

        <div class="nav-label">
            Menu
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >
            <i class="bi bi-grid-1x2"></i>
            Dashboard
        </a>


        <a
            href="{{ route('admin.venues.index') }}"
            class="nav-link {{ request()->routeIs('admin.venues.*') ? 'active' : '' }}"
        >
            <i class="bi bi-geo-alt"></i>
            Venue
        </a>


        <a
            href="{{ route('admin.reservations.index') }}"
            class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}"
        >
            <i class="bi bi-calendar-check"></i>
            Reservasi
        </a>

    </nav>


    {{-- LOGOUT --}}
    <div class="sidebar-bottom">

        <a
            href="{{ route('logout') }}"
            class="nav-link logout-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
            style="display:none;"
        >
            @csrf
        </form>

    </div>

</aside>


{{-- MAIN --}}
<main class="admin-main">

    {{-- TOPBAR --}}
    <header class="admin-topbar">

        <div class="topbar-left">

            <div>
                <div class="topbar-page-title">
                    @yield('title', 'Admin Panel')
                </div>
                <div class="topbar-page-subtitle">
                    @yield('subtitle', 'Kelola venue dan reservasi')
                </div>
            </div>

        </div>


        <div class="topbar-right">

            <button class="notification" title="Notifikasi">
                <i class="bi bi-bell"></i>
            </button>

            <div class="topbar-profile">
                <div class="topbar-profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="topbar-profile-info">
                    <span class="topbar-profile-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <span class="topbar-profile-role">Administrator</span>
                </div>
            </div>

        </div>

    </header>


    {{-- PAGE CONTENT --}}
    <div class="admin-content">

        @yield('content')

    </div>

</main>


{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileToggle = document.getElementById('mobileToggle');
        const adminSidebar = document.getElementById('adminSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            adminSidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        }

        if (mobileToggle) {
            mobileToggle.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && adminSidebar.classList.contains('show')) {
                toggleSidebar();
            }
        });
    });
</script>

@stack('scripts')

</body>
</html>
