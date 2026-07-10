<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-box, .list-box { background: rgba(255, 255, 255, 0.98); padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .form-box { height: fit-content; position: sticky; top: 20px; }
        .list-box { max-height: calc(100vh - 120px); overflow-y: auto; }
        h3 { color: #333; }
        textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .stat-cards-horizontal { display: flex; gap: 10px; margin-bottom: 15px; }
        .stat-card-sm { flex: 1; padding: 12px; border-radius: 10px; color: #fff; text-align: center; }
        .stat-card-sm .stat-number { font-size: 20px; font-weight: 700; }
        .stat-card-sm .stat-label { font-size: 10px; opacity: 0.9; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-today { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .card-month { background: linear-gradient(135deg, #f6c23e, #dda20a); }
        .guest-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 8px; }
        .guest-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }
        .search-box { display: flex; align-items: center; gap: 0; }
        .search-box input { border-radius: 4px 0 0 4px; height: 32px; padding: 6px 10px; font-size: 13px; margin: 0; width: auto; }
        .search-box .btn { border-radius: 0 4px 4px 0; height: 32px; padding: 0 12px; font-size: 13px; }
        .filter-btns { display: flex; gap: 4px; flex-wrap: wrap; }
        .filter-btns .btn { font-size: 11px; padding: 3px 8px; border-radius: 4px; }
        .filter-btns .btn.active { background: #4e73df; color: white; border-color: #4e73df; }
        .timeline { position: relative; padding-left: 20px; }
        .timeline::before { content: ''; position: absolute; left: 7px; top: 0; bottom: 0; width: 2px; background: #dee2e6; }
        .timeline-item { position: relative; margin-bottom: 0; }
        .timeline-dot { position: absolute; left: -17px; top: 8px; width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff; z-index: 1; }
        .appointment-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 8px; }
        .appointment-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Buku Tamu</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link" href="/buat-janji">Buat Janji</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="form-box scrollbar-thin">
                    <h3>📝 Isi Buku Tamu</h3>
                    <form action="/bukutamu" method="POST">
                        <?php echo csrf_field(); ?>
                        <label>Nama/Instansi:</label>
                        <input type="text" name="nama" placeholder="Nama atau instansi..." value="<?php echo e(old('nama')); ?>" required>
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
                        <input type="number" name="jumlah_orang" placeholder="Jumlah orang..." value="<?php echo e(old('jumlah_orang', 1)); ?>" min="1" required>
                        <?php $__errorArgs = ['jumlah_orang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mb-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <label>Waktu Kedatangan:</label>
                        <input type="time" name="waktu_kedatangan" value="<?php echo e(old('waktu_kedatangan')); ?>" step="3600">
                        <?php $__errorArgs = ['waktu_kedatangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mb-2"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <label>Nomor HP:</label>
                        <input type="text" name="nomor_hp" placeholder="08xxxxxxxxxx" value="<?php echo e(old('nomor_hp')); ?>" required>
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

                        <label>Bertemu Dengan:</label>
                        <input type="text" name="tujuan" placeholder="Siapa yang ingin ditemui..." value="<?php echo e(old('tujuan')); ?>" required>
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
                        <textarea name="pesan" rows="4" placeholder="Tulis pesan atau keterangan..."><?php echo e(old('pesan')); ?></textarea>
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
                        
                        <button type="submit" class="btn-submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="list-box scrollbar-thin">
                    <div class="stat-cards-horizontal">
                        <div class="stat-card-sm card-total">
                            <div class="stat-number"><?php echo e($totalTamu); ?></div>
                            <div class="stat-label">Total Kunjungan</div>
                        </div>
                        <div class="stat-card-sm card-today">
                            <div class="stat-number"><?php echo e($tamuHariIni); ?></div>
                            <div class="stat-label">Kunjungan Hari Ini</div>
                        </div>
                        <div class="stat-card-sm card-month">
                            <div class="stat-number"><?php echo e($tamuBulanIni); ?></div>
                            <div class="stat-label">Kunjungan Bulan Ini</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="mb-0">📋 Daftar Tamu</h3>
                            <span class="badge bg-primary"><?php echo e($tamus->total()); ?> tamu</span>
                        </div>
                        <form action="/bukutamu" method="GET" class="mb-0">
                            <div class="search-box">
                                <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?php echo e(request('search')); ?>">
                                <button class="btn btn-primary" type="submit">Cari</button>
                                <?php if(request('search')): ?>
                                    <a href="/bukutamu" class="btn btn-outline-secondary">Reset</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <?php if(request('search') && $tamus->isEmpty()): ?>
                        <div class="alert alert-warning text-center">
                            <strong>Data tidak ditemukan</strong><br>
                            Tamu dengan nama "<?php echo e(request('search')); ?>" tidak ada di daftar.
                        </div>
                    <?php endif; ?>

                    <div class="timeline">
                    <?php $__empty_1 = true; $__currentLoopData = $tamus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="timeline-item">
                            <div class="timeline-dot" style="background: #1cc88a;"></div>
                            <div class="guest-card" style="margin-bottom: 12px;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <b><?php echo e($tamu->nama); ?></b>
                                        </div>
                                        <small class="text-muted">
                                            <?php echo e($tamu->nomor_hp); ?>

                                        </small>
                                        <br>
                                        <small class="text-muted">Tujuan: <?php echo e($tamu->tujuan); ?></small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa-regular fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($tamu->created_at)->format('d M Y')); ?>

                                            | <i class="fa-regular fa-clock"></i> Diisi: <?php echo e(\Carbon\Carbon::parse($tamu->created_at)->format('H:i')); ?>

                                            <?php if($tamu->waktu_kedatangan): ?>
                                                 | <i class="fa-solid fa-right-to-bracket"></i> Datang: <?php echo e(\Carbon\Carbon::parse($tamu->waktu_kedatangan)->format('H:i')); ?>

                                            <?php endif; ?>
                                        </small>
                                        <br>
                                        <small class="text-muted">Jumlah: <?php echo e($tamu->jumlah_orang); ?> orang</small>
                                    </div>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('buku-tamu.edit', $tamu->id)); ?>" class="btn btn-warning btn-sm" title="Edit" style="padding: 4px 10px; font-size: 13px;">Edit</a>
                                        <form action="<?php echo e(route('buku-tamu.destroy', $tamu->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus tamu ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" style="padding: 4px 10px; font-size: 13px;">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <?php if($tamu->pesan): ?>
                                <p class="mb-0">
                                    <?php echo e(Str::limit($tamu->pesan, 120)); ?>

                                    <?php if(strlen($tamu->pesan) > 120): ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo e($tamu->id); ?>">
                                            Baca selengkapnya...
                                        </a>
                                    <?php endif; ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="modal fade" id="detailModal<?php echo e($tamu->id); ?>" tabindex="-1" aria-labelledby="detailModalLabel<?php echo e($tamu->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel<?php echo e($tamu->id); ?>">Detail Pesan: <?php echo e($tamu->nama); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="white-space: pre-wrap;"><?php echo e($tamu->pesan); ?></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted py-5">Belum ada tamu yang mengisi buku tamu.</p>
                    <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <?php echo e($tamus->appends(['search' => request('search')])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('form[action="/bukutamu"]').addEventListener('submit', function() {
            var waktuInput = document.querySelector('input[name="waktu_kedatangan"]');
            if (!waktuInput.value) {
                var now = new Date();
                var h = String(now.getHours()).padStart(2, '0');
                var m = String(now.getMinutes()).padStart(2, '0');
                waktuInput.value = h + ':' + m;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/bukutamu.blade.php ENDPATH**/ ?>