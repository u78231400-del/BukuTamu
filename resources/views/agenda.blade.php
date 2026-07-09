<!DOCTYPE html>
<html>
<head>
    <title>Agenda Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .page-title { color: #333; font-weight: 600; }
        .date-nav { display: flex; align-items: center; gap: 15px; }
        .date-display { font-size: 18px; font-weight: 600; color: #4e73df; min-width: 250px; text-align: center; }
        .btn-nav { background: white; border: 1px solid #ddd; color: #333; padding: 8px 15px; border-radius: 8px; transition: all 0.2s; }
        .btn-nav:hover { background: #4e73df; color: white; border-color: #4e73df; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-total-sm { flex: 1; padding: 12px; border-radius: 10px; color: #fff; text-align: center; }
        .stat-card-sm .stat-number { font-size: 20px; font-weight: 700; }
        .stat-card-sm .stat-label { font-size: 10px; opacity: 0.9; }
        .time-slot { background: white; border: 1px solid #e0e0e0; border-radius: 10px; padding: 15px; margin-bottom: 10px; transition: all 0.2s; }
        .time-slot:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.1); transform: translateY(-2px); }
        .time-slot.has-appointment { border-left: 4px solid #1cc88a; }
        .time-slot.no-appointment { border-left: 4px solid #ddd; opacity: 0.7; }
        .time-label { font-weight: 600; color: #4e73df; font-size: 16px; }
        .guest-name { font-weight: 600; color: #333; font-size: 15px; margin-bottom: 4px; }
        .guest-info { color: #666; font-size: 13px; }
        .guest-badge { display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 11px; margin-right: 5px; }
        .badge-disetujui { background: #1cc88a; color: white; }
        .no-data { text-align: center; padding: 60px 20px; color: #999; }
        .no-data-icon { font-size: 60px; margin-bottom: 15px; }
        .legend { display: flex; gap: 20px; font-size: 13px; }
        .legend-item { display: flex; align-items: center; gap: 6px; }
        .legend-dot { width: 12px; height: 12px; border-radius: 50%; }
        .calendar-mini { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; margin-top: 15px; }
        .calendar-mini .day-header { font-size: 11px; color: #999; text-align: center; font-weight: 600; }
        .calendar-mini .day { text-align: center; padding: 6px; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.2s; }
        .calendar-mini .day:hover { background: #e9ecef; }
        .calendar-mini .day.today { background: #4e73df; color: white; font-weight: 600; }
        .calendar-mini .day.selected { background: #1cc88a; color: white; font-weight: 600; }
        .calendar-mini .day.has-events { position: relative; }
        .calendar-mini .day.has-events::after { content: ''; position: absolute; bottom: 2px; left: 50%; transform: translateX(-50%); width: 4px; height: 4px; background: #e74a3b; border-radius: 50%; }
        .calendar-mini .day.today.has-events::after { background: white; }
        .calendar-mini .day.selected.has-events::after { background: white; }
        .empty-day { color: #ccc; font-style: italic; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Buku Tamu</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link" href="/buat-janji">Buat Janji</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
                <a class="nav-link active" href="/agenda">Agenda</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="page-title mb-0">Agenda Janji</h2>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-dot" style="background: #1cc88a;"></div>
                            <span>Disetujui</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background: #4e73df;"></div>
                            <span>Hari Ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-3">
                <div class="bg-white p-3 rounded-3 shadow-sm">
                    <div class="date-nav mb-2">
                        <button class="btn-nav" onclick="changeMonth(-1)">&laquo;</button>
                        <span class="date-display" id="monthYearDisplay">{{ $currentMonthName }} {{ $currentYear }}</span>
                        <button class="btn-nav" onclick="changeMonth(1)">&raquo;</button>
                    </div>
                    <div class="d-flex gap-2 mb-2">
                        <button class="btn btn-sm btn-outline-primary flex-fill" onclick="goToToday()">Hari Ini</button>
                        <button class="btn btn-sm btn-primary flex-fill" onclick="goToDate('{{ $today }}')">Sekarang</button>
                    </div>
                    
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
                                $isSelected = $date === $selectedDate;
                                $hasEvents = isset($datesWithAppointments[$date]);
                                $classes = 'day';
                                if ($isToday) $classes .= ' today';
                                if ($isSelected) $classes .= ' selected';
                                if ($hasEvents) $classes .= ' has-events';
                            @endphp
                            <div class="{{ $classes }}" onclick="goToDate('{{ $date }}')">{{ $day }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="bg-white p-4 rounded-3 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="date-nav">
                            <button class="btn-nav" onclick="changeDate(-1)">&larr;</button>
                            <span class="date-display" id="dateDisplay">{{ $selectedDateFormatted }}</span>
                            <button class="btn-nav" onclick="changeDate(1)">&rarr;</button>
                        </div>
                        <div class="text-muted">
                            <strong>{{ $appointments->total() }}</strong> janji pada hari ini
                        </div>
                    </div>

                    <hr>

                    @if($appointments->isEmpty())
                        <div class="no-data">
                            <div class="no-data-icon">&#128197;</div>
                            <h5>Tidak ada janji</h5>
                            <p>Tidak ada janji yang disetujui untuk tanggal ini.</p>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($appointments as $apt)
                                <div class="col-md-6 col-lg-4">
                                    <div class="time-slot has-appointment">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="time-label">
                                                <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($apt->jam_janji)->format('H:i') }}
                                            </div>
                                            <span class="badge badge-disetujui">{{ ucfirst($apt->status) }}</span>
                                        </div>
                                        <div class="guest-name">
                                            <i class="far fa-user"></i> {{ $apt->nama }}
                                        </div>
                                        <div class="guest-info">
                                            <i class="fas fa-phone"></i> {{ $apt->nomor_hp }}<br>
                                            <i class="fas fa-bullseye"></i> {{ $apt->tujuan }}<br>
                                            <i class="fas fa-users"></i> {{ $apt->jumlah_orang }} orang
                                        </div>
                                        @if($apt->pesan)
                                            <div class="mt-2 p-2 bg-light rounded" style="font-size: 12px; color: #666;">
                                                <i class="fas fa-comment"></i> {{ Str::limit($apt->pesan, 80) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($appointments->total() > 0)
                <div class="d-flex justify-content-center mt-3">
                    {{ $appointments->appends(['date' => $selectedDate])->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        let currentMonth = {{ $currentMonth }};
        let currentYear = {{ $currentYear }};
        let selectedDate = '{{ $selectedDate }}';

        function changeMonth(direction) {
            currentMonth += direction;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            } else if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            window.location.href = '/agenda?month=' + currentMonth + '&year=' + currentYear + '&date=' + selectedDate;
        }

        function goToToday() {
            const today = new Date();
            currentMonth = today.getMonth() + 1;
            currentYear = today.getFullYear();
            const todayStr = today.toISOString().split('T')[0];
            window.location.href = '/agenda?month=' + currentMonth + '&year=' + currentYear + '&date=' + todayStr;
        }

        function goToDate(date) {
            const d = new Date(date);
            currentMonth = d.getMonth() + 1;
            currentYear = d.getFullYear();
            selectedDate = date;
            window.location.href = '/agenda?month=' + currentMonth + '&year=' + currentYear + '&date=' + date;
        }

        function changeDate(direction) {
            const d = new Date(selectedDate);
            d.setDate(d.getDate() + direction);
            goToDate(d.toISOString().split('T')[0]);
        }
    </script>
</body>
</html>
