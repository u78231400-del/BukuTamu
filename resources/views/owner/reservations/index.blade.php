@extends('layouts.admin')

@section('title', 'Reservasi Venue')
@section('subtitle', 'Kelola reservasi yang masuk ke venue Anda')

@section('content')

<div class="container-fluid px-0">

    {{-- Alert --}}
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


    {{-- Header --}}
    <div class="admin-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark);">
                    <i class="bi bi-calendar-check me-2" style="color: var(--primary);"></i>
                    Reservasi Venue
                </h4>

                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Daftar reservasi yang masuk untuk venue milik Anda.
                </p>
            </div>

            <a href="{{ route('owner.dashboard') }}" class="btn-secondary-custom">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Dashboard
            </a>

        </div>
    </div>


    {{-- Statistik --}}
    <div class="row g-3 g-lg-4 mb-4">

        {{-- Total --}}
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Total Reservasi
                        </div>

                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $reservations->count() }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                </div>
            </div>
        </div>


        {{-- Pending --}}
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Menunggu
                        </div>

                        <div class="fw-bold" style="font-size: 28px; color: #ca8a04;">
                            {{ $reservations->where('status', 'pending')->count() }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background: #fefce8; color: #ca8a04;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                </div>

            </div>
        </div>


        {{-- Approved --}}
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Disetujui
                        </div>

                        <div class="fw-bold" style="font-size: 28px; color: #16a34a;">
                            {{ $reservations->where('status', 'approved')->count() }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background: #ecfdf5; color: #16a34a;">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

            </div>
        </div>


        {{-- Rejected --}}
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Ditolak
                        </div>

                        <div class="fw-bold" style="font-size: 28px; color: #dc2626;">
                            {{ $reservations->where('status', 'rejected')->count() }}
                        </div>
                    </div>

                    <div class="stat-icon"
                         style="background: #fef2f2; color: #dc2626;">
                        <i class="bi bi-x-circle"></i>
                    </div>

                </div>

            </div>
        </div>

    </div>


    {{-- Daftar Reservasi --}}
    <div class="admin-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h5 class="fw-bold mb-1" style="color: var(--dark);">
                    Daftar Reservasi
                </h5>

                <p class="mb-0" style="font-size: 13px; color: var(--muted);">
                    Reservasi dari customer untuk venue Anda.
                </p>
            </div>

            <span class="badge"
                  style="background: var(--primary-soft); color: var(--primary);">
                {{ $reservations->count() }} Reservasi
            </span>

        </div>


        @if($reservations->isEmpty())

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
                    <i class="bi bi-calendar-x"
                       style="font-size: 36px; color: var(--primary);"></i>
                </div>

                <h5 style="color: var(--dark);">
                    Belum Ada Reservasi
                </h5>

                <p style="color: var(--muted); font-size: 14px;">
                    Belum ada customer yang melakukan reservasi pada venue Anda.
                </p>

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Kode Booking</th>
                            <th>Customer</th>
                            <th>Venue</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Peserta</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($reservations as $reservation)

                            <tr>

                                {{-- Kode --}}
                                <td>
                                    <span class="fw-semibold"
                                          style="color: var(--dark);">
                                        {{ $reservation->kode_booking }}
                                    </span>
                                </td>


                                {{-- Customer --}}
                                <td>

                                    <div class="fw-semibold"
                                         style="color: var(--dark);">
                                        {{ $reservation->user->name ?? '-' }}
                                    </div>

                                    <div style="
                                        font-size: 12px;
                                        color: var(--muted);
                                    ">
                                        {{ $reservation->user->email ?? '-' }}
                                    </div>

                                </td>


                                {{-- Venue --}}
                                <td>

                                    <span style="font-size: 14px;">
                                        {{ $reservation->venue->nama_venue ?? '-' }}
                                    </span>

                                </td>


                                {{-- Tanggal --}}
                                <td>

                                    <div style="font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($reservation->tanggal_mulai)->format('d M Y') }}
                                    </div>

                                    @if($reservation->tanggal_selesai != $reservation->tanggal_mulai)
                                        <div style="
                                            font-size: 12px;
                                            color: var(--muted);
                                        ">
                                            s/d
                                            {{ \Carbon\Carbon::parse($reservation->tanggal_selesai)->format('d M Y') }}
                                        </div>
                                    @endif

                                </td>


                                {{-- Waktu --}}
                                <td>

                                    <span style="font-size: 13px;">
                                        {{ \Carbon\Carbon::parse($reservation->waktu_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($reservation->waktu_selesai)->format('H:i') }}
                                    </span>

                                </td>


                                {{-- Peserta --}}
                                <td>

                                    <span style="font-size: 13px;">
                                        <i class="bi bi-people me-1"></i>
                                        {{ $reservation->jumlah_peserta }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($reservation->status === 'pending')

                                        <span class="badge"
                                              style="
                                                background: #fefce8;
                                                color: #ca8a04;
                                                padding: 6px 10px;
                                              ">
                                            <i class="bi bi-hourglass-split me-1"></i>
                                            Pending
                                        </span>

                                    @elseif($reservation->status === 'approved')

                                        <span class="badge"
                                              style="
                                                background: #ecfdf5;
                                                color: #16a34a;
                                                padding: 6px 10px;
                                              ">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Approved
                                        </span>

                                    @elseif($reservation->status === 'rejected')

                                        <span class="badge"
                                              style="
                                                background: #fef2f2;
                                                color: #dc2626;
                                                padding: 6px 10px;
                                              ">
                                            <i class="bi bi-x-circle me-1"></i>
                                            Rejected
                                        </span>

                                    @elseif($reservation->status === 'canceled')

                                        <span class="badge"
                                              style="
                                                background: #f1f5f9;
                                                color: #475569;
                                                padding: 6px 10px;
                                              ">
                                            <i class="bi bi-slash-circle me-1"></i>
                                            Canceled
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

</style>

@endsection