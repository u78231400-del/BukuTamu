@extends('layouts.admin')

@section('title', 'Jadwal Venue')
@section('subtitle', 'Kelola jadwal offline, acara internal, dan blokir venue.')

@section('content')

<div class="container-fluid px-0">

    @if(session('success'))
        <div class="admin-alert alert-success mb-4">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="admin-alert alert-danger mb-4">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif


    <div class="admin-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark);">
                    <i class="bi bi-calendar3 me-2" style="color: var(--primary);"></i>
                    Jadwal Venue
                </h4>

                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Kelola jadwal offline, acara internal, dan blokir venue.
                </p>
            </div>

            <a href="{{ route('owner.schedules.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Jadwal
            </a>

        </div>
    </div>


        <div class="row g-3 g-lg-4 mb-4">

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Total Jadwal
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $stats['total'] }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-calendar3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Reservasi Online
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: #059669;">
                            {{ $stats['online'] }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #ecfdf5; color: #059669;">
                        <i class="bi bi-globe"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Booking Offline
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: #0891b2;">
                            {{ $stats['offline'] }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #ecfeff; color: #0891b2;">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Venue Diblokir
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: #dc2626;">
                            {{ $stats['blocked'] }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #fef2f2; color: #dc2626;">
                        <i class="bi bi-slash-circle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="admin-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-1" style="color: var(--dark);">
                    Daftar Jadwal
                </h5>
                <p class="mb-0" style="font-size: 13px; color: var(--muted);">
                    Jadwal venue di luar reservasi customer.
                </p>
            </div>

            <span class="badge" style="background: var(--primary-soft); color: var(--primary);">
                {{ $schedules->count() }} Jadwal
            </span>
        </div>


        @if($schedules->isEmpty())

            <div class="text-center py-5">
                <div style="
                    width: 80px;
                    height: 80px;
                    background: var(--primary-soft);
                    border-radius: 50%;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 16px;
                ">
                    <i class="bi bi-calendar-x" style="font-size: 36px; color: var(--primary);"></i>
                </div>
                <h5 style="color: var(--dark);">
                    Belum Ada Jadwal
                </h5>
                <p style="color: var(--muted); font-size: 14px;">
                    Tambahkan jadwal untuk mencatat booking offline, acara internal, atau blokir venue.
                </p>
                <a href="{{ route('owner.schedules.create') }}" class="btn-primary-custom mt-2">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Jadwal
                </a>
            </div>

        @else

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Venue</th>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>
                                    <span style="font-size: 14px; font-weight: 500; color: var(--dark);">
                                        {{ $schedule->venue->nama_venue ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    <span style="font-size: 14px;">
                                        {{ $schedule->judul }}
                                    </span>
                                </td>

                                <td>
                                    @if($schedule->jenis === 'online')
                                        <span class="badge" style="background: #ecfdf5; color: #059669; padding: 6px 10px;">
                                            <i class="bi bi-globe me-1"></i>
                                            Reservasi Online
                                        </span>
                                    @elseif($schedule->jenis === 'offline')
                                        <span class="badge" style="background: #ecfeff; color: #0891b2; padding: 6px 10px;">
                                            <i class="bi bi-person-check me-1"></i>
                                            Booking Offline
                                        </span>
                                    @elseif($schedule->jenis === 'internal')
                                        <span class="badge" style="background: #f5f3ff; color: #7c3aed; padding: 6px 10px;">
                                            <i class="bi bi-building me-1"></i>
                                            Acara Internal
                                        </span>
                                    @elseif($schedule->jenis === 'blocked')
                                        <span class="badge" style="background: #fef2f2; color: #dc2626; padding: 6px 10px;">
                                            <i class="bi bi-slash-circle me-1"></i>
                                            Venue Diblokir
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span style="font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($schedule->tanggal_mulai)->format('d M Y') }}
                                    </span>
                                    @if($schedule->tanggal_selesai != $schedule->tanggal_mulai)
                                        <span style="font-size: 12px; color: var(--muted);">
                                            s/d {{ \Carbon\Carbon::parse($schedule->tanggal_selesai)->format('d M Y') }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span style="font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($schedule->waktu_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($schedule->waktu_selesai)->format('H:i') }}
                                    </span>
                                </td>

                                <td>
                                    <span style="font-size: 13px; color: var(--muted);">
                                        {{ Str::limit($schedule->keterangan, 50) ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    @if($schedule->jenis === 'online' && $schedule->reservation_id)
                                        <a href="{{ route('owner.reservations.index') }}"
                                           class="btn btn-sm"
                                           style="background: #ecfdf5; color: #059669; border: none;"
                                           title="Via Reservasi">
                                            <i class="bi bi-link-45deg"></i>
                                        </a>
                                    @else
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('owner.schedules.edit', $schedule->id) }}"
                                               class="btn btn-sm"
                                               style="background: #eff6ff; color: #2563eb; border: none;">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST"
                                                  action="{{ route('owner.schedules.destroy', $schedule->id) }}"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm"
                                                        style="background: #fef2f2; color: #dc2626; border: none;"
                                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?');">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>

</div>


<style>
.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
</style>

@endsection
