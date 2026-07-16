<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Statistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .stat-box { display: flex; align-items: center; gap: 14px; padding: 18px 20px; border-radius: 12px; color: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.12); }
        .stat-icon-box { font-size: 32px; opacity: 0.9; }
        .stat-number { font-size: 1.8rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: 0.8rem; opacity: 0.9; margin-top: 2px; }
        .stat-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .stat-today { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .stat-month { background: linear-gradient(135deg, #f6c23e, #dda20a); }
        .stat-week { background: linear-gradient(135deg, #e74a3b, #c0392b); }
        .chart-container { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .table { font-size: 0.9rem; }
        .navbar-brand { font-weight: 600; }
        .badge-menunggu { background: #f6c23e; color: #000; }
        .badge-disetujui { background: #1cc88a; }
        .badge-ditolak { background: #e74a3b; }
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Buku Tamu</a>
            <div class="d-flex align-items-center gap-2">
                <div class="navbar-mobile-menu" id="mobileMenu">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link active" href="/dashboard">Dashboard</a>
                    <a class="nav-link" href="/agenda">Agenda</a>
                    <a class="nav-link" href="#" onclick="confirmLogout()">Logout</a>
                </div>
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link active" href="/dashboard">Dashboard</a>
                    <a class="nav-link" href="/agenda">Agenda</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?php echo e(Auth::user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form id="logout-form" method="POST" action="/logout">
                                    <?php echo csrf_field(); ?>
                                </form>
                                <button type="button" class="dropdown-item" onclick="confirmLogout()">Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function toggleMobileMenu() { var menu = document.getElementById('mobileMenu'); menu.classList.toggle('show'); }
        document.addEventListener('click', function(e) { var menu = document.getElementById('mobileMenu'); if (!e.target.closest('.d-flex')) menu.classList.remove('show'); });
    </script>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dashboard Statistik</h2>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/bukutamu/export"><i class="fas fa-book"></i> Export Buku Tamu</a></li>
                    <li><a class="dropdown-item" href="/buat-janji/export"><i class="fas fa-calendar-check"></i> Export Janji Tamu</a></li>
                </ul>
            </div>
        </div>
        
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-box stat-total">
                    <div class="stat-icon-box">&#128100;</div>
                    <div><div class="stat-number"><?php echo e($totalTamu); ?></div><div class="stat-label">Total Tamu</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-today">
                    <div class="stat-icon-box">&#128197;</div>
                    <div><div class="stat-number"><?php echo e($tamuHariIni); ?></div><div class="stat-label">Hari Ini</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-week">
                    <div class="stat-icon-box">&#128202;</div>
                    <div><div class="stat-number"><?php echo e($tamuMingguIni); ?></div><div class="stat-label">Minggu Ini</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-month">
                    <div class="stat-icon-box">&#128198;</div>
                    <div><div class="stat-number"><?php echo e($tamuBulanIni); ?></div><div class="stat-label">Bulan Ini</div></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="chart-container">
                    <h5 class="mb-3">Status Janji Tamu</h5>
                    <canvas id="chartJanji"></canvas>
                </div>
            </div>
            <div class="col-md-8">
                <div class="chart-container">
                    <h5 class="mb-3">Tren Tamu 7 Hari Terakhir</h5>
                    <canvas id="chart7hari"></canvas>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="chart-container">
                    <h5 class="mb-3">Data Per Bulan <?php echo e(Carbon\Carbon::now()->format('Y')); ?></h5>
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container text-center">
                    <h5 class="mb-3">Statistik Janji Tamu</h5>
                    <div class="row g-2 mt-2">
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#f6c23e20; border:1px solid #f6c23e;">
                                <div class="fw-bold fs-4" style="color:#dda20a;"><?php echo e($appointmentMenunggu); ?></div>
                                <div class="small text-muted">Menunggu</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#1cc88a20; border:1px solid #1cc88a;">
                                <div class="fw-bold fs-4" style="color:#13855c;"><?php echo e($appointmentDisetujui); ?></div>
                                <div class="small text-muted">Disetujui</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#e74a3b20; border:1px solid #e74a3b;">
                                <div class="fw-bold fs-4" style="color:#c0392b;"><?php echo e($appointmentDitolak); ?></div>
                                <div class="small text-muted">Ditolak</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background:#4e73df20; border:1px solid #4e73df;">
                                <div class="fw-bold fs-4" style="color:#224abe;"><?php echo e($totalAppointment); ?></div>
                                <div class="small text-muted">Total Janji</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Rekap Per Bulan <?php echo e(Carbon\Carbon::now()->format('Y')); ?></h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th class="text-end">Jumlah Tamu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $labelsBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bulan); ?></td>
                                        <td class="text-end"><?php echo e($dataPerBulan[$index]); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td>Total</td>
                                        <td class="text-end"><?php echo e($totalTamu); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Tamu Terbaru</h5>
                        <ul class="list-group list-group-flush">
                            <?php $__currentLoopData = $tamuTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tamu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item px-0">
                                <strong><?php echo e($tamu->nama); ?></strong><br>
                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($tamu->created_at)->format('d M Y H:i')); ?></small>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctxJanji = document.getElementById('chartJanji').getContext('2d');
        new Chart(ctxJanji, {
            type: 'doughnut',
            data: {
                labels: ['Menunggu', 'Disetujui', 'Ditolak'],
                datasets: [{
                    data: [<?php echo e($appointmentMenunggu); ?>, <?php echo e($appointmentDisetujui); ?>, <?php echo e($appointmentDitolak); ?>],
                    backgroundColor: ['#f6c23e', '#1cc88a', '#e74a3b'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 15, font: { size: 12 } }
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                cutout: '55%'
            }
        });

        const ctx7hari = document.getElementById('chart7hari').getContext('2d');
        const gradient7hari = ctx7hari.createLinearGradient(0, 0, 0, 300);
        gradient7hari.addColorStop(0, 'rgba(78, 115, 223, 0.3)');
        gradient7hari.addColorStop(1, 'rgba(78, 115, 223, 0.02)');

        new Chart(ctx7hari, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels7hari, 15, 512) ?>,
                datasets: [{
                    label: 'Jumlah Tamu',
                    data: <?php echo json_encode($hariTerakhir, 15, 512) ?>,
                    borderColor: '#4e73df',
                    backgroundColor: gradient7hari,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4e73df',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#333',
                        titleFont: { size: 13 },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
        const gradientBulanan = ctxBulanan.createLinearGradient(0, 0, 0, 300);
        gradientBulanan.addColorStop(0, 'rgba(28, 200, 138, 0.3)');
        gradientBulanan.addColorStop(1, 'rgba(28, 200, 138, 0.02)');

        new Chart(ctxBulanan, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labelsBulan, 15, 512) ?>,
                datasets: [{
                    label: 'Jumlah Tamu',
                    data: <?php echo json_encode($dataPerBulan, 15, 512) ?>,
                    backgroundColor: 'rgba(28, 200, 138, 0.8)',
                    borderColor: '#1cc88a',
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: '#13855c'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#333',
                        titleFont: { size: 13 },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: 'Anda akan keluar dari dashboard.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\bukutamu\resources\views/dashboard.blade.php ENDPATH**/ ?>