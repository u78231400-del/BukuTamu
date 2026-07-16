<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: white; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); overflow: hidden; width: 100%; max-width: 420px; }
        .login-header { background: linear-gradient(135deg, #4e73df, #224abe); color: white; padding: 30px; text-align: center; }
        .login-header h3 { margin: 0; font-weight: 600; }
        .login-header p { margin: 5px 0 0; opacity: 0.8; font-size: 0.9rem; }
        .login-body { padding: 30px; }
        .form-control { border-radius: 8px; padding: 12px 16px; }
        .btn-login { background: linear-gradient(135deg, #4e73df, #224abe); border: none; border-radius: 8px; padding: 12px; font-weight: 600; width: 100%; }
        .btn-login:hover { background: linear-gradient(135deg, #224abe, #1a3a8a); }
        .input-group-text { border-radius: 8px 0 0 8px; background: #f8f9fa; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h3>Buku Tamu</h3>
            <p>Silakan login sebagai Admin</p>
        </div>
        <div class="login-body">
            <?php if(session('status')): ?>
                <div class="alert alert-success"><?php echo e(session('status')); ?></div>
            <?php endif; ?>

            <form method="POST" action="/login">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="admin@example.com">
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" required placeholder="Masukkan password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-login">Login</button>
                <a href="/bukutamu" class="btn btn-outline-secondary mt-2 w-100">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/login.blade.php ENDPATH**/ ?>