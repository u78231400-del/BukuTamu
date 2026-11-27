@extends('layouts.admin')

@section('title', 'Laporan')
@section('subtitle', 'Laporan venue saya')

@section('content')

<div class="container-fluid px-0">

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark);">
                    Laporan Venue Saya
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Berikut laporan data reservasi venue milik Anda.
                </p>
            </div>
        </div>
    </div>

    <div class="admin-card p-4 mb-4">
        <h5 class="fw-bold mb-3" style="color: var(--dark);">
            <i class="bi bi-funnel me-2" style="color: var(--primary);"></i>
            Filter Laporan
        </h5>
        <form method="GET" action="{{ route('owner.reports.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label for="tanggal_mulai" class="form-label" style="font-size: 12px; font-weight: 600; color: var(--text);">Tanggal Mulai</label>
                    <input type="date" class="form-control form-control-sm" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="col-md-2">
                    <label for="tanggal_akhir" class="form-label" style="font-size: 12px; font-weight: 600; color: var(--text);">Tanggal Akhir</label>
                    <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label" style="font-size: 12px; font-weight: 600; color: var(--text);">Status</label>
                    <select class="form-select form-select-sm" id="status" name="status">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="venue_id" class="form-label" style="font-size: 12px; font-weight: 600; color: var(--text);">Venue</label>
                    <select class="form-select form-select-sm" id="venue_id" name="venue_id">
                        <option value="">Semua Venue Saya</option>
                        @foreach($ownerVenues as $venue)
                            <option value="{{ $venue->id }}" {{ request('venue_id') == $venue->id ? 'selected' : '' }}>
                                {{ $venue->nama_venue }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-auto">
                    <label class="form-label d-none d-md-block">&nbsp;</label>
                    <button type="submit" class="btn-cari">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
                @if(request()->has('tanggal_mulai') || request()->has('tanggal_akhir') || request()->has('status') || request()->has('venue_id'))
                <div class="col-md-1">
                    <label class="form-label d-none d-md-block">&nbsp;</label>
                    <a href="{{ route('owner.reports.index') }}" class="btn btn-secondary btn-sm w-100">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Total Venue</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['totalVenue'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Venue Aktif</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['venueAvailable'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #ecfdf5; color: #16a34a;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Total Reservasi</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['totalReservation'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #fff7ed; color: #ea580c;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Pending</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['reservationPending'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #fefce8; color: #ca8a04;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Disetujui</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['reservationApproved'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #ecfdf5; color: #16a34a;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Ditolak</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['reservationRejected'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #fff1f2; color: #dc2626;">
                        <i class="bi bi-x-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">Dibatalkan</div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">{{ $stats['reservationCanceled'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #f1f5f9; color: #64748b;">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0" style="color: var(--dark);">
                <i class="bi bi-table me-2" style="color: var(--primary);"></i>
                Daftar Reservasi
            </h5>
            <span class="badge" style="background: var(--primary-soft); color: var(--primary);">
                {{ $reservations->count() }} Reservasi
            </span>
        </div>

        @if($reservations->isEmpty())
            <div class="text-center py-5">
                <div style="width: 80px; height: 80px; background: var(--primary-soft); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <i class="bi bi-inbox" style="font-size: 36px; color: var(--primary);"></i>
                </div>
                <h5 style="color: var(--dark); margin-bottom: 8px;">Tidak Ada Data</h5>
                <p style="color: var(--muted); font-size: 14px; margin-bottom: 20px;">
                    Tidak ada reservasi yang sesuai dengan filter yang dipilih.
                </p>
            </div>
        @else
            <div class="table-responsive-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Venue</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Peserta</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $reservation->kode_booking }}</span>
                            </td>
                            <td>{{ $reservation->venue->nama_venue ?? '-' }}</td>
                            <td>{{ $reservation->user->name ?? '-' }}</td>
                            <td>{{ Carbon\Carbon::parse($reservation->tanggal_mulai)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($reservation->tanggal_selesai)->format('d/m/Y') }}</td>
                            <td>{{ substr($reservation->waktu_mulai, 0, 5) }} - {{ substr($reservation->waktu_selesai, 0, 5) }}</td>
                            <td>{{ $reservation->jumlah_peserta }} org</td>
                            <td>
                                @if($reservation->status === 'pending')
                                    <span class="status-badge status-pending">
                                        <i class="bi bi-hourglass-split"></i> Pending
                                    </span>
                                @elseif($reservation->status === 'approved')
                                    <span class="status-badge status-approved">
                                        <i class="bi bi-check-circle"></i> Disetujui
                                    </span>
                                @elseif($reservation->status === 'rejected')
                                    <span class="status-badge status-rejected">
                                        <i class="bi bi-x-circle"></i> Ditolak
                                    </span>
                                @elseif($reservation->status === 'canceled')
                                    <span class="status-badge" style="background: #f1f5f9; color: #64748b;">
                                        <i class="bi bi-x-lg"></i> Dibatalkan
                                    </span>
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

    .form-label {
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border-radius: 9px;
        border: 1px solid var(--border);
        padding: 10px 12px;
        font-size: 13px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 68, 93, 0.1);
    }

    .btn-cari {
        background: var(--primary);
        border: none;
        color: white;
        border-radius: 9px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        transition: all .2s ease;
        height: 38px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-cari:hover {
        background: var(--primary-dark);
        color: white;
    }

    @media (max-width: 768px) {
        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
    }
</style>

@endsection
