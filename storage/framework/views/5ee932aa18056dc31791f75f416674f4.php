<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NurseCall - Sistem Buku Tamu & Penjadwalan Janji</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
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
            --radius: 0.5rem;
            --shadow-lg: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; min-height: 100vh; display: flex; background: var(--gray-50); }
        .login-left { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 3rem; background: white; position: relative; overflow: hidden; }
        .login-left::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle at 30% 30%, rgba(79, 70, 229, 0.05) 0%, transparent 50%), radial-gradient(circle at 70% 70%, rgba(79, 70, 229, 0.03) 0%, transparent 50%); }
        .login-card { width: 100%; max-width: 400px; position: relative; z-index: 1; }
        .brand { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2.5rem; }
        .brand-icon { width: 44px; height: 44px; background: var(--primary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem; }
        .brand-text { font-size: 1.5rem; font-weight: 700; color: var(--gray-900); letter-spacing: -0.025em; }
        .login-title { font-size: 1.5rem; font-weight: 700; color: var(--gray-900); margin-bottom: 0.5rem; }
        .login-subtitle { font-size: 0.9rem; color: var(--gray-500); margin-bottom: 2rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 500; color: var(--gray-700); margin-bottom: 0.375rem; }
        .input-wrap { position: relative; }
        .input-wrap .form-control { width: 100%; padding: 0.625rem 0.75rem 0.625rem 2.75rem; border: 1px solid var(--gray-200); border-radius: var(--radius); font-size: 0.9rem; color: var(--gray-900); background: var(--gray-50); transition: all 0.2s ease; }
        .input-wrap .form-control:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .input-wrap .form-icon { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 1rem; pointer-events: none; }
        .input-wrap .form-control.is-invalid { border-color: #ef4444; }
        .text-danger { font-size: 0.75rem; color: #ef4444; margin-top: 0.375rem; display: block; }
        .btn-primary { width: 100%; padding: 0.75rem; background: var(--primary); color: white; border: none; border-radius: var(--radius); font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { width: 100%; padding: 0.75rem; background: transparent; color: var(--gray-600); border: 1px solid var(--gray-200); border-radius: var(--radius); font-size: 0.9rem; font-weight: 500; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 0.75rem; }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); background: #eef2ff; }
        .login-right { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 3rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); position: relative; overflow: hidden; }
        .login-right::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .showcase-content { text-align: center; color: white; position: relative; z-index: 1; max-width: 400px; }
        .showcase-icon { width: 80px; height: 80px; background: rgba(255,255,255,0.15); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 2rem; backdrop-filter: blur(10px); }
        .showcase-title { font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3; }
        .showcase-desc { font-size: 1rem; opacity: 0.8; line-height: 1.6; margin-bottom: 2rem; }
        .showcase-features { display: flex; flex-direction: column; gap: 0.75rem; text-align: left; }
        .showcase-feature { display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; opacity: 0.9; }
        .showcase-feature i { width: 28px; height: 28px; background: rgba(255,255,255,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0; }
        .alert-success { padding: 0.875rem 1rem; background: #d1fae5; border-left: 3px solid #10b981; color: #065f46; font-size: 0.875rem; border-radius: var(--radius); margin-bottom: 1.25rem; }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .login-right { display: none; }
            .login-left { padding: 2rem; flex: none; min-height: 100vh; justify-content: flex-start; padding-top: 3rem; }
            .login-card { max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="login-left">
        <div class="login-card">
            <div class="brand">
                <div class="brand-icon"><i class="fas fa-bell"></i></div>
                <span class="brand-text">NurseCall</span>
            </div>

            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Login untuk mengakses dashboard</p>

            <?php if(session('status')): ?>
                <div class="alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope form-icon"></i>
                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="admin@email.com">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock form-icon"></i>
                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required placeholder="Masukkan password">
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
            </form>
        </div>
    </div>

    <div class="login-right">
        <div class="showcase-content">
            <div class="showcase-icon"><i class="fas fa-bell"></i></div>
            <h2 class="showcase-title">Sistem Buku Tamu<br>& Penjadwalan Janji</h2>
            <p class="showcase-desc">Kelola kunjungan tamu dan jadwal janji dengan mudah, efisien, dan profesional.</p>
            <div class="showcase-features">
                <div class="showcase-feature">
                    <i class="fas fa-check"></i>
                    <span>Registrasi tamu otomatis</span>
                </div>
                <div class="showcase-feature">
                    <i class="fas fa-check"></i>
                    <span>Manajemen jadwal janji</span>
                </div>
                <div class="showcase-feature">
                    <i class="fas fa-check"></i>
                    <span>Dashboard statistik real-time</span>
                </div>
                <div class="showcase-feature">
                    <i class="fas fa-check"></i>
                    <span>Export data ke Excel</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/login.blade.php ENDPATH**/ ?>