<!DOCTYPE html>
<html>
<head>
    <title>Agenda Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .page-title { color: #333; font-weight: 600; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .card-header { background: white; border-bottom: 1px solid #eee; padding: 15px 20px; }
        .date-display { font-size: 18px; font-weight: 600; color: #4e73df; }
        .btn-nav { background: white; border: 1px solid #ddd; color: #333; padding: 8px 15px; border-radius: 8px; transition: all 0.2s; }
        .btn-nav:hover { background: #4e73df; color: white; border-color: #4e73df; }
        .calendar-mini { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; }
        .calendar-mini .day-header { font-size: 11px; color: #999; text-align: center; font-weight: 600; padding: 6px; }
        .calendar-mini .day { text-align: center; padding: 8px; border-radius: 6px; font-size: 13px; cursor: pointer; transition: all 0.2s; }
        .calendar-mini .day:hover { background: #e9ecef; }
        .calendar-mini .day.today { background: #4e73df; color: white; font-weight: 600; }
        .calendar-mini .day.has-events { position: relative; }
        .calendar-mini .day.has-events::after { content: ''; position: absolute; bottom: 3px; left: 50%; transform: translateX(-50%); width: 5px; height: 5px; background: #1cc88a; border-radius: 50%; }
        .calendar-mini .day.today.has-events::after { background: white; }
        .calendar-mini .day.past { opacity: 0.5; background: #f8f9fa; color: #999; }
        .calendar-mini .day.selected { background: #1cc88a; color: white; font-weight: 600; }
        .calendar-mini .day.selected.has-events::after { background: white; }
        .table { font-size: 0.9rem; }
        .table thead th { background: #f8f9fa; border-bottom: 2px solid #dee2e6; font-weight: 600; color: #555; padding: 8px 0; }
        .guest-note { color: #555555; }
        .table tbody tr:hover { background: #f8f9fa; }
        .badge-disetujui { background: #1cc88a; }
        .badge-selesai { background: #6c757d; color: white; }
        .badge-akan-datang { background: #4e73df; color: white; }
        .badge-menunggu { background: #f6c23e; color: #000; }
        .badge-ditolak { background: #e74a3b; }
        .legend { display: flex; gap: 20px; font-size: 13px; }
        .legend-item { display: flex; align-items: center; gap: 6px; cursor: pointer; padding: 4px 8px; border-radius: 6px; transition: all 0.2s; }
        .legend-item:hover { background: rgba(0,0,0,0.05); }
        .legend-item.active { opacity: 1; }
        .legend-item:not(.active) { opacity: 0.5; }
        .legend-item.filter-all { opacity: 0.5; }
        .legend-item.filter-all.active { opacity: 1; }
        .legend-dot { width: 12px; height: 12px; border-radius: 50%; }
        .navbar-collapse { background: #0d6efd; margin-top: 10px; padding: 10px; border-radius: 8px; }
        .navbar-collapse .nav-link { padding: 8px 12px; }
        .navbar-mobile-menu { display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); min-width: 180px; z-index: 1000; overflow: hidden; }
        .navbar-mobile-menu.show { display: block; }
        .navbar-mobile-menu .nav-link { color: #333 !important; padding: 12px 16px; border-bottom: 1px solid #eee; display: block; }
        .navbar-mobile-menu .nav-link:last-child { border-bottom: none; }
        .navbar-mobile-menu .nav-link:hover { background: #f8f9fa; }
        .navbar-mobile-menu .nav-link.active { background: #e7f1ff; color: #0d6efd !important; }
        .no-data { text-align: center; padding: 40px 20px; color: #999; }
        .date-section { background: #f8f9fa; border-radius: 8px; padding: 10px 15px; margin-bottom: 15px; border-left: 4px solid #4e73df; }
        .date-section-title { font-weight: 600; color: #4e73df; margin: 0; font-size: 14px; }
        .date-section-count { font-size: 12px; color: #888; }
        .select-month { min-width: 180px; }
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
            <a class="navbar-brand" href="/">Buku Tamu</a>
            <div class="d-flex align-items-center gap-2">
                <div class="navbar-mobile-menu" id="mobileMenu">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                    <a class="nav-link active" href="/agenda">Agenda</a>
                </div>
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                    <a class="nav-link active" href="/agenda">Agenda</a>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function toggleMobileMenu() { var menu = document.getElementById('mobileMenu'); menu.classList.toggle('show'); }
        document.addEventListener('click', function(e) { var menu = document.getElementById('mobileMenu'); if (!e.target.closest('.d-flex')) menu.classList.remove('show'); });
    </script>

    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h2 class="page-title mb-0">Agenda Janji</h2>
                    <div class="legend">
                        <div class="legend-item filter-all active" onclick="filterStatus('all', this)">
                            <div class="legend-dot" style="background: #888;"></div>
                            <span>Semua</span>
                        </div>
                        <div class="legend-item" onclick="filterStatus('akan-datang', this)">
                            <div class="legend-dot" style="background: #4e73df;"></div>
                            <span>Akan Datang</span>
                        </div>
                        <div class="legend-item" onclick="filterStatus('selesai', this)">
                            <div class="legend-dot" style="background: #6c757d;"></div>
                            <span>Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <form action="/agenda" method="GET" id="monthForm">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fas fa-calendar-alt text-primary"></i>
                            <select name="month" id="monthSelect" class="form-select form-select-sm select-month" onchange="document.getElementById('monthForm').submit()">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $currentMonth ? 'selected' : '' }}>
                                        {{ Carbon\Carbon::create(2024, $m, 1)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="fas fa-calendar text-primary"></i>
                            <select name="year" id="yearSelect" class="form-select form-select-sm select-month" onchange="document.getElementById('monthForm').submit()">
                                @for($y = date('Y') - 2; $y <= date('Y') + 1; $y++)
                                    <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </form>

                    <div class="calendar-mini" id="calendarMini">
                        <div class="day-header">Min</div>
                        <div class="day-header">Sen</div>
                        <div class="day-header">Sel</div>
                        <div class="day-header">Rab</div>
                        <div class="day-header">Kam</div>
                        <div class="day-header">Jum</div>
                        <div class="day-header">Sab</div>
                        @php
                            $firstDay = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                            $daysInMonth = $firstDay->daysInMonth;
                            $startDayOfWeek = $firstDay->dayOfWeek;
                            $today = date('Y-m-d');
                        @endphp

                        @for($i = 0; $i < $startDayOfWeek; $i++)
                            <div class="day"></div>
                        @endfor

                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = sprintf('%s-%02d-%02d', $currentYear, $currentMonth, $day);
                                $isToday = $date === $today;
                                $isPast = $date < $today;
                                $hasEvents = isset($datesWithAppointments[$date]);
                                if (!$hasEvents) continue;
                                $classes = 'day';
                                if ($isToday) $classes .= ' today';
                                if ($isPast && !$isToday) $classes .= ' past';
                                if ($hasEvents) $classes .= ' has-events';
                            @endphp
                            <div class="{{ $classes }}" onclick="filterByDate('{{ $date }}')">{{ $day }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <h4 class="mb-0">
                                <i class="fas fa-calendar-month text-primary"></i>
                                {{ $currentMonthName }} {{ $currentYear }}
                            </h4>
                            <span class="badge bg-primary">
                                {{ $appointmentsByDate->flatten()->count() }} Janji
                            </span>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" onclick="showAll()">
                            <i class="fas fa-list"></i> Tampilkan Semua
                        </button>
                    </div>

                    <hr>

                    @if($appointmentsByDate->isEmpty())
                        <div class="no-data">
                            <i class="fas fa-calendar-times fa-3x mb-3 text-muted"></i>
                            <h5>Tidak ada janji</h5>
                            <p>Tidak ada janji yang disetujui untuk bulan ini.</p>
                        </div>
                    @else
                        <div id="appointmentsList">
                            @foreach($appointmentsByDate as $date => $appointments)
                                @php
                                    $dateObj = \Carbon\Carbon::parse($date);
                                    $isToday = $date === $today;
                                    $isPast = $date < $today;
                                @endphp
                                <div class="date-section mb-3" data-date="{{ $date }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="date-section-title">
                                            <i class="far fa-calendar"></i>
                                            {{ $dateObj->translatedFormat('l, d F Y') }}
                                            @if($isToday)
                                                <span class="badge bg-primary ms-2">Hari Ini</span>
                                            @endif
                                            @if($isPast)
                                                <span class="badge bg-secondary ms-2">Lampau</span>
                                            @endif
                                        </h5>
                                        <span class="date-section-count">{{ $appointments->count() }} janji</span>
                                    </div>
                                </div>
                                <div class="table-responsive mb-4" id="table-{{ str_replace('-', '', $date) }}">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th width="80">Jam</th>
                                                <th>Nama</th>
                                                <th>No. HP</th>
                                                <th>Tujuan</th>
                                                <th width="80">Jumlah</th>
                                                <th width="100">Status</th>
                                                <th width="80">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appointments as $apt)
                                                @php
                                                    $jamJanji = \Carbon\Carbon::parse($apt->jam_janji)->format('H:i');
                                                    $isPast = $date < $today || ($date == $today && $jamJanji < now()->format('H:i'));
                                                    $rowStatus = $isPast ? 'selesai' : 'akan-datang';
                                                @endphp
                                                <tr data-status="{{ $rowStatus }}">
                                                    <td>
                                                        <span class="fw-bold text-primary">{{ $jamJanji }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="fw-semibold">{{ $apt->nama }}</div>
                                                        @if($apt->pesan)
                                                            <small class="guest-note">{{ Str::limit($apt->pesan, 50) }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-phone text-muted"></i> {{ $apt->nomor_hp }}
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-bullseye text-muted"></i> {{ $apt->tujuan }}
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-users text-muted"></i> {{ $apt->jumlah_orang }}
                                                    </td>
                                                    <td>
                                                        @if($isPast)
                                                            <span class="badge badge-selesai">Selesai</span>
                                                        @else
                                                            <span class="badge badge-akan-datang">Akan Datang</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!$isPast || $apt->status === 'disetujui')
                                                            <form action="{{ route('appointment.destroy', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus janji ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" style="opacity: 0.3;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.3'">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let currentStatusFilter = 'all';

        function filterStatus(status, el) {
            currentStatusFilter = status;
            document.querySelectorAll('.legend-item').forEach(item => {
                item.classList.remove('active');
                if (status === 'all') {
                    item.classList.remove('active');
                    if (item.classList.contains('filter-all')) {
                        item.classList.add('active');
                    }
                }
            });
            el.classList.add('active');

            document.querySelectorAll('tr[data-status]').forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterByDate(date) {
            document.querySelectorAll('.date-section').forEach(el => {
                el.style.display = el.dataset.date === date ? 'block' : 'none';
            });
            document.querySelectorAll('.table-responsive').forEach(el => {
                el.style.display = el.id === 'table-' + date.replace(/-/g, '') ? 'block' : 'none';
            });
        }

        function showAll() {
            document.querySelectorAll('.date-section').forEach(el => el.style.display = 'block');
            document.querySelectorAll('.table-responsive').forEach(el => el.style.display = 'block');
            filterStatus('all', document.querySelector('.filter-all'));
        }
    </script>
</body>
</html>
