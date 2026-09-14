@extends('layouts.admin')

@section('title', 'Kelola Owner')
@section('subtitle', 'Kelola dan pantau pemilik venue')

@section('content')

<div style="max-width: 1200px; margin: 0 auto;">

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

    <div class="admin-card p-3 p-md-4 mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark); font-size: 20px;">
                    Daftar Owner
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 13px;">
                    Kelola pemilik venue yang terdaftar di sistem.
                </p>
            </div>
            <a href="{{ route('admin.owners.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Owner
            </a>
        </div>
    </div>

    @if($owners->count())

        <div class="owner-grid">

            @foreach($owners as $owner)

                <div class="owner-card">

                    <div class="owner-header">
                        <div class="owner-avatar">
                            @if($owner->profile_photo)
                                <img
                                    src="{{ asset('storage/' . $owner->profile_photo) }}"
                                    alt="{{ $owner->name }}"
                                >
                            @else
                                <i class="bi bi-person"></i>
                            @endif
                        </div>

                        <div class="owner-main">
                            <h2 class="owner-name">
                                {{ $owner->name }}
                            </h2>

                            <div class="owner-email">
                                <i class="bi bi-envelope"></i>
                                {{ $owner->email }}
                            </div>
                        </div>
                    </div>


                    <div class="owner-info">

                        <div class="owner-info-item">
                            <i class="bi bi-building"></i>
                            <span>
                                {{ $owner->venues_count }} Venue
                            </span>
                        </div>

                        <div class="owner-info-item">
                            <i class="bi bi-shield-check"></i>
                            <span class="role-badge">
                                Owner
                            </span>
                        </div>

                    </div>


                    <div class="owner-footer">
                        <span class="status-badge status-owner">
                            <i class="bi bi-check-circle-fill"></i>
                            Owner Aktif
                        </span>
                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="admin-card p-5 text-center">
            <div class="empty-icon">
                <i class="bi bi-person-badge"></i>
            </div>
            <h5 style="color: var(--dark); margin-bottom: 8px;">
                Belum ada Owner
            </h5>
            <p style="color: var(--muted); margin-bottom: 20px; font-size: 14px;">
                Tambahkan owner pertama untuk mengelola pemilik venue.
            </p>
            <a href="{{ route('admin.owners.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Owner
            </a>
        </div>

    @endif

</div>

<style>
    .owner-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
    }

    .owner-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04);
        transition: transform .25s ease, box-shadow .25s ease;
        display: flex;
        flex-direction: column;
    }

    .owner-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(190, 120, 150, .12);
    }

    .owner-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .owner-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-soft);
        color: var(--primary);
        font-size: 28px;
        flex-shrink: 0;
    }

    .owner-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .owner-main {
        min-width: 0;
        flex: 1;
    }

    .owner-name {
        margin: 0 0 6px;
        font-size: 18px;
        font-weight: 700;
        color: var(--dark);
        word-break: break-word;
    }

    .owner-email {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--muted);
        font-size: 13px;
        word-break: break-word;
    }

    .owner-email i {
        color: var(--primary);
        flex-shrink: 0;
    }

    .owner-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-top: 18px;
        border-top: 1px solid var(--border);
        margin-bottom: 18px;
    }

    .owner-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .owner-info-item i {
        color: var(--primary);
        width: 18px;
        text-align: center;
    }

    .owner-info-item span {
        color: var(--text);
        font-size: 14px;
    }

    .role-badge {
        display: inline-block;
        background: var(--primary-soft);
        color: var(--primary);
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .owner-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-top: 16px;
        border-top: 1px solid var(--border);
    }

    .status-owner {
        background: #ecfdf5;
        color: #15803d;
    }

    .empty-icon {
        font-size: 48px;
        color: #d48aaa;
        margin-bottom: 16px;
    }

    @media (min-width: 640px) {
        .owner-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .owner-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

@endsection