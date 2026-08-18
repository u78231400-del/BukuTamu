@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
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

<div class="row g-3 mb-3">
    <div class="col-md-3">
        <div class="card stat-box stat-total" style="padding: 12px 15px; border-radius: 10px; color: #fff;">
            <div class="d-flex align-items-center gap-2">
                <div style="font-size: 24px; opacity: 0.9;">&#128100;</div>
                <div>
                    <div style="font-size: 1.4rem; font-weight: 700; line-height: 1;">{{ $totalTamu }}</div>
                    <div style="font-size: 0.7rem; opacity: 0.9; margin-top: 2px;">Total Tamu</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-box" style="padding: 12px 15px; border-radius: 10px; color: #fff; background: linear-gradient(135deg, #1cc88a, #13855c);">
            <div class="d-flex align-items-center gap-2">
                <div style="font-size: 24px; opacity: 0.9;">&#128197;</div>
                <div>
                    <div style="font-size: 1.4rem; font-weight: 700; line-height: 1;">{{ $tamuHariIni }}</div>
                    <div style="font-size: 0.7rem; opacity: 0.9; margin-top: 2px;">Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-box" style="padding: 12px 15px; border-radius: 10px; color: #fff; background: linear-gradient(135deg, #f6c23e, #dda20a);">
            <div class="d-flex align-items-center gap-2">
                <div style="font-size: 24px; opacity: 0.9;">&#128202;</div>
                <div>
                    <div style="font-size: 1.4rem; font-weight: 700; line-height: 1;">{{ $tamuMingguIni }}</div>
                    <div style="font-size: 0.7rem; opacity: 0.9; margin-top: 2px;">Minggu Ini</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-box" style="padding: 12px 15px; border-radius: 10px; color: #fff; background: linear-gradient(135deg, #e74a3b, #c0392b);">
            <div class="d-flex align-items-center gap-2">
                <div style="font-size: 24px; opacity: 0.9;">&#128198;</div>
                <div>
                    <div style="font-size: 1.4rem; font-weight: 700; line-height: 1;">{{ $tamuBulanIni }}</div>
                    <div style="font-size: 0.7rem; opacity: 0.9; margin-top: 2px;">Bulan Ini</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-6 col-md-4">
        <div class="card text-center py-2 px-3" style="border-radius: 8px;">
            <h6 class="mb-1" style="font-size: 0.75rem;">Status Janji</h6>
            <canvas id="chartJanji" style="max-height: 90px;"></canvas>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="padding: 8px 12px; border-radius: 6px;">
            <h6 class="mb-1" style="font-size: 0.75rem;">Tren Tamu 7 Hari</h6>
            <canvas id="chart7hari" style="max-height: 70px;"></canvas>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-8">
        <div class="card" style="padding: 15px; border-radius: 10px;">
            <h6 class="mb-2">Data Per Bulan {{ Carbon\Carbon::now()->format('Y') }}</h6>
            <canvas id="chartBulanan"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center" style="padding: 12px; border-radius: 10px;">
            <h6 class="mb-2">Status Janji Tamu</h6>
            <div class="row g-2">
                <div class="col-4">
                    <div class="p-2 rounded text-center" style="background:#f6c23e20; border:1px solid #f6c23e;">
                        <div class="fw-bold" style="color:#dda20a; font-size: 1rem;">{{ $appointmentMenunggu }}</div>
                        <div class="small text-muted">Menunggu</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 rounded text-center" style="background:#1cc88a20; border:1px solid #1cc88a;">
                        <div class="fw-bold" style="color:#13855c; font-size: 1rem;">{{ $appointmentDisetujui }}</div>
                        <div class="small text-muted">Disetujui</div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 rounded text-center" style="background:#e74a3b20; border:1px solid #e74a3b;">
                        <div class="fw-bold" style="color:#c0392b; font-size: 1rem;">{{ $appointmentDitolak }}</div>
                        <div class="small text-muted">Ditolak</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card" style="border-radius: 10px;">
            <div class="card-body" style="padding: 15px;">
                <h6 class="mb-2">Rekap Per Bulan {{ Carbon\Carbon::now()->format('Y') }}</h6>
                <div class="table-responsive" style="max-height: 200px;">
                    <table class="table table-hover table-sm mb-0">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="border-radius: 10px;">
            <div class="card-body" style="padding: 15px;">
                <h6 class="mb-2">Tamu Terbaru</h6>
                <ul class="list-group list-group-flush list-group-sm">
                    @foreach($tamuTerbaru as $tamu)
                    <li class="list-group-item px-0 py-2">
                        <strong>{{ $tamu->nama }}</strong><br>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($tamu->created_at)->format('d M Y H:i') }}</small>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxJanji = document.getElementById('chartJanji').getContext('2d');
    new Chart(ctxJanji, {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'Disetujui', 'Ditolak'],
            datasets: [{
                data: [{{ $appointmentMenunggu }}, {{ $appointmentDisetujui }}, {{ $appointmentDitolak }}],
                backgroundColor: ['#f6c23e', '#1cc88a', '#e74a3b'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 15, font: { size: 12 } } },
                tooltip: { backgroundColor: '#333', padding: 10, cornerRadius: 8 }
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
                tooltip: { backgroundColor: '#333', titleFont: { size: 13 }, bodyFont: { size: 12 }, padding: 10, cornerRadius: 8 }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
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
                tooltip: { backgroundColor: '#333', titleFont: { size: 13 }, bodyFont: { size: 12 }, padding: 10, cornerRadius: 8 }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush
