<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Bukutamu</title>
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

        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #f0f0f0;
            overflow: hidden;
            width: 100%;
            max-width: 900px;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 32px;
            text-align: center;
            color: white;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: white;
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0 auto 16px;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .profile-role {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .profile-body {
            padding: 32px;
        }

        .profile-info-item {
            display: flex;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-info-item:last-child {
            border-bottom: none;
        }

        .profile-info-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--accent-light);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 16px;
        }

        .profile-info-label {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .profile-info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .btn-edit {
            background: white;
            color: var(--accent);
            border: 2px solid var(--accent);
            padding: 10px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-edit:hover {
            background: var(--accent);
            color: white;
        }

        .profile-form-group {
            margin-bottom: 20px;
        }

        .profile-form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            display: block;
        }

        .profile-form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s ease;
        }

        .profile-form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-light);
        }

        .profile-form-control:disabled {
            background: var(--bg-light);
            color: var(--text-light);
            cursor: not-allowed;
        }

        .profile-form-control.is-invalid {
            border-color: #ef4444;
        }

        .profile-form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-save {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #d63651;
        }

        .btn-cancel {
            background: white;
            color: var(--text-dark);
            border: 1px solid #e5e7eb;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            background: var(--bg-light);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 6px;
        }

        .profile-actions {
            display: flex;
            justify-content: flex-end;
            padding: 0 32px 20px;
        }

        .profile-info-view {
            display: block;
        }

        .profile-info-edit {
            display: none;
        }

        .profile-info-edit.active {
            display: block;
        }

        .profile-info-view.hidden {
            display: none;
        }

        @media (max-width: 576px) {
            .profile-actions {
                padding: 0 20px 16px;
            }

            .profile-form-actions {
                flex-direction: column;
            }

            .btn-save, .btn-cancel {
                width: 100%;
                justify-content: center;
            }
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

            .profile-header {
                padding: 24px;
            }

            .profile-body {
                padding: 20px;
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
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" id="menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <h1 class="page-title">Profil</h1>
                </div>

                <div class="topbar-right">
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                        <div class="user-info">
                            <div class="user-name">{{ $user->name }}</div>
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
                <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                        <h2 class="profile-name">{{ $user->name }}</h2>
                        <p class="profile-role">{{ ucfirst($user->role ?? 'Customer') }}</p>
                    </div>
                    <div class="profile-body">
                        @if(session('success'))
                            <div class="alert-success">
                                <i class="bi bi-check-circle-fill"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert-danger">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <div class="profile-actions">
                            <button type="button" class="btn-edit" id="btn-edit-profile">
                                <i class="bi bi-pencil"></i>
                                Edit Profil
                            </button>
                        </div>

                        <div class="profile-info-view" id="profile-view">
                            <div class="profile-info-item">
                                <div class="profile-info-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div>
                                    <div class="profile-info-label">Nama Lengkap</div>
                                    <div class="profile-info-value">{{ $user->name }}</div>
                                </div>
                            </div>
                            <div class="profile-info-item">
                                <div class="profile-info-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <div class="profile-info-label">Email</div>
                                    <div class="profile-info-value">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="profile-info-item">
                                <div class="profile-info-icon">
                                    <i class="bi bi-shield"></i>
                                </div>
                                <div>
                                    <div class="profile-info-label">Role</div>
                                    <div class="profile-info-value">{{ ucfirst($user->role ?? 'Customer') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-info-edit" id="profile-edit">
                            <form action="{{ route('customer.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="profile-form-group">
                                    <label class="profile-form-label" for="name">Nama Lengkap</label>
                                    <input type="text" 
                                           class="profile-form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="profile-form-group">
                                    <label class="profile-form-label" for="email">Email</label>
                                    <input type="email" 
                                           class="profile-form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="profile-form-group">
                                    <label class="profile-form-label" for="role">Role</label>
                                    <input type="text" 
                                           class="profile-form-control" 
                                           id="role" 
                                           value="{{ ucfirst($user->role ?? 'Customer') }}"
                                           disabled>
                                </div>

                                <div class="profile-form-actions">
                                    <button type="submit" class="btn-save">
                                        <i class="bi bi-check-lg"></i>
                                        Simpan Perubahan
                                    </button>
                                    <button type="button" class="btn-cancel" id="btn-cancel">
                                        <i class="bi bi-x-lg"></i>
                                        Batal
                                    </button>
                                </div>
                            </form>
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

        const btnEdit = document.getElementById('btn-edit-profile');
        const btnCancel = document.getElementById('btn-cancel');
        const profileView = document.getElementById('profile-view');
        const profileEdit = document.getElementById('profile-edit');

        if (btnEdit && profileView && profileEdit) {
            btnEdit.addEventListener('click', function() {
                profileView.classList.add('hidden');
                profileEdit.classList.add('active');
                btnEdit.style.display = 'none';
            });

            btnCancel.addEventListener('click', function() {
                profileView.classList.remove('hidden');
                profileEdit.classList.remove('active');
                btnEdit.style.display = 'inline-flex';
            });
        }
    </script>
</body>
</html>
