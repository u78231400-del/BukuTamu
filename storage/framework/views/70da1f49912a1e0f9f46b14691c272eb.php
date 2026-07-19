<?php $__env->startSection('title', 'Agenda - NurseCall'); ?>
<?php $__env->startSection('page-title', 'Agenda'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a href="/"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Agenda</span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="agenda-layout">
    <div class="card calendar-card no-print">
        <div class="calendar-header">
            <h3><i class="fas fa-calendar-alt me-2 text-primary"></i>Kalender</h3>
        </div>
        <form action="/agenda" method="GET">
            <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
            <div class="month-selector">
                <select name="month" onchange="this.form.submit()">
                    <?php for($m = 1; $m <= 12; $m++): ?>
                        <option value="<?php echo e($m); ?>" <?php echo e($m == $currentMonth ? 'selected' : ''); ?>>
                            <?php echo e(Carbon\Carbon::create(2024, $m, 1)->translatedFormat('F')); ?>

                        </option>
                    <?php endfor; ?>
                </select>
                <select name="year" onchange="this.form.submit()">
                    <?php for($y = date('Y') - 1; $y <= date('Y') + 1; $y++): ?>
                        <option value="<?php echo e($y); ?>" <?php echo e($y == $currentYear ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endfor; ?>
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
            <?php
                $firstDay = \Carbon\Carbon::create($currentYear, $currentMonth, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startDayOfWeek = $firstDay->dayOfWeek;
                $today = date('Y-m-d');
            ?>
            <?php for($i = 0; $i < $startDayOfWeek; $i++): ?>
                <div class="calendar-day empty"></div>
            <?php endfor; ?>
            <?php for($day = 1; $day <= $daysInMonth; $day++): ?>
                <?php
                    $date = sprintf('%s-%02d-%02d', $currentYear, $currentMonth, $day);
                    $isToday = $date === $today;
                    $hasEvents = isset($datesWithAppointments[$date]);
                    $classes = 'calendar-day';
                    if ($isToday) $classes .= ' today';
                    if ($hasEvents) $classes .= ' has-event';
                ?>
                <div class="<?php echo e($classes); ?>" onclick="filterByDate('<?php echo e($date); ?>')"><?php echo e($day); ?></div>
            <?php endfor; ?>
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
                <h3><i class="fas fa-calendar me-2 text-success"></i><?php echo e($currentMonthName); ?> <?php echo e($currentYear); ?></h3>
                <span class="badge badge-primary"><?php echo e($appointmentsByDate->flatten()->count()); ?> Janji</span>
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
            <h3 class="text-center mb-1">Agenda Janji</h3>
            <h5 class="text-center text-muted mb-0"><?php echo e($currentMonthName); ?> <?php echo e($currentYear); ?></h5>
            <hr>
        </div>

        <?php if($appointmentsByDate->isEmpty()): ?>
            <div class="agenda-empty" style="padding:4rem 1rem;">
                <i class="fas fa-calendar-times" style="font-size:3rem;margin-bottom:1rem;display:block;color:var(--gray-300);"></i>
                <h4 style="font-size:1.1rem;font-weight:600;color:var(--gray-700);">Tidak ada janji</h4>
                <p class="text-muted" style="margin:0.5rem 0 0;">Tidak ada janji yang disetujui untuk bulan ini.</p>
            </div>
        <?php else: ?>
            <div id="appointmentsList">
                <?php $__currentLoopData = $appointmentsByDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $appointments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $dateObj = \Carbon\Carbon::parse($date);
                        $isToday = $date === $today;
                        $isPast = $date < $today;
                    ?>
                    <div class="date-block" data-date="<?php echo e($date); ?>">
                        <div class="date-block-header">
                            <div class="date-block-title">
                                <i class="fas fa-calendar-day"></i>
                                <?php echo e($dateObj->translatedFormat('l, d F Y')); ?>

                                <?php if($isToday): ?>
                                    <span class="badge badge-primary no-print">Hari Ini</span>
                                <?php endif; ?>
                                <?php if($isPast): ?>
                                    <span class="badge badge-gray no-print">Lampau</span>
                                <?php endif; ?>
                            </div>
                            <span class="date-block-count"><?php echo e($appointments->count()); ?> janji</span>
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
                                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $jamJanji = \Carbon\Carbon::parse($apt->jam_janji)->format('H:i');
                                            $isPastRow = $date < $today || ($date == $today && $jamJanji < now()->format('H:i'));
                                            $rowStatus = $isPastRow ? 'selesai' : 'akan-datang';
                                        ?>
                                        <tr data-status="<?php echo e($rowStatus); ?>">
                                            <td data-label="Jam"><span class="time-badge"><?php echo e($jamJanji); ?></span></td>
                                            <td data-label="Nama">
                                                <div class="apt-name"><?php echo e($apt->nama); ?></div>
                                                <?php if($apt->pesan): ?>
                                                    <div class="apt-note"><?php echo e(Str::limit($apt->pesan, 50)); ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td data-label="HP">
                                                <span class="text-muted"><i class="fas fa-phone me-1" style="font-size:0.75rem;"></i><?php echo e($apt->nomor_hp); ?></span>
                                            </td>
                                            <td data-label="Tujuan">
                                                <span class="text-muted"><i class="fas fa-bullseye me-1" style="font-size:0.75rem;"></i><?php echo e($apt->tujuan); ?></span>
                                            </td>
                                            <td data-label="Jumlah">
                                                <span class="badge badge-gray"><i class="fas fa-users me-1" style="font-size:0.65rem;"></i><?php echo e($apt->jumlah_orang); ?></span>
                                            </td>
                                            <td data-label="Status">
                                                <?php if($isPastRow): ?>
                                                    <span class="badge badge-gray">Selesai</span>
                                                <?php else: ?>
                                                    <span class="badge badge-info">Akan Datang</span>
                                                <?php endif; ?>
                                            </td>
                                            <td data-label="Aksi">
                                                <?php if(auth()->guard()->check()): ?>
                                                <form action="<?php echo e(route('appointment.destroy', $apt->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus janji ini?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-icon btn-sm btn-outline" title="Hapus" style="color:var(--danger);opacity:0.5;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.5'">
                                                        <i class="fas fa-trash" style="font-size:0.75rem;"></i>
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bukutamu\resources\views/agenda.blade.php ENDPATH**/ ?>