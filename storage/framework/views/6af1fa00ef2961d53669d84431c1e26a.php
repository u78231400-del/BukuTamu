<?php $__env->startSection('title', 'Dashboard - RS Medika'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a href="/dashboard"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Dashboard</span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .dashboard-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
    .charts-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 1rem; }
    .charts-row2 { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
    .bottom-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; }
    .stat-card { position: relative; overflow: hidden; }
    .stat-card::before { content: ''; position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; opacity: 0.1; background: currentColor; }
    .recent-list { list-style: none; padding: 0; margin: 0; }
    .recent-list li { padding: 0.75rem 0; border-bottom: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; }
    .recent-list li:last-child { border-bottom: none; }
    .recent-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem; flex-shrink: 0; }
    .recent-info { flex: 1; margin-left: 0.75rem; min-width: 0; }
    .recent-name { font-weight: 500; color: var(--gray-900); font-size: 0.875rem; }
    .recent-time { font-size: 0.75rem; color: var(--gray-400); }
    .welcome-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: var(--radius-lg); padding: 1.75rem 2rem; color: white; margin-bottom: 1.5rem; position: relative; overflow: hidden; }
    .welcome-header::before { content: ''; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; }
    .welcome-header::after { content: ''; position: absolute; bottom: -30%; right: 10%; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%; }
    .welcome-content { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; }
    .welcome-text h2 { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; }
    .welcome-text p { font-size: 0.875rem; opacity: 0.9; }
    .welcome-icon { font-size: 3.5rem; opacity: 0.3; }
    .welcome-date { font-size: 0.8rem; opacity: 0.8; margin-top: 0.5rem; }
    @media (max-width: 1200px) { .dashboard-grid { grid-template-columns: repeat(2, 1fr); } .charts-grid, .charts-row2, .bottom-grid { grid-template-columns: 1fr; } .welcome-header { padding: 1.25rem; } .welcome-text h2 { font-size: 1.25rem; } .welcome-icon { font-size: 2.5rem; } }
    @media (max-width: 640px) { .welcome-content { flex-direction: column; align-items: flex-start; gap: 1rem; } .welcome-icon { display: none; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
    <div class="alert alert-success animate-fade-in">
        <i class="fas fa-check-circle"></i>
        <span><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    <div class="welcome-header animate-fade-in">
        <div class="welcome-content">
            <div class="welcome-text">
                <h2>Selamat Datang Kembali, Admin</h2>
                <p>Kelola data kunjungan pasien dan jadwal kunjungan dengan mudah.</p>
                <div class="welcome-date">
                    <i class="fas fa-calendar-alt me-1"></i>
                    <?php echo e(\Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y')); ?>

                </div>
            </div>
            <div class="welcome-icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>

    <div class="dashboard-grid mb-4">
        <div class="stat-card">
            <div class="stat-icon primary"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($totalTamu); ?></div>
                <div class="stat-label">Total Kunjungan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($tamuHariIni); ?></div>
                <div class="stat-label">Kunjungan Hari Ini</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon danger"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($tamuMingguIni); ?></div>
                <div class="stat-label">Minggu Ini</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning"><i class="fas fa-calendar"></i></div>
            <div class="stat-info">
                <div class="stat-value"><?php echo e($tamuBulanIni); ?></div>
                <div class="stat-label">Bulan Ini</div>
            </div>
        </div>
    </div>

    <div class="charts-grid mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie me-2 text-primary"></i>Status Jadwal Kunjungan</h3>
            </div>
            <div class="card-body" style="display:flex;align-items:center;justify-content:center;">
                <canvas id="chartJanji" style="max-width:280px;max-height:280px;"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-area me-2 text-success"></i>Tren Kunjungan 7 Hari Terakhir</h3>
            </div>
            <div class="card-body">
                <canvas id="chart7hari"></canvas>
            </div>
        </div>
    </div>

    <div class="charts-row2 mb-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-bar me-2 text-info"></i>Data Per Bulan <?php echo e(Carbon\Carbon::now()->format('Y')); ?></h3>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/bukutamu/export"><i class="fas fa-file-excel me-2"></i>Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tasks me-2 text-warning"></i>Statistik Jadwal Kunjungan</h3>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                    <div style="padding:1rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:0.75rem;text-align:center;">
                        <div style="font-size:1.75rem;font-weight:700;color:#059669;"><?php echo e($appointmentMenunggu); ?></div>
                        <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">Menunggu</div>
                    </div>
                    <div style="padding:1rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:0.75rem;text-align:center;">
                        <div style="font-size:1.75rem;font-weight:700;color:#059669;"><?php echo e($appointmentDisetujui); ?></div>
                        <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">Disetujui</div>
                    </div>
                    <div style="padding:1rem;background:#fef2f2;border:1px solid #fecaca;border-radius:0.75rem;text-align:center;">
                        <div style="font-size:1.75rem;font-weight:700;color:#dc2626;"><?php echo e($appointmentDitolak); ?></div>
                        <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">Ditolak</div>
                    </div>
                    <div style="padding:1rem;background:#eef2ff;border:1px solid #c7d2fe;border-radius:0.75rem;text-align:center;">
                        <div style="font-size:1.75rem;font-weight:700;color:#4338ca;"><?php echo e($totalAppointment); ?></div>
                        <div style="font-size:0.75rem;color:#6b7280;margin-top:4px;">Total</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-grid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list me-2 text-success"></i>Rekap Per Bulan <?php echo e(Carbon\Carbon::now()->format('Y')); ?></h3>
            </div>
            <div class="card-body p-0">
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th style="text-align:right;">Jumlah Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $labelsBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($bulan); ?></td>
                                <td style="text-align:right;font-weight:600;"><?php echo e($dataPerBulan[$index]); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr style="background:var(--gray-50);font-weight:700;">
                                <td>Total</td>
                                <td style="text-align:right;"><?php echo e($totalTamu); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-clock me-2 text-danger"></i>Kunjungan Terbaru</h3>
            </div>
            <div class="card-body p-0">
                <ul class="recent-list" style="padding:0 1rem;">
                    <?php $__empty_1 = true; $__currentLoopData = $tamuTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li>
                        <div class="flex items-center" style="flex:1;min-width:0;">
                            <div class="recent-avatar"><?php echo e(strtoupper(substr($tamu->nama, 0, 1))); ?></div>
                            <div class="recent-info">
                                <div class="recent-name truncate"><?php echo e($tamu->nama); ?></div>
                                <div class="recent-time"><?php echo e(\Carbon\Carbon::parse($tamu->created_at)->format('d M Y, H:i')); ?></div>
                            </div>
                        </div>
                        <span class="badge badge-gray"><?php echo e($tamu->jumlah_orang ?? 1); ?> org</span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li style="justify-content:center;padding:2rem;text-align:center;color:var(--gray-400);">
                        <i class="fas fa-inbox" style="font-size:2rem;margin-bottom:0.5rem;display:block;"></i>
                        Belum ada data
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ctxJanji = document.getElementById('chartJanji').getContext('2d');
    new Chart(ctxJanji, {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'Disetujui', 'Ditolak'],
            datasets: [{
                data: [<?php echo e($appointmentMenunggu); ?>, <?php echo e($appointmentDisetujui); ?>, <?php echo e($appointmentDitolak); ?>],
                backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 16, font: { size: 12, family: 'Inter' }, usePointStyle: true, pointStyle: 'circle' } },
                tooltip: { backgroundColor: '#1e293b', titleFont: { size: 13, family: 'Inter' }, bodyFont: { size: 12, family: 'Inter' }, padding: 10, cornerRadius: 8, callbacks: { label: (ctx) => ' ' + ctx.label + ': ' + ctx.parsed + ' janji' } }
            },
            cutout: '65%'
        }
    });

    const ctx7hari = document.getElementById('chart7hari').getContext('2d');
    const grad7 = ctx7hari.createLinearGradient(0, 0, 0, 300);
    grad7.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    grad7.addColorStop(1, 'rgba(16, 185, 129, 0.01)');
    new Chart(ctx7hari, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels7hari, 15, 512) ?>,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: <?php echo json_encode($hariTerakhir, 15, 512) ?>,
                borderColor: '#10b981',
                backgroundColor: grad7,
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#1e293b', titleFont: { size: 13, family: 'Inter' }, bodyFont: { size: 12, family: 'Inter' }, padding: 10, cornerRadius: 8 } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11, family: 'Inter' }, color: '#94a3b8' }, grid: { color: '#f1f5f9' } },
                x: { ticks: { font: { size: 11, family: 'Inter' }, color: '#94a3b8' }, grid: { display: false } }
            }
        }
    });

    const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
    const gradB = ctxBulanan.createLinearGradient(0, 0, 0, 300);
    gradB.addColorStop(0, 'rgba(79, 70, 229, 0.3)');
    gradB.addColorStop(1, 'rgba(79, 70, 229, 0.01)');
    new Chart(ctxBulanan, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labelsBulan, 15, 512) ?>,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: <?php echo json_encode($dataPerBulan, 15, 512) ?>,
                backgroundColor: 'rgba(79, 70, 229, 0.8)',
                borderColor: '#4f46e5',
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false,
                hoverBackgroundColor: '#4f46e5'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { backgroundColor: '#1e293b', titleFont: { size: 13, family: 'Inter' }, bodyFont: { size: 12, family: 'Inter' }, padding: 10, cornerRadius: 8 } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11, family: 'Inter' }, color: '#94a3b8' }, grid: { color: '#f1f5f9' } },
                x: { ticks: { font: { size: 11, family: 'Inter' }, color: '#94a3b8' }, grid: { display: false } }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bukutamu\resources\views/dashboard.blade.php ENDPATH**/ ?>