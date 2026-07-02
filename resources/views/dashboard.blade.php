<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Statistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Buku Tamu</a>
            <div class="navbar-nav align-items-center">
                <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link active" href="/dashboard">Dashboard</a>
                <div class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dashboard Statistik</h2>
            <a href="/bukutamu/export" class="btn btn-success">Export Excel</a>
        </div>
        
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-box stat-total">
                    <div class="stat-icon-box">👥</div>
                    <div><div class="stat-number">{{ $totalTamu }}</div><div class="stat-label">Total Tamu</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-today">
                    <div class="stat-icon-box">📅</div>
                    <div><div class="stat-number">{{ $tamuHariIni }}</div><div class="stat-label">Hari Ini</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-week">
                    <div class="stat-icon-box">📊</div>
                    <div><div class="stat-number">{{ $tamuMingguIni }}</div><div class="stat-label">Minggu Ini</div></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box stat-month">
                    <div class="stat-icon-box">📆</div>
                    <div><div class="stat-number">{{ $tamuBulanIni }}</div><div class="stat-label">Bulan Ini</div></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="mb-3">Tren Tamu 7 Hari Terakhir</h5>
                    <canvas id="chart7hari"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h5 class="mb-3">Data Per Bulan {{ Carbon\Carbon::now()->format('Y') }}</h5>
                    <canvas id="chartBulanan"></canvas>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Rekap Per Bulan {{ Carbon\Carbon::now()->format('Y') }}</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th class="text-end">Jumlah Tamu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($labelsBulan as $index => $bulan)
                                    <tr>
                                        <td>{{ $bulan }}</td>
                                        <td class="text-end">{{ $dataPerBulan[$index] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td>Total</td>
                                        <td class="text-end">{{ $totalTamu }}</td>
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
                            @foreach($tamuTerbaru as $tamu)
                            <li class="list-group-item px-0">
                                <strong>{{ $tamu->nama }}</strong><br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($tamu->created_at)->format('d M Y H:i') }}</small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx7hari = document.getElementById('chart7hari').getContext('2d');
        const gradient7hari = ctx7hari.createLinearGradient(0, 0, 0, 300);
        gradient7hari.addColorStop(0, 'rgba(78, 115, 223, 0.3)');
        gradient7hari.addColorStop(1, 'rgba(78, 115, 223, 0.02)');

        new Chart(ctx7hari, {
            type: 'line',
            data: {
                labels: @json($labels7hari),
                datasets: [{
                    label: 'Jumlah Tamu',
                    data: @json($hariTerakhir),
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
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' tamu';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
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
                labels: @json($labelsBulan),
                datasets: [{
                    label: 'Jumlah Tamu',
                    data: @json($dataPerBulan),
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
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' tamu';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toast')
</body>
</html>
