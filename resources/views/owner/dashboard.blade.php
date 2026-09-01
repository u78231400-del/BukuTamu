@extends('layouts.admin')

@section('title', 'Dashboard Owner')
@section('subtitle', 'Selamat datang di dashboard owner')

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
                    Halo, {{ auth()->user()->name }}!
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Berikut ringkasan venue Anda.
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('owner.venues.create') }}" class="btn-primary-custom">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Venue
                </a>
                <a href="{{ route('owner.reservations.index') }}" class="btn-secondary-custom">
                    <i class="bi bi-calendar-check"></i>
                    Lihat Reservasi
                </a>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Total Venue
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $venues->count() }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: var(--primary-soft); color: var(--primary);">
                        <i class="bi bi-building"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Venue milik Anda
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
                            {{ $venues->where('status', 'available')->count() }}
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
                            Total Kapasitas
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $venues->sum('kapasitas') }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #fff7ed; color: #ea580c;">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Total kapasitas semua venue
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="mb-1" style="font-size: 12px; color: var(--muted);">
                            Reservasi Pending
                        </div>
                        <div class="fw-bold" style="font-size: 28px; color: var(--dark);">
                            {{ $reservations->where('status', 'pending')->count() }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #fefce8; color: #ca8a04;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: var(--muted);">
                    Menunggu persetujuan
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0" style="color: var(--dark);">
                <i class="bi bi-building me-2" style="color: var(--primary);"></i>
                Venue Saya
            </h5>
            <span class="badge" style="background: var(--primary-soft); color: var(--primary);">
                {{ $venues->count() }} Venue
            </span>
        </div>

        @if($venues->isEmpty())
            <div class="text-center py-5">
                <div style="width: 80px; height: 80px; background: var(--primary-soft); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <i class="bi bi-building" style="font-size: 36px; color: var(--primary);"></i>
                </div>
                <h5 style="color: var(--dark); margin-bottom: 8px;">Belum Ada Venue</h5>
                <p style="color: var(--muted); font-size: 14px; margin-bottom: 20px;">
                    Anda belum memiliki venue yang ditugaskan. Hubungi admin untuk menambahkan venue.
                </p>
                <a href="{{ route('owner.venues.create') }}" class="btn-primary-custom">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Venue Baru
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px;">
                                <i class="bi bi-building me-1"></i> Venue
                            </th>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px;">
                                <i class="bi bi-people me-1"></i> Kapasitas
                            </th>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px;">
                                <i class="bi bi-geo-alt me-1"></i> Lokasi
                            </th>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px;">
                                <i class="bi bi-info-circle me-1"></i> Status
                            </th>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px;">
                                <i class="bi bi-grid me-1"></i> Fasilitas
                            </th>
                            <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid #f1f1f1; padding: 12px 8px; text-align: center;">
                                <i class="bi bi-gear me-1"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($venues as $venue)
                        <tr>
                            <td style="padding: 16px 8px;">
                                <div class="fw-semibold" style="color: var(--dark); font-size: 14px;">
                                    {{ $venue->nama_venue }}
                                </div>
                            </td>
                            <td style="padding: 16px 8px;">
                                <span style="color: var(--dark); font-size: 14px;">
                                    {{ $venue->kapasitas }} orang
                                </span>
                            </td>
                            <td style="padding: 16px 8px;">
                                <span style="color: var(--muted); font-size: 14px;">
                                    {{ $venue->lokasi }}
                                </span>
                            </td>
                            <td style="padding: 16px 8px;">
                                @if($venue->status === 'available')
                                    <span class="badge" style="background: #ecfdf5; color: #16a34a; font-size: 12px; padding: 6px 12px;">
                                        <i class="bi bi-check-circle me-1"></i> Available
                                    </span>
                                @elseif($venue->status === 'maintenance')
                                    <span class="badge" style="background: #fef2f2; color: #dc2626; font-size: 12px; padding: 6px 12px;">
                                        <i class="bi bi-tools me-1"></i> Maintenance
                                    </span>
                                @else
                                    <span class="badge" style="background: #fefce8; color: #ca8a04; font-size: 12px; padding: 6px 12px;">
                                        <i class="bi bi-hourglass-split me-1"></i> {{ ucfirst($venue->status) }}
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 16px 8px;">
                                @if($venue->fasilitas)
                                    @php
                                        $fasilitasArray = is_array($venue->fasilitas) ? $venue->fasilitas : json_decode($venue->fasilitas, true) ?? [];
                                    @endphp
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach(array_slice($fasilitasArray, 0, 3) as $fasilitas)
                                            <span class="badge" style="background: var(--primary-soft); color: var(--primary); font-size: 11px; padding: 4px 8px;">
                                                {{ $fasilitas }}
                                            </span>
                                        @endforeach
                                        @if(count($fasilitasArray) > 3)
                                            <span class="badge" style="background: #f1f1f1; color: var(--muted); font-size: 11px; padding: 4px 8px;">
                                                +{{ count($fasilitasArray) - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color: var(--muted); font-size: 13px;">-</span>
                                @endif
                            </td>
                            <td style="padding: 16px 8px; text-align: center;">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('owner.venues.show', $venue->id) }}" 
                                       class="btn btn-sm d-inline-flex align-items-center justify-content-center"
                                       style="background: var(--primary-soft); color: var(--primary); width: 32px; height: 32px; border-radius: 8px;"
                                       title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('owner.venues.edit', $venue->id) }}" 
                                       class="btn btn-sm d-inline-flex align-items-center justify-content-center"
                                       style="background: #fff7ed; color: #ea580c; width: 32px; height: 32px; border-radius: 8px;"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
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

    @media (max-width: 576px) {
        .stat-icon {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
    }
</style>

@endsection
