<!DOCTYPE html>
<html>
<head>
    <title>Buat Janji Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-box, .list-box { background: rgba(255, 255, 255, 0.98); padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .form-box { height: fit-content; position: sticky; top: 20px; }
        .list-box { max-height: calc(100vh - 120px); overflow-y: auto; }
        h3 { color: #333; }
        input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="time"], textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input:focus, textarea:focus { outline: none; border-color: #4e73df; box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1); }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-menunggu { background: linear-gradient(135deg, #f6c23e, #dda20a); }
        .card-disetujui { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .card-ditolak { background: linear-gradient(135deg, #e74a3b, #be3c30); }
        .stat-cards-horizontal { display: flex; gap: 10px; margin-bottom: 15px; }
        .stat-card-sm { flex: 1; padding: 12px; border-radius: 10px; color: #fff; text-align: center; }
        .stat-card-sm .stat-number { font-size: 20px; font-weight: 700; }
        .stat-card-sm .stat-label { font-size: 10px; opacity: 0.9; }
        .appointment-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 8px; }
        .appointment-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
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
        .badge-menunggu { background: #f6c23e; }
        .badge-disetujui { background: #1cc88a; }
        .badge-ditolak { background: #e74a3b; }
        .badge-selesai { background: #6c757d; }
        .appointment-card.completed { opacity: 0.7; background: #f8f9fa; }
        .nav-tabs .nav-link { font-size: 13px; padding: 6px 12px; }
        .nav-tabs .nav-link.active { font-weight: 600; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Buku Tamu</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link active" href="/buat-janji">Buat Janji</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="form-box scrollbar-thin">
                    <h3>Form Buat Janji</h3>

                    <form action="/buat-janji" method="POST">
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

                        <label>Jumlah Orang:</label>
                        <input type="number" name="jumlah_orang" min="1" max="100" value="<?php echo e(old('jumlah_orang', 1)); ?>" required>
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

                        <div class="row">
                            <div class="col-6">
                                <label>Tanggal Janji:</label>
                                <input type="date" name="tanggal_janji" id="tanggal_janji" value="<?php echo e(old('tanggal_janji')); ?>" min="<?php echo e(date('Y-m-d')); ?>" required>
                                <?php $__errorArgs = ['tanggal_janji'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mb-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-6">
                                <label>Jam Janji:</label>
                                <input type="time" name="jam_janji" id="jam_janji" value="<?php echo e(old('jam_janji')); ?>" required>
                                <?php $__errorArgs = ['jam_janji'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mb-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

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
                        
                        <button type="submit" class="btn-submit">Buat Janji</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="list-box scrollbar-thin">
                    <div class="stat-cards-horizontal">
                        <div class="stat-card-sm card-total">
                            <div class="stat-number"><?php echo e($totalAppointment); ?></div>
                            <div class="stat-label">Total Janji</div>
                        </div>
                        <div class="stat-card-sm card-menunggu">
                            <div class="stat-number"><?php echo e($menunggu); ?></div>
                            <div class="stat-label">Menunggu</div>
                        </div>
                        <div class="stat-card-sm card-disetujui">
                            <div class="stat-number"><?php echo e($disetujui); ?></div>
                            <div class="stat-label">Disetujui</div>
                        </div>
                        <div class="stat-card-sm" style="background: linear-gradient(135deg, #6c757d, #495057);">
                            <div class="stat-number"><?php echo e($selesai); ?></div>
                            <div class="stat-label">Selesai</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="mb-0">Daftar Janji</h3>
                            <span class="badge bg-primary"><?php echo e($appointments->total()); ?> janji</span>
                        </div>
                        <div class="d-flex gap-2">
                            <form action="/buat-janji" method="GET" class="mb-0">
                                <?php if(request('status')): ?>
                                    <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
                                <?php endif; ?>
                                <div class="search-box">
                                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?php echo e(request('search')); ?>">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                    <?php if(request('search')): ?>
                                        <a href="/buat-janji<?php echo e(request('status') ? '?status=' . request('status') : ''); ?>" class="btn btn-outline-secondary">Reset</a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>

                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(!request('status') ? 'active' : ''); ?>" href="/buat-janji">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request('status') == 'menunggu' ? 'active' : ''); ?>" href="/buat-janji?status=menunggu">
                                Menunggu <span class="badge bg-warning text-dark ms-1"><?php echo e($menunggu); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request('status') == 'disetujui' ? 'active' : ''); ?>" href="/buat-janji?status=disetujui">
                                Disetujui <span class="badge bg-success ms-1"><?php echo e($disetujui); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request('status') == 'ditolak' ? 'active' : ''); ?>" href="/buat-janji?status=ditolak">
                                Ditolak <span class="badge bg-danger ms-1"><?php echo e($ditolak); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e(request('status') == 'selesai' ? 'active' : ''); ?>" href="/buat-janji?status=selesai">
                                Selesai <span class="badge bg-secondary ms-1"><?php echo e($selesai); ?></span>
                            </a>
                        </li>
                    </ul>

                    <?php if(request('search') && $appointments->isEmpty()): ?>
                        <div class="alert alert-warning text-center">
                            <strong>Data tidak ditemukan</strong><br>
                            Janji dengan nama "<?php echo e(request('search')); ?>" tidak ada di daftar.
                        </div>
                    <?php endif; ?>

                    <div class="timeline">
                    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $isCompleted = $apt->status === 'selesai';
                        ?>
                        <div class="timeline-item">
                            <div class="timeline-dot" style="background: 
                                <?php if($apt->status == 'disetujui'): ?> #1cc88a
                                <?php elseif($apt->status == 'ditolak'): ?> #e74a3b
                                <?php elseif($apt->status == 'selesai'): ?> #6c757d
                                <?php else: ?> #f6c23e <?php endif; ?>;">
                            </div>
                            <div class="appointment-card <?php echo e($isCompleted ? 'completed' : ''); ?>" style="margin-bottom: 12px;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <b><?php echo e($apt->nama); ?></b>
                                            <span class="badge badge-<?php echo e($apt->status); ?>">
                                                <?php echo e(ucfirst($apt->status)); ?>

                                            </span>
                                        </div>
                                        <small class="text-muted">
                                            <?php echo e($apt->nomor_hp); ?>

                                        </small>
                                        <br>
                                        <small class="text-muted">Tujuan: <?php echo e($apt->tujuan); ?></small>
                                        <br>
                                        <small class="text-muted">Jumlah: <?php echo e($apt->jumlah_orang); ?> orang</small>
                                        <br>
                                        <small class="text-muted">
                                            <?php echo e(\Carbon\Carbon::parse($apt->tanggal_janji)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($apt->jam_janji)->format('H:i')); ?>

                                        </small>
                                    </div>
                                    <?php if($apt->status === 'menunggu' || $apt->status === 'ditolak'): ?>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('appointment.edit', $apt->id)); ?>" class="btn btn-warning btn-sm" title="Edit" style="padding: 6px 14px; font-size: 13px;">Edit</a>
                                        <form action="<?php echo e(route('appointment.destroy', $apt->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus janji ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" style="padding: 6px 14px; font-size: 13px;">Hapus</button>
                                        </form>
                                        <?php if(auth()->guard()->check()): ?>
                                        <form action="<?php echo e(route('appointment.approve', $apt->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Setujui janji ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-success btn-sm" style="padding: 6px 14px; font-size: 13px;">Setujui</button>
                                        </form>
                                        <form action="<?php echo e(route('appointment.reject', $apt->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Tolak janji ini?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-secondary btn-sm" style="padding: 6px 14px; font-size: 13px;">Tolak</button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if($apt->pesan): ?>
                                <p class="mb-0">
                                    <?php echo e(Str::limit($apt->pesan, 120)); ?>

                                    <?php if(strlen($apt->pesan) > 120): ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo e($apt->id); ?>">Baca selengkapnya...</a>
                                    <?php endif; ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="modal fade" id="detailModal<?php echo e($apt->id); ?>" tabindex="-1" aria-labelledby="detailModalLabel<?php echo e($apt->id); ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel<?php echo e($apt->id); ?>">Detail Pesan: <?php echo e($apt->nama); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="white-space: pre-wrap;"><?php echo e($apt->pesan); ?></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted py-5">Belum ada janji yang dibuat.</p>
                    <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <?php echo e($appointments->appends(['search' => request('search')])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        const tanggalInput = document.getElementById('tanggal_janji');
        const jamInput = document.getElementById('jam_janji');
        const today = new Date().toISOString().split('T')[0];

        tanggalInput.min = today;

        function updateMinTime() {
            if (tanggalInput.value === today) {
                const now = new Date();
                const currentHour = String(now.getHours()).padStart(2, '0');
                const currentMinute = String(now.getMinutes()).padStart(2, '0');
                jamInput.min = `${currentHour}:${currentMinute}`;
            } else {
                jamInput.min = '';
            }
        }

        tanggalInput.addEventListener('change', updateMinTime);
        updateMinTime();
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/buat_janji.blade.php ENDPATH**/ ?>