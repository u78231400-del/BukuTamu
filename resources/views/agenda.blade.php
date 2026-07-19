@extends('layouts.app')

@section('title', 'Agenda Kunjungan - RS Medika')
@section('page-title', 'Agenda Kunjungan')
@section('breadcrumb')
    <a href="/"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Agenda Kunjungan</span>
@endsection

@push('styles')
<style>
    .agenda-layout { display: grid; grid-template-columns: 300px 1fr; gap: 1.5rem; }
    .calendar-card { position: sticky; top: calc(var(--header-height) + 1.5rem); }
    .calendar-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .calendar-header h3 { font-size: 0.95rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; padding: 1rem 1.25rem; }
    .calendar-day-header { font-size: 0.65rem; font-weight: 600; color: var(--gray-400); text-align: center; padding: 6px 0; text-transform: uppercase; }
    .calendar-day { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border-radius: var(--radius); font-size: 0.8rem; font-weight: 500; color: var(--gray-600); cursor: pointer; transition: var(--transition); position: relative; }
    .calendar-day:hover { background: var(--gray-100); }
    .calendar-day.today { background: var(--primary); color: white; font-weight: 600; }
    .calendar-day.has-event::after { content: ''; position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%); width: 4px; height: 4px; border-radius: 50%; background: var(--success); }
    .calendar-day.today.has-event::after { background: white; }
    .calendar-day.empty { cursor: default; }
    .calendar-day.empty:hover { background: transparent; }
    .month-selector { display: flex; gap: 0.5rem; padding: 0 1.25rem 1rem; }
    .month-selector select { flex: 1; height: 34px; padding: 0.25rem 0.5rem; font-size: 0.8rem; border: 1px solid var(--gray-200); border-radius: var(--radius); background: var(--bg-card); color: var(--gray-700); cursor: pointer; }
    .legend-wrap { display: flex; gap: 1rem; padding: 0.75rem 1.25rem; border-top: 1px solid var(--gray-200); }
    .legend-item { display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; color: var(--gray-500); cursor: pointer; padding: 4px 8px; border-radius: var(--radius); transition: var(--transition); }
    .legend-item:hover { background: var(--gray-100); }
    .legend-item.active { background: var(--gray-100); color: var(--gray-900); }
    .legend-dot { width: 8px; height: 8px; border-radius: 50%; }
    .agenda-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .agenda-title { display: flex; align-items: center; gap: 0.75rem; }
    .agenda-title h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .date-block { padding: 1.25rem; border-bottom: 1px solid var(--gray-100); }
    .date-block-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
    .date-block-title { font-size: 0.9rem; font-weight: 600; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; }
    .date-block-count { font-size: 0.75rem; color: var(--gray-500); }
    .apt-table { width: 100%; }
    .apt-table thead th { padding: 0.5rem 0.75rem; text-align: left; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-400); background: var(--gray-50); }
    .apt-table tbody td { padding: 0.75rem; border-bottom: 1px solid var(--gray-100); font-size: 0.875rem; vertical-align: middle; }
    .apt-table tbody tr:hover { background: var(--gray-50); }
    .time-badge { font-weight: 700; color: var(--primary); font-size: 0.875rem; white-space: nowrap; }
    .apt-name { font-weight: 600; color: var(--gray-900); }
    .apt-note { font-size: 0.75rem; color: var(--gray-400); margin-top: 2px; }
    .apt-meta { display: flex; gap: 1rem; font-size: 0.75rem; color: var(--gray-500); }
    .apt-meta span { display: flex; align-items: center; gap: 4px; }
    .empty-state { text-align: center; padding: 4rem 1rem; }
    .agenda-empty { text-align: center; padding: 4rem 1rem; color: var(--gray-400); }
    @media (max-width: 1024px) { .agenda-layout { grid-template-columns: 1fr; } .calendar-card { position: static; } }
    @media (max-width: 640px) { .apt-table thead { display: none; } .apt-table tbody td { display: block; padding: 0.25rem 0.75rem; } .apt-table tbody td:first-child { padding-top: 0.75rem; } .apt-table tbody td:last-child { padding-bottom: 0.75rem; } .apt-table tbody td::before { content: attr(data-label); font-weight: 600; color: var(--gray-500); font-size: 0.7rem; text-transform: uppercase; display: block; margin-bottom: 2px; } }
    @media print { .sidebar, .header, .mobile-toggle, .no-print, .calendar-card { display: none !important; } .agenda-layout { grid-template-columns: 1fr; } .main-wrapper { margin-left: 0 !important; } .card { box-shadow: none !important; border: 1px solid #ddd !important; } }
</style>
@endpush

@section('content')
<div class="agenda-layout">
    <div class="card calendar-card no-print">
        <div class="calendar-header">
            <h3><i class="fas fa-calendar-alt me-2 text-primary"></i>Kalender</h3>
        </div>
        <form action="/agenda" method="GET">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <div class="month-selector">
                <select name="month" onchange="this.form.submit()">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $currentMonth ? 'selected' : '' }}>
                            {{ Carbon\Carbon::create(2024, $m, 1)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
                <select name="year" onchange="this.form.submit()">
                    @for($y = date('Y') - 1; $y <= date('Y') + 1; $y++)
                        <option value="{{ $y }}" {{ $y == $currentYear ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </form>

        <div class="calendar-grid">
            <div class="calendar-day-header">Min</div>
            <div class="calendar-day-header">Sen</div>
            <div class="calendar-day-header">Sel</div>
            <div class="calendar-day-header">Rab</div>
            <div class="calendar-day-header">Kam</div>
            <div class="calendar-day-header">Jum</div>
            <div class="calendar-day-header">Sab</div>
            @php
                $firstDay = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startDayOfWeek = $firstDay->dayOfWeek;
                $today = date('Y-m-d');
            @endphp
            @for($i = 0; $i < $startDayOfWeek; $i++)
                <div class="calendar-day empty"></div>
            @endfor
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = sprintf('%s-%02d-%02d', $currentYear, $currentMonth, $day);
                    $isToday = $date === $today;
                    $hasEvents = isset($datesWithAppointments[$date]);
                    $classes = 'calendar-day';
                    if ($isToday) $classes .= ' today';
                    if ($hasEvents) $classes .= ' has-event';
                @endphp
                <div class="{{ $classes }}" onclick="filterByDate('{{ $date }}')">{{ $day }}</div>
            @endfor
        </div>

        <div class="legend-wrap">
            <div class="legend-item active" onclick="filterStatus('all', this)">
                <div class="legend-dot" style="background:#888;"></div>
                <span>Semua</span>
            </div>
            <div class="legend-item" onclick="filterStatus('akan-datang', this)">
                <div class="legend-dot" style="background:var(--primary);"></div>
                <span>Akan Datang</span>
            </div>
            <div class="legend-item" onclick="filterStatus('selesai', this)">
                <div class="legend-dot" style="background:var(--gray-400);"></div>
                <span>Selesai</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="agenda-header no-print">
            <div class="agenda-title">
                <h3><i class="fas fa-calendar me-2 text-success"></i>{{ $currentMonthName }} {{ $currentYear }}</h3>
                <span class="badge badge-primary">{{ $appointmentsByDate->flatten()->count() }} Jadwal</span>
            </div>
            <div class="flex gap-2">
                <button class="btn btn-sm btn-outline" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <button class="btn btn-sm btn-outline" onclick="showAll()">
                    <i class="fas fa-list"></i> Tampilkan Semua
                </button>
            </div>
        </div>

        <div class="print-header hidden">
            <h3 class="text-center mb-1">Agenda Kunjungan</h3>
            <h5 class="text-center text-muted mb-0">{{ $currentMonthName }} {{ $currentYear }}</h5>
            <hr>
        </div>

        @if($appointmentsByDate->isEmpty())
            <div class="agenda-empty" style="padding:4rem 1rem;">
                <i class="fas fa-calendar-times" style="font-size:3rem;margin-bottom:1rem;display:block;color:var(--gray-300);"></i>
                <h4 style="font-size:1.1rem;font-weight:600;color:var(--gray-700);">Tidak ada jadwal kunjungan</h4>
                <p class="text-muted" style="margin:0.5rem 0 0;">Tidak ada jadwal kunjungan yang disetujui untuk bulan ini.</p>
            </div>
        @else
            <div id="appointmentsList">
                @foreach($appointmentsByDate as $date => $appointments)
                    @php
                        $dateObj = \Carbon\Carbon::parse($date);
                        $isToday = $date === $today;
                        $isPast = $date < $today;
                    @endphp
                    <div class="date-block" data-date="{{ $date }}">
                        <div class="date-block-header">
                            <div class="date-block-title">
                                <i class="fas fa-calendar-day"></i>
                                {{ $dateObj->translatedFormat('l, d F Y') }}
                                @if($isToday)
                                    <span class="badge badge-primary no-print">Hari Ini</span>
                                @endif
                                @if($isPast)
                                    <span class="badge badge-gray no-print">Lampau</span>
                                @endif
                            </div>
                            <span class="date-block-count">{{ $appointments->count() }} kunjungan</span>
                        </div>
                        <div class="table-wrapper">
                            <table class="apt-table">
                                <thead>
                                    <tr>
                                        <th width="60">Jam</th>
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Tujuan</th>
                                        <th width="60">Jml</th>
                                        <th width="100">Status</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $apt)
                                        @php
                                            $jamJanji = \Carbon\Carbon::parse($apt->jam_janji)->format('H:i');
                                            $isPastRow = $date < $today || ($date == $today && $jamJanji < now()->format('H:i'));
                                            $rowStatus = $isPastRow ? 'selesai' : 'akan-datang';
                                        @endphp
                                        <tr data-status="{{ $rowStatus }}">
                                            <td data-label="Jam"><span class="time-badge">{{ $jamJanji }}</span></td>
                                            <td data-label="Nama">
                                                <div class="apt-name">{{ $apt->nama }}</div>
                                                @if($apt->pesan)
                                                    <div class="apt-note">{{ Str::limit($apt->pesan, 50) }}</div>
                                                @endif
                                            </td>
                                            <td data-label="HP">
                                                <span class="text-muted"><i class="fas fa-phone me-1" style="font-size:0.75rem;"></i>{{ $apt->nomor_hp }}</span>
                                            </td>
                                            <td data-label="Tujuan">
                                                <span class="text-muted"><i class="fas fa-bullseye me-1" style="font-size:0.75rem;"></i>{{ $apt->tujuan }}</span>
                                            </td>
                                            <td data-label="Jumlah">
                                                <span class="badge badge-gray"><i class="fas fa-users me-1" style="font-size:0.65rem;"></i>{{ $apt->jumlah_orang }}</span>
                                            </td>
                                            <td data-label="Status">
                                                @if($isPastRow)
                                                    <span class="badge badge-gray">Selesai</span>
                                                @else
                                                    <span class="badge badge-info">Akan Datang</span>
                                                @endif
                                            </td>
                                            <td data-label="Aksi">
                                                @auth
                                                 <form action="{{ route('appointment.destroy', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-outline" title="Hapus" style="color:var(--danger);opacity:0.5;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.5'">
                                                        <i class="fas fa-trash" style="font-size:0.75rem;"></i>
                                                    </button>
                                                </form>
                                                @endauth
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentStatusFilter = 'all';

    function filterStatus(status, el) {
        currentStatusFilter = status;
        document.querySelectorAll('.legend-item').forEach(item => item.classList.remove('active'));
        el.classList.add('active');
        document.querySelectorAll('tr[data-status]').forEach(row => {
            row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
        });
    }

    function filterByDate(date) {
        document.querySelectorAll('.date-block').forEach(el => {
            el.style.display = el.dataset.date === date ? 'block' : 'none';
        });
    }

    function showAll() {
        document.querySelectorAll('.date-block').forEach(el => el.style.display = 'block');
        document.querySelectorAll('.legend-item').forEach(item => item.classList.remove('active'));
        document.querySelector('.legend-item').classList.add('active');
        document.querySelectorAll('tr[data-status]').forEach(row => row.style.display = '');
    }
</script>
@endpush
