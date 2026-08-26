@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di panel admin')

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

    {{-- WELCOME SECTION --}}
    <div class="admin-card p-4 mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark);">
                    Halo, {{ auth()->user()->name }}!
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Berikut ringkasan data Bukutamu hari ini.
                </p>
            </div>
            <a href="{{ route('admin.venues.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Venue
            </a>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="row g-3 g-lg-4 mb-4">

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Total Venue
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $totalVenue }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Semua venue terdaftar
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Venue Aktif
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $venueAktif }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #ecfdf5; color: #16a34a;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Tersedia untuk customer
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Total Reservasi
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $totalReservasi }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #fff7ed; color: #ea580c;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Seluruh reservasi customer
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Menunggu
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $reservasiPending }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #fefce8; color: #ca8a04;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Perlu pemeriksaan
                </div>
            </div>
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="row g-3 g-lg-4">

        <div class="col-md-6">
            <div class="admin-card p-3 h-100">
                <div class="d-flex align-items-start gap-3">
                    <div class="quick-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1" style="font-size: 16px; color: var(--dark);">
                            Kelola Venue
                        </h5>
                        <p class="mb-3" style="font-size: 13px; color: var(--muted);">
                            Tambahkan, ubah, dan kelola venue yang dapat dipesan customer.
                        </p>
                        <a href="{{ route('admin.venues.index') }}" class="btn-primary-custom btn-sm-custom">
                            <i class="bi bi-arrow-right"></i>
                            Kelola Venue
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="admin-card p-3 h-100">
                <div class="d-flex align-items-start gap-3">
                    <div class="quick-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1" style="font-size: 16px; color: var(--dark);">
                            Kelola Reservasi
                        </h5>
                        <p class="mb-3" style="font-size: 13px; color: var(--muted);">
                            Periksa dan proses reservasi dari customer.
                        </p>
                        <a href="{{ route('admin.reservations.index') }}" class="btn-primary-custom btn-sm-custom">
                            <i class="bi bi-arrow-right"></i>
                            Kelola Reservasi
                        </a>
                    </div>
                </div>
            </div>
        </div>

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

    .quick-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    @media (max-width: 576px) {
        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .quick-icon {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }
    }
</style>

@endsection
