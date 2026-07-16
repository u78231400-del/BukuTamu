<!DOCTYPE html>
<html>
<head>
    <title>Edit Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-box { background: rgba(255, 255, 255, 0.98); padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-width: 500px; margin: 50px auto; }
        h1 { color: #333; text-align: center; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        label { margin-bottom: 0; display: block; }
        .btn-update { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-update:hover { background: #41b632; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
        .btn-back:hover { background: #5a6268; color: white; }
        .navbar-collapse { background: #0d6efd; margin-top: 10px; padding: 10px; border-radius: 8px; }
        .navbar-collapse .nav-link { padding: 8px 12px; }
        .navbar-mobile-menu { display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); min-width: 180px; z-index: 1000; overflow: hidden; }
        .navbar-mobile-menu.show { display: block; }
        .navbar-mobile-menu .nav-link { color: #333 !important; padding: 12px 16px; border-bottom: 1px solid #eee; display: block; }
        .navbar-mobile-menu .nav-link:last-child { border-bottom: none; }
        .navbar-mobile-menu .nav-link:hover { background: #f8f9fa; }
        .navbar-mobile-menu .nav-link.active { background: #e7f1ff; color: #0d6efd !important; }
        @media (max-width: 991px) {
            .navbar .container { position: relative; }
            .navbar .navbar-collapse { display: none !important; }
        }
        @media (min-width: 992px) {
            .navbar-mobile-menu { display: none !important; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Buku Tamu</a>
            <div class="d-flex align-items-center gap-2">
                <div class="navbar-mobile-menu" id="mobileMenu">
                    <a class="nav-link active" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function toggleMobileMenu() { var menu = document.getElementById('mobileMenu'); menu.classList.toggle('show'); }
        document.addEventListener('click', function(e) { var menu = document.getElementById('mobileMenu'); if (!e.target.closest('.d-flex')) menu.classList.remove('show'); });
    </script>

    <div class="container">
        <div class="form-box">
        <a href="/bukutamu" class="btn-back">← Kembali</a>
        <h1>✏️ Edit Tamu</h1>
        
        <form action="<?php echo e(route('buku-tamu.update', $tamu->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <label>Nama/Instansi:</label>
            <input type="text" name="nama" value="<?php echo e(old('nama', $tamu->nama)); ?>" required>
            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mb-2"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label>Jumlah Orang:</label>
            <input type="number" name="jumlah_orang" value="<?php echo e(old('jumlah_orang', $tamu->jumlah_orang)); ?>" min="1" required>

            <label>Waktu Kedatangan:</label>
            <input type="time" name="waktu_kedatangan" value="<?php echo e(old('waktu_kedatangan', $tamu->waktu_kedatangan)); ?>" step="3600">

            <label>Nomor HP:</label>
            <input type="text" name="nomor_hp" value="<?php echo e(old('nomor_hp', $tamu->nomor_hp)); ?>" required>
            <?php $__errorArgs = ['nomor_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mb-2"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label>Tujuan Bertemu:</label>
            <input type="text" name="tujuan" value="<?php echo e(old('tujuan', $tamu->tujuan)); ?>" required>
            <?php $__errorArgs = ['tujuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mb-2"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label>Pesan/Keterangan:</label>
            <textarea name="pesan" rows="5"><?php echo e(old('pesan', $tamu->pesan)); ?></textarea>
            <?php $__errorArgs = ['pesan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mb-2"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            
            <button type="submit" class="btn-update">Simpan Perubahan</button>
        </form>
        </div>
    </div>
    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/edit_tamu.blade.php ENDPATH**/ ?>