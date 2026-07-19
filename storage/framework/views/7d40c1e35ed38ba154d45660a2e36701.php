<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'NurseCall'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --header-height: 64px;
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --dark: #1e293b;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --bg-body: #f1f5f9;
            --bg-card: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --transition: all 0.2s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; background: var(--bg-body); color: var(--gray-700); line-height: 1.6; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }
        ::selection { background: var(--primary-light); color: white; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--gray-300); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gray-400); }

        /* Sidebar */
        .sidebar { position: fixed; left: 0; top: 0; bottom: 0; width: var(--sidebar-width); background: var(--bg-card); border-right: 1px solid var(--gray-200); z-index: 1000; transition: var(--transition); display: flex; flex-direction: column; }
        .sidebar-brand { height: var(--header-height); display: flex; align-items: center; padding: 0 1.25rem; border-bottom: 1px solid var(--gray-200); gap: 0.75rem; }
        .sidebar-brand-icon { width: 36px; height: 36px; background: var(--primary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; }
        .sidebar-brand-text { font-size: 1.25rem; font-weight: 700; color: var(--gray-900); letter-spacing: -0.025em; }
        .sidebar-nav { flex: 1; padding: 1rem 0.75rem; overflow-y: auto; }
        .nav-section { margin-bottom: 1.5rem; }
        .nav-section-title { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-400); padding: 0 0.75rem; margin-bottom: 0.5rem; }
        .nav-item { margin-bottom: 2px; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.75rem; border-radius: var(--radius); color: var(--gray-600); font-size: 0.875rem; font-weight: 500; transition: var(--transition); }
        .nav-link i { width: 20px; text-align: center; font-size: 1rem; }
        .nav-link:hover { background: var(--gray-100); color: var(--gray-900); }
        .nav-link.active { background: var(--primary); color: white; }
        .nav-link.active i { color: white; }
        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--gray-200); }
        .user-card { display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem; border-radius: var(--radius); background: var(--gray-50); }
        .user-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; }
        .user-info { flex: 1; min-width: 0; }
        .user-name { font-size: 0.8rem; font-weight: 600; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 0.7rem; color: var(--gray-500); }

        /* Main Content */
        .main-wrapper { margin-left: var(--sidebar-width); transition: var(--transition); min-height: 100vh; }
        .header { height: var(--header-height); background: var(--bg-card); border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; padding: 0 1.5rem; position: sticky; top: 0; z-index: 100; }
        .header-left { display: flex; align-items: center; gap: 1rem; }
        .page-title { font-size: 1.1rem; font-weight: 600; color: var(--gray-900); }
        .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: var(--gray-500); }
        .breadcrumb a:hover { color: var(--primary); }
        .header-right { display: flex; align-items: center; gap: 0.75rem; }
        .header-btn { width: 38px; height: 38px; border-radius: var(--radius); border: 1px solid var(--gray-200); background: var(--bg-card); color: var(--gray-600); display: flex; align-items: center; justify-content: center; transition: var(--transition); position: relative; }
        .header-btn:hover { border-color: var(--primary); color: var(--primary); background: #eef2ff; }
        .notif-badge { position: absolute; top: -4px; right: -4px; width: 18px; height: 18px; background: var(--danger); color: white; font-size: 0.65rem; font-weight: 600; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid var(--bg-card); }
        .content { padding: 1.5rem; }

        /* Cards */
        .card { background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--gray-200); box-shadow: var(--shadow-sm); }
        .card-header { padding: 1rem 1.25rem; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 0.95rem; font-weight: 600; color: var(--gray-900); }
        .card-body { padding: 1.25rem; }
        .card-footer { padding: 1rem 1.25rem; border-top: 1px solid var(--gray-200); background: var(--gray-50); border-radius: 0 0 var(--radius-lg) var(--radius-lg); }

        /* Stats */
        .stat-card { background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--gray-200); padding: 1.25rem; display: flex; align-items: center; gap: 1rem; transition: var(--transition); }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .stat-icon { width: 48px; height: 48px; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
        .stat-icon.primary { background: #eef2ff; color: var(--primary); }
        .stat-icon.success { background: #d1fae5; color: var(--success); }
        .stat-icon.warning { background: #fef3c7; color: var(--warning); }
        .stat-icon.danger { background: #fee2e2; color: var(--danger); }
        .stat-icon.info { background: #cffafe; color: var(--info); }
        .stat-info { flex: 1; min-width: 0; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--gray-900); line-height: 1.2; }
        .stat-label { font-size: 0.8rem; color: var(--gray-500); margin-top: 2px; }
        .stat-trend { font-size: 0.75rem; font-weight: 500; display: inline-flex; align-items: center; gap: 2px; padding: 2px 6px; border-radius: 9999px; }
        .stat-trend.up { background: #d1fae5; color: var(--success); }
        .stat-trend.down { background: #fee2e2; color: var(--danger); }

        /* Tables */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-500); background: var(--gray-50); border-bottom: 1px solid var(--gray-200); }
        tbody td { padding: 0.875rem 1rem; border-bottom: 1px solid var(--gray-100); font-size: 0.875rem; color: var(--gray-700); vertical-align: middle; }
        tbody tr:hover { background: var(--gray-50); }
        tbody tr:last-child td { border-bottom: none; }
        .table-hover tbody tr { transition: var(--transition); }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; gap: 4px; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #cffafe; color: #0e7490; }
        .badge-gray { background: var(--gray-100); color: var(--gray-700); }
        .badge-primary { background: #eef2ff; color: var(--primary-dark); }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: var(--radius); font-size: 0.875rem; font-weight: 500; border: none; transition: var(--transition); cursor: pointer; white-space: nowrap; }
        .btn i { font-size: 0.9rem; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-success { background: var(--success); color: white; }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-warning { background: var(--warning); color: white; }
        .btn-warning:hover { background: #d97706; }
        .btn-outline { background: transparent; border: 1px solid var(--gray-300); color: var(--gray-700); }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); background: #eef2ff; }
        .btn-ghost { background: transparent; color: var(--gray-600); }
        .btn-ghost:hover { background: var(--gray-100); color: var(--gray-900); }
        .btn-sm { padding: 0.375rem 0.75rem; font-size: 0.8rem; }
        .btn-icon { width: 36px; height: 36px; padding: 0; border-radius: var(--radius); }
        .btn-icon.sm { width: 30px; height: 30px; font-size: 0.8rem; }

        /* Forms */
        .form-group { margin-bottom: 1rem; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 500; color: var(--gray-700); margin-bottom: 0.375rem; }
        .form-control { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid var(--gray-300); border-radius: var(--radius); font-size: 0.875rem; color: var(--gray-900); background: var(--bg-card); transition: var(--transition); }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .form-control::placeholder { color: var(--gray-400); }
        .input-group { display: flex; }
        .input-group .form-control { border-radius: var(--radius) 0 0 var(--radius); }
        .input-group-text { padding: 0.5rem 0.75rem; background: var(--gray-100); border: 1px solid var(--gray-300); border-left: none; border-radius: 0 var(--radius) var(--radius) 0; color: var(--gray-500); display: flex; align-items: center; font-size: 0.875rem; }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 80px; }

        /* Dropdown */
        .dropdown { position: relative; }
        .dropdown-menu { position: absolute; top: 100%; right: 0; margin-top: 0.5rem; background: var(--bg-card); border: 1px solid var(--gray-200); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); min-width: 180px; z-index: 50; opacity: 0; visibility: hidden; transform: translateY(-8px); transition: var(--transition); }
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1rem; font-size: 0.875rem; color: var(--gray-700); transition: var(--transition); }
        .dropdown-item:hover { background: var(--gray-50); color: var(--gray-900); }
        .dropdown-divider { height: 1px; background: var(--gray-200); margin: 0.25rem 0; }

        /* Alerts / Toasts */
        .alert { padding: 0.875rem 1rem; border-radius: var(--radius); border-left: 3px solid; font-size: 0.875rem; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
        .alert-success { background: #d1fae5; border-color: var(--success); color: #065f46; }
        .alert-danger { background: #fee2e2; border-color: var(--danger); color: #991b1b; }
        .alert-warning { background: #fef3c7; border-color: var(--warning); color: #92400e; }
        .alert-info { background: #cffafe; border-color: var(--info); color: #0e7490; }

        /* Toast Container */
        .toast-container { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; }
        .toast { background: var(--bg-card); border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); padding: 1rem; display: flex; align-items: center; gap: 0.75rem; min-width: 280px; max-width: 400px; border-left: 3px solid; animation: slideIn 0.3s ease; }
        .toast.success { border-color: var(--success); }
        .toast.error { border-color: var(--danger); }
        .toast-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .toast.success .toast-icon { background: #d1fae5; color: var(--success); }
        .toast.error .toast-icon { background: #fee2e2; color: var(--danger); }
        .toast-content { flex: 1; }
        .toast-title { font-size: 0.875rem; font-weight: 600; color: var(--gray-900); }
        .toast-message { font-size: 0.8rem; color: var(--gray-500); margin-top: 2px; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* Utilities */
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .grid { display: grid; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }
        .text-sm { font-size: 0.875rem; }
        .text-xs { font-size: 0.75rem; }
        .text-muted { color: var(--gray-500); }
        .text-success { color: var(--success); }
        .text-danger { color: var(--danger); }
        .fw-medium { font-weight: 500; }
        .fw-semibold { font-weight: 600; }
        .fw-bold { font-weight: 700; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 0.75rem; }
        .mt-4 { margin-top: 1rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .me-2 { margin-right: 0.5rem; }
        .ms-auto { margin-left: auto; }
        .p-4 { padding: 1rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .rounded { border-radius: var(--radius); }
        .rounded-lg { border-radius: var(--radius-lg); }
        .hidden { display: none; }
        .overflow-hidden { overflow: hidden; }
        .truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .w-full { width: 100%; }

        /* Mobile Menu Toggle */
        .mobile-toggle { display: none; width: 38px; height: 38px; border-radius: var(--radius); border: 1px solid var(--gray-200); background: var(--bg-card); color: var(--gray-600); align-items: center; justify-content: center; cursor: pointer; }
        .mobile-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 999; }
        .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 999; }

        /* Empty State */
        .empty-state { text-align: center; padding: 3rem 1rem; color: var(--gray-500); }
        .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: var(--gray-300); }
        .empty-state h4 { font-size: 1.1rem; font-weight: 600; color: var(--gray-700); margin-bottom: 0.5rem; }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.3s ease forwards; }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-wrapper { margin-left: 0; }
            .mobile-toggle { display: flex; }
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .content { padding: 1rem; }
            .header { padding: 0 1rem; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .card-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
            .page-title { font-size: 1rem; }
            .breadcrumb { display: none; }
            .stat-card { padding: 1rem; }
            .stat-value { font-size: 1.25rem; }
        }

        /* Print */
        @media print {
            .sidebar, .header, .btn, .mobile-toggle { display: none !important; }
            .main-wrapper { margin-left: 0 !important; }
            .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="fas fa-bell"></i>
            </div>
            <span class="sidebar-brand-text">NurseCall</span>
        </div>

        <nav class="sidebar-nav">
            <?php if(auth()->guard()->check()): ?>
            <div class="nav-section">
                <div class="nav-section-title">Menu Utama</div>
                <div class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/" class="nav-link <?php echo e(request()->is('/') || request()->is('bukutamu') ? 'active' : ''); ?>">
                        <i class="fas fa-book"></i>
                        <span>Buku Tamu</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/buat-janji" class="nav-link <?php echo e(request()->is('buat-janji') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Buat Janji</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/agenda" class="nav-link <?php echo e(request()->is('agenda') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Agenda</span>
                    </a>
                </div>
            </div>
            <?php else: ?>
            <div class="nav-section">
                <div class="nav-item">
                    <a href="/" class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </nav>

        <?php if(auth()->guard()->check()): ?>
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar"><?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?></div>
                <div class="user-info">
                    <div class="user-name"><?php echo e(Auth::user()->name); ?></div>
                    <div class="user-role">Administrator</div>
                </div>
                <button class="btn btn-ghost btn-icon sm" onclick="confirmLogout()" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </aside>

    <div class="main-wrapper">
        <header class="header">
            <div class="header-left">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="page-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
                    <?php if (! empty(trim($__env->yieldContent('breadcrumb')))): ?>
                    <div class="breadcrumb"><?php echo $__env->yieldContent('breadcrumb'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="header-right">
                <?php if(auth()->guard()->check()): ?>
                <a href="/dashboard" class="header-btn" title="Refresh">
                    <i class="fas fa-sync-alt"></i>
                </a>
                <div class="dropdown">
                    <button class="header-btn" onclick="toggleDropdown(this)" title="Menu">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/dashboard">
                            <i class="fas fa-chart-pie"></i> Dashboard
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="confirmLogout()">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </header>

        <main class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <form id="logout-form" method="POST" action="/logout" class="hidden">
        <?php echo csrf_field(); ?>
    </form>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function toggleDropdown(btn) {
            const menu = btn.nextElementSibling;
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });
            menu.classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            }
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: 'Anda akan keluar dari sistem.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/layouts/app.blade.php ENDPATH**/ ?>