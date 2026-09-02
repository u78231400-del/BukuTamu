@extends('layouts.admin')

@section('title', 'Detail Notifikasi')
@section('subtitle', 'Baca notifikasi lengkap')

@section('content')

<div class="admin-card p-4">
    <a href="{{ route('notifications.index') }}" class="btn-secondary-custom mb-4">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Notifikasi
    </a>

    <div class="notif-detail-card">
        <div class="notif-detail-header">
            <div class="notif-icon-lg" style="background: {{ $notification->type === 'success' ? '#ecfdf5' : ($notification->type === 'warning' ? '#fffbeb' : ($notification->type === 'danger' ? '#fff1f2' : 'var(--primary-soft)')) }};">
                <i class="bi {{ $notification->icon ?: 'bi-bell' }}" style="color: {{ $notification->type === 'success' ? '#16a34a' : ($notification->type === 'warning' ? '#ca8a04' : ($notification->type === 'danger' ? '#dc2626' : 'var(--primary)')) }}; font-size: 28px;"></i>
            </div>
            <div class="notif-meta">
                <span class="notif-type-badge" style="background: {{ $notification->type === 'success' ? '#ecfdf5' : ($notification->type === 'warning' ? '#fffbeb' : ($notification->type === 'danger' ? '#fff1f2' : 'var(--primary-soft)')) }}; color: {{ $notification->type === 'success' ? '#16a34a' : ($notification->type === 'warning' ? '#ca8a04' : ($notification->type === 'danger' ? '#dc2626' : 'var(--primary)')) }};">
                    {{ ucfirst($notification->type) }}
                </span>
                @if($notification->is_read)
                    <span class="notif-status-badge status-read">
                        <i class="bi bi-check-circle"></i>
                        Sudah Dibaca
                    </span>
                @else
                    <span class="notif-status-badge status-unread">
                        <i class="bi bi-circle"></i>
                        Belum Dibaca
                    </span>
                @endif
            </div>
        </div>

        <h2 class="notif-detail-title">{{ $notification->title }}</h2>

        <div class="notif-detail-message">
            <p>{{ $notification->message }}</p>
        </div>

        <div class="notif-detail-footer">
            <div class="notif-time-detail">
                <i class="bi bi-clock"></i>
                <span>{{ $notification->created_at->translatedFormat('l, d F Y') }}</span>
                <span class="time-separator">pukul</span>
                <span>{{ $notification->created_at->format('H:i') }} WIB</span>
            </div>

            @if($notification->link)
                <a href="{{ $notification->link }}" class="btn-primary-custom">
                    <i class="bi bi-arrow-right-circle"></i>
                    Lihat Detail
                </a>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .notif-detail-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 32px;
    }

    .notif-detail-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .notif-icon-lg {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notif-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .notif-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .notif-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-read {
        background: #ecfdf5;
        color: #16a34a;
    }

    .status-unread {
        background: var(--primary-soft);
        color: var(--primary);
    }

    .notif-detail-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 20px;
        line-height: 1.3;
    }

    .notif-detail-message {
        background: var(--bg);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }

    .notif-detail-message p {
        font-size: 15px;
        color: var(--text);
        line-height: 1.7;
        margin: 0;
        white-space: pre-wrap;
    }

    .notif-detail-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .notif-time-detail {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--muted);
    }

    .notif-time-detail i {
        font-size: 16px;
    }

    .time-separator {
        margin: 0 2px;
    }

    @media (max-width: 576px) {
        .notif-detail-card {
            padding: 24px 20px;
        }

        .notif-detail-title {
            font-size: 20px;
        }

        .notif-detail-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .notif-detail-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush
