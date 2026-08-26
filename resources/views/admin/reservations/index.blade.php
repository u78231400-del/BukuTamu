@extends('layouts.admin')

@section('title', 'Kelola Reservasi')
@section('subtitle', 'Kelola dan pantau reservasi customer')

@section('content')

<style>
    .reservation-page {
        max-width: 1180px;
        margin: 0 auto;
    }

    .reservation-header {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(30, 41, 59, 0.05);
    }

    .reservation-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .reservation-header h1 {
        margin: 0 0 6px;
        font-size: 24px;
        font-weight: 700;
        color: #172033;
    }

    .reservation-header p {
        margin: 0;
        color: #718096;
        font-size: 13px;
    }

    .reservation-summary {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff1f5;
        color: #d9466f;
        padding: 10px 15px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .reservation-card {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(30, 41, 59, 0.05);
    }

    .reservation-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .reservation-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    .reservation-table thead {
        background: #fff7fa;
    }

    .reservation-table th {
        padding: 15px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        border-bottom: 1px solid #f1e5eb;
        white-space: nowrap;
    }

    .reservation-table td {
        padding: 16px;
        font-size: 13px;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .reservation-table tbody tr {
        transition: background .2s ease;
    }

    .reservation-table tbody tr:hover {
        background: #fffafb;
    }

    .booking-code {
        display: inline-flex;
        align-items: center;
        padding: 6px 9px;
        border-radius: 7px;
        background: #fff1f5;
        color: #d9466f;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .customer-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 3px;
    }

    .customer-email {
        color: #94a3b8;
        font-size: 11px;
    }

    .venue-name {
        font-weight: 600;
        color: #334155;
    }

    .date-main {
        font-weight: 500;
        color: #334155;
    }

    .date-sub {
        margin-top: 3px;
        color: #94a3b8;
        font-size: 11px;
    }

    .time-info {
        white-space: nowrap;
        color: #475569;
    }

    .participant-info {
        white-space: nowrap;
        color: #475569;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff7df;
        color: #a16207;
    }

    .status-approved {
        background: #ecfdf5;
        color: #047857;
    }

    .status-rejected {
        background: #fef2f2;
        color: #dc2626;
    }

    .action-group {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .action-group form {
        margin: 0;
    }

    .btn-approve,
    .btn-reject {
        border: 0;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: .2s ease;
    }

    .btn-approve {
        background: #ecfdf5;
        color: #047857;
    }

    .btn-approve:hover {
        background: #d1fae5;
    }

    .btn-reject {
        background: #fff1f2;
        color: #dc2626;
    }

    .btn-reject:hover {
        background: #ffe4e6;
    }

    .admin-alert {
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 18px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .alert-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #d1fae5;
    }

    .alert-danger {
        background: #fff1f2;
        color: #be123c;
        border: 1px solid #ffe4e6;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #94a3b8;
    }

    .empty-state i {
        display: block;
        font-size: 42px;
        color: #d48aaa;
        margin-bottom: 12px;
    }

    .empty-state strong {
        display: block;
        color: #475569;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .empty-state span {
        font-size: 12px;
    }

    @media (max-width: 700px) {
        .reservation-header {
            padding: 18px;
        }

        .reservation-header-content {
            align-items: flex-start;
            flex-direction: column;
        }

        .reservation-summary {
            width: 100%;
            justify-content: center;
        }
    }
</style>


<div class="reservation-page">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- HEADER --}}
    <div class="reservation-header">

        <div class="reservation-header-content">

            <div>
                <h1>Daftar Reservasi</h1>

                <p>
                    Periksa dan proses reservasi customer.
                </p>
            </div>

            <div class="reservation-summary">
                <i class="bi bi-calendar-check"></i>

                {{ $reservations->count() }}
                Reservasi
            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="reservation-card">

        <div class="reservation-table-wrapper">

            <table class="reservation-table">

                <thead>

                    <tr>
                        <th>Kode Booking</th>
                        <th>Customer</th>
                        <th>Venue</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Peserta</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($reservations as $reservation)

                        <tr>

                            {{-- KODE --}}
                            <td>
                                <span class="booking-code">
                                    {{ $reservation->kode_booking }}
                                </span>
                            </td>


                            {{-- CUSTOMER --}}
                            <td>

                                <div class="customer-name">
                                    {{ $reservation->user->name ?? '-' }}
                                </div>

                                <div class="customer-email">
                                    {{ $reservation->user->email ?? '-' }}
                                </div>

                            </td>


                            {{-- VENUE --}}
                            <td>

                                <div class="venue-name">
                                    {{ $reservation->venue->nama_venue ?? '-' }}
                                </div>

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                <div class="date-main">
                                    {{ $reservation->tanggal_mulai }}
                                </div>

                                @if($reservation->tanggal_selesai != $reservation->tanggal_mulai)

                                    <div class="date-sub">
                                        s/d {{ $reservation->tanggal_selesai }}
                                    </div>

                                @endif

                            </td>


                            {{-- WAKTU --}}
                            <td>

                                <div class="time-info">
                                    {{ $reservation->waktu_mulai }}
                                    -
                                    {{ $reservation->waktu_selesai }}
                                </div>

                            </td>


                            {{-- PESERTA --}}
                            <td>

                                <div class="participant-info">
                                    <i class="bi bi-people"></i>
                                    {{ $reservation->jumlah_peserta }} orang
                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($reservation->status === 'pending')

                                    <span class="status-badge status-pending">
                                        <i class="bi bi-clock-history"></i>
                                        Menunggu
                                    </span>

                                @elseif($reservation->status === 'approved')

                                    <span class="status-badge status-approved">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Disetujui
                                    </span>

                                @elseif($reservation->status === 'rejected')

                                    <span class="status-badge status-rejected">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Ditolak
                                    </span>

                                @else

                                    <span class="status-badge"
                                          style="background:#f1f5f9; color:#475569;">

                                        {{ ucfirst($reservation->status) }}

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                @if($reservation->status === 'pending')

                                    <div class="action-group">

                                        <form method="POST"
                                              action="{{ route('admin.reservations.approve', $reservation->id) }}">

                                            @csrf

                                            <button type="submit"
                                                    class="btn-approve"
                                                    title="Setujui reservasi">

                                                <i class="bi bi-check-lg"></i>
                                                Setujui

                                            </button>

                                        </form>


                                        <form method="POST"
                                              action="{{ route('admin.reservations.reject', $reservation->id) }}">

                                            @csrf

                                            <button type="submit"
                                                    class="btn-reject"
                                                    title="Tolak reservasi">

                                                <i class="bi bi-x-lg"></i>
                                                Tolak

                                            </button>

                                        </form>

                                    </div>

                                @else

                                    <span style="font-size:11px; color:#94a3b8;">
                                        Sudah diproses
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="empty-state">

                                    <i class="bi bi-calendar-x"></i>

                                    <strong>Belum ada reservasi</strong>

                                    <span>
                                        Reservasi customer akan muncul di halaman ini.
                                    </span>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection