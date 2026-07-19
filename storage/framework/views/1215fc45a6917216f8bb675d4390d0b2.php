<?php $__env->startSection('title', 'Buku Tamu - NurseCall'); ?>
<?php $__env->startSection('page-title', 'Buku Tamu'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a href="/"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Buku Tamu</span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .two-col { display: grid; grid-template-columns: 420px 1fr; gap: 1.5rem; align-items: start; }
    .form-card { position: sticky; top: calc(var(--header-height) + 1.5rem); }
    .form-header { display: flex; align-items: center; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .form-icon { width: 40px; height: 40px; background: #eef2ff; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.1rem; }
    .form-header-text h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .form-header-text p { font-size: 0.75rem; color: var(--gray-500); margin: 0; }
    .form-body { padding: 1.25rem; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .form-control { padding-left: 2.5rem; }
    .input-icon-wrap i { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 0.9rem; pointer-events: none; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .guest-list-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .guest-list-title { display: flex; align-items: center; gap: 0.75rem; }
    .guest-list-title h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .search-wrap { display: flex; align-items: center; gap: 0; }
    .search-wrap .form-control { border-radius: var(--radius) 0 0 var(--radius); height: 36px; padding: 0.375rem 0.75rem; font-size: 0.875rem; }
    .search-wrap .btn { border-radius: 0 var(--radius) var(--radius) 0; height: 36px; padding: 0 0.875rem; }
    .guest-list-body { padding: 0; }
    .guest-item { display: flex; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid var(--gray-100); transition: var(--transition); position: relative; }
    .guest-item:hover { background: var(--gray-50); }
    .guest-item:last-child { border-bottom: none; }
    .guest-avatar { width: 44px; height: 44px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1rem; flex-shrink: 0; }
    .guest-avatar.green { background: var(--success); }
    .guest-avatar.orange { background: var(--warning); }
    .guest-avatar.red { background: var(--danger); }
    .guest-content { flex: 1; min-width: 0; }
    .guest-name { font-weight: 600; color: var(--gray-900); font-size: 0.9rem; }
    .guest-meta { display: flex; flex-wrap: wrap; gap: 0.5rem 1rem; margin-top: 4px; font-size: 0.75rem; color: var(--gray-500); }
    .guest-meta span { display: flex; align-items: center; gap: 4px; }
    .guest-actions { display: flex; align-items: center; gap: 0.375rem; flex-shrink: 0; }
    .guest-message { margin-top: 0.5rem; padding: 0.625rem; background: var(--gray-50); border-radius: var(--radius); font-size: 0.8rem; color: var(--gray-600); line-height: 1.5; }
    .guest-message a { color: var(--primary); }
    .guest-empty { text-align: center; padding: 4rem 1rem; color: var(--gray-400); }
    .guest-empty i { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .pagination-wrap { padding: 1rem 1.25rem; border-top: 1px solid var(--gray-200); }
    .page-link-custom { display: flex; align-items: center; justify-content: center; gap: 0.25rem; }
    @media (max-width: 1024px) { .two-col { grid-template-columns: 1fr; } .form-card { position: static; } .form-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px) { .guest-list-header { flex-direction: column; align-items: flex-start; } .search-wrap { width: 100%; } .search-wrap .form-control { flex: 1; } .guest-actions { flex-direction: row; } .guest-item { flex-direction: column; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="two-col">
    <div class="card form-card">
        <div class="form-header">
            <div class="form-icon"><i class="fas fa-user-plus"></i></div>
            <div class="form-header-text">
                <h3>Registrasi Tamu</h3>
                <p>Isi data diri dan tujuan kunjungan</p>
            </div>
        </div>
        <div class="form-body">
            <form action="/bukutamu" method="POST" novalidate>
                <?php echo csrf_field(); ?>
                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Nama / Instansi" value="<?php echo e(old('nama')); ?>" required>
                </div>
                <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor HP (08xxxxxxxxxx)" value="<?php echo e(old('nomor_hp')); ?>" required>
                </div>
                <?php $__errorArgs = ['nomor_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="form-grid mb-3">
                    <div class="input-icon-wrap">
                        <i class="fas fa-users"></i>
                        <input type="number" name="jumlah_orang" class="form-control" placeholder="Jumlah orang" value="<?php echo e(old('jumlah_orang', 1)); ?>" min="1" required>
                    </div>
                    <div class="input-icon-wrap">
                        <i class="fas fa-clock"></i>
                        <input type="time" name="waktu_kedatangan" class="form-control" value="<?php echo e(old('waktu_kedatangan')); ?>" step="3600">
                    </div>
                </div>
                <?php $__errorArgs = ['jumlah_orang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['waktu_kedatangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-bullseye"></i>
                    <input type="text" name="tujuan" class="form-control" placeholder="Bertemu dengan / Tujuan" value="<?php echo e(old('tujuan')); ?>" required>
                </div>
                <?php $__errorArgs = ['tujuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="form-group mb-4">
                    <label class="form-label">Pesan / Keterangan</label>
                    <textarea name="pesan" class="form-control" rows="3" placeholder="Tulis pesan atau keterangan..."><?php echo e(old('pesan')); ?></textarea>
                </div>
                <?php $__errorArgs = ['pesan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <button type="submit" class="btn btn-primary w-full" style="padding: 0.625rem;">
                    <i class="fas fa-paper-plane me-2"></i>Kirim
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="guest-list-header">
            <div class="guest-list-title">
                <h3>Daftar Tamu</h3>
                <span class="badge badge-primary"><?php echo e($tamus->total()); ?> tamu</span>
            </div>
            <form action="/bukutamu" method="GET" class="search-wrap">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau instansi..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                <?php if(request('search')): ?>
                    <a href="/" class="btn btn-outline"><i class="fas fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>

        <div class="guest-list-body">
            <?php if(request('search') && $tamus->isEmpty()): ?>
                <div class="guest-empty" style="padding:3rem;">
                    <i class="fas fa-search"></i>
                    <h4>Tidak ditemukan</h4>
                    <p class="text-muted">Tamu dengan nama "<?php echo e(request('search')); ?>" tidak ada.</p>
                </div>
            <?php endif; ?>

            <?php $__empty_1 = true; $__currentLoopData = $tamus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="guest-item">
                <div class="guest-avatar"><?php echo e(strtoupper(substr($tamu->nama, 0, 1))); ?></div>
                <div class="guest-content">
                    <div class="guest-name"><?php echo e($tamu->nama); ?></div>
                    <div class="guest-meta">
                        <span><i class="fas fa-phone"></i>
                            <?php if(auth()->guard()->check()): ?>
                                <?php echo e($tamu->nomor_hp); ?>

                            <?php else: ?>
                                <?php echo e(substr($tamu->nomor_hp, 0, 4)); ?><?php echo e(str_repeat('*', max(0, strlen($tamu->nomor_hp) - 7))); ?><?php echo e(substr($tamu->nomor_hp, -3)); ?>

                            <?php endif; ?>
                        </span>
                        <span><i class="fas fa-bullseye"></i> <?php echo e($tamu->tujuan); ?></span>
                        <span><i class="fas fa-users"></i> <?php echo e($tamu->jumlah_orang); ?> orang</span>
                        <span><i class="fas fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($tamu->created_at)->format('d M Y')); ?></span>
                        <?php if($tamu->waktu_kedatangan): ?>
                        <span><i class="fas fa-clock"></i> <?php echo e(\Carbon\Carbon::parse($tamu->waktu_kedatangan)->format('H:i')); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($tamu->pesan): ?>
                    <div class="guest-message">
                        <?php echo e(Str::limit($tamu->pesan, 150)); ?>

                        <?php if(strlen($tamu->pesan) > 150): ?>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo e($tamu->id); ?>"> Baca selengkapnya...</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if(auth()->guard()->check()): ?>
                <div class="guest-actions">
                    <a href="<?php echo e(route('buku-tamu.edit', $tamu->id)); ?>" class="btn btn-icon btn-outline" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="<?php echo e(route('buku-tamu.destroy', $tamu->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus data tamu ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-icon btn-outline" title="Hapus" style="color:var(--danger);">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>

            <div class="modal fade" id="detailModal<?php echo e($tamu->id); ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan dari <?php echo e($tamu->nama); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="white-space:pre-wrap;font-size:0.9rem;color:var(--gray-700);"><?php echo e($tamu->pesan); ?></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="guest-empty">
                <i class="fas fa-user-slash"></i>
                <h4>Belum ada tamu</h4>
                <p class="text-muted">Tamu pertama akan muncul di sini.</p>
            </div>
            <?php endif; ?>
        </div>

        <?php if($tamus->hasPages()): ?>
        <div class="pagination-wrap">
            <div class="page-link-custom">
                <?php echo e($tamus->appends(['search' => request('search')])->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var waktuInput = document.querySelector('input[name="waktu_kedatihan"]');
        if (waktuInput) {
            var now = new Date();
            var h = String(now.getHours()).padStart(2, '0');
            var m = String(now.getMinutes()).padStart(2, '0');
            waktuInput.max = h + ':' + m;
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bukutamu\resources\views/bukutamu.blade.php ENDPATH**/ ?>