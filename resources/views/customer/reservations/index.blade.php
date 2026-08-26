<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi Saya - Bukutamu</title>
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

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        th {
            background: var(--bg-light);
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafafa;
        }

        .booking-code {
            font-weight: 700;
            color: var(--text-dark);
        }

        .venue-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .venue-location {
            color: var(--text-light);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-canceled {
            background: #f3f4f6;
            color: #6b7280;
        }

        .notes {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
        }

        .empty i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        .empty h3 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .empty p {
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .btn-cta {
            display: inline-block;
            padding: 12px 24px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .btn-cta:hover {
            background: #d63651;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
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

            .page-title-main {
                font-size: 1.5rem;
            }

            th,
            td {
                padding: 12px;
                font-size: 0.85rem;
            }

            .user-info {
                display: none;
            }

            .table-wrapper {
                margin: 0 -16px;
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
                    <a href="{{ route('customer.venues') }}" class="nav-item">
                        <i class="bi bi-search"></i>
                        Cari Venue
                    </a>
                    <a href="{{ route('customer.reservations') }}" class="nav-item active">
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
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
                    <h1 class="page-title">Reservasi Saya</h1>
                </div>

                <div class="topbar-right">
                    <div class="user-dropdown">
                        <div class="user-avatar">{{ substr(Auth::user()->name ?? 'U', 0, 2) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title-main">Reservasi Saya</h1>
                    <p class="page-subtitle">Riwayat reservasi venue Anda.</p>
                </div>

                <div class="card">
                    @if($reservations->count() > 0)

                        <div class="table-wrapper">

                            <table>

                                <thead>
                                    <tr>
                                        <th>Kode Booking</th>
                                        <th>Venue</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Peserta</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($reservations as $reservation)

                                        <tr>

                                            <td>
                                                <div class="booking-code">
                                                    {{ $reservation->kode_booking }}
                                                </div>
                                            </td>


                                            <td>

                                                <div class="venue-name">
                                                    {{ $reservation->venue->nama_venue ?? '-' }}
                                                </div>

                                                <div class="venue-location">
                                                    {{ $reservation->venue->lokasi ?? '-' }}
                                                </div>

                                            </td>


                                            <td>

                                                {{ \Carbon\Carbon::parse($reservation->tanggal_mulai)->format('d M Y') }}

                                                @if($reservation->tanggal_selesai && $reservation->tanggal_selesai != $reservation->tanggal_mulai)

                                                    <br>

                                                    <small class="venue-location">
                                                        sampai
                                                        {{ \Carbon\Carbon::parse($reservation->tanggal_selesai)->format('d M Y') }}
                                                    </small>

                                                @endif

                                            </td>


                                            <td>

                                                {{ \Carbon\Carbon::parse($reservation->waktu_mulai)->format('H:i') }}

                                                -

                                                {{ \Carbon\Carbon::parse($reservation->waktu_selesai)->format('H:i') }}

                                            </td>


                                            <td>
                                                {{ $reservation->jumlah_peserta }} orang
                                            </td>


                                            <td>

                                                @if($reservation->status === 'pending')

                                                    <span class="status status-pending">
                                                        Menunggu
                                                    </span>

                                                @elseif($reservation->status === 'approved')

                                                    <span class="status status-approved">
                                                        Disetujui
                                                    </span>

                                                @elseif($reservation->status === 'rejected')

                                                    <span class="status status-rejected">
                                                        Ditolak
                                                    </span>

                                                @else

                                                    <span class="status status-canceled">
                                                        Dibatalkan
                                                    </span>

                                                @endif

                                            </td>


                                            <td>
                                                @if($reservation->keterangan)
                                                    <span class="notes">{{ $reservation->keterangan }}</span>
                                                @else
                                                    <span class="notes">-</span>
                                                @endif
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="empty">

                            <i class="bi bi-calendar-x"></i>

                            <h3>
                                Belum ada reservasi.
                            </h3>

                            <p>
                                Pesan venue favorit Anda sekarang.
                            </p>

                            <a href="{{ route('customer.venues') }}" class="btn-cta">
                                <i class="bi bi-search"></i> Cari Venue
                            </a>

                        </div>

                    @endif

                </div>
            </div>
        </main>
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }
    </script>
</body>
</html>
