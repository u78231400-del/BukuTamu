@extends('layouts.admin')

@section('title', 'Notifikasi')
@section('subtitle', 'Kelola notifikasi Anda')

@section('content')

<div class="admin-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0" style="color: var(--dark);">
            <i class="bi bi-bell me-2" style="color: var(--primary);"></i>
            Semua Notifikasi
        </h5>
        @if($unreadCount > 0)
            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary-custom">
                    <i class="bi bi-check-all"></i>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($notifications->isEmpty())
        <div class="text-center py-5">
            <div style="width: 80px; height: 80px; background: var(--primary-soft); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <i class="bi bi-bell-slash" style="font-size: 36px; color: var(--primary);"></i>
            </div>
            <h5 style="color: var(--dark); margin-bottom: 8px;">Tidak Ada Notifikasi</h5>
            <p style="color: var(--muted); font-size: 14px;">
                Anda akan menerima notifikasi ketika ada aktivitas penting.
            </p>
        </div>
    @else
        <div class="notif-list-full">
            @foreach($notifications as $notification)
                <a href="{{ $notification->link ? route($notification->link) : '#' }}"
                   class="notif-row {{ $notification->is_read ? 'read' : 'unread' }}"
                   onclick="markAsRead({{ $notification->id }})">
                    <div class="notif-icon-wrap" style="background: {{ $notification->type === 'success' ? '#ecfdf5' : ($notification->type === 'warning' ? '#fffbeb' : ($notification->type === 'danger' ? '#fff1f2' : 'var(--primary-soft)')) }};">
                        <i class="bi {{ $notification->icon ?: 'bi-bell' }}" style="color: {{ $notification->type === 'success' ? '#16a34a' : ($notification->type === 'warning' ? '#ca8a04' : ($notification->type === 'danger' ? '#dc2626' : 'var(--primary)')) }};"></i>
                    </div>
                    <div class="notif-body">
                        <div class="notif-text">{{ $notification->title }}</div>
                        <div class="notif-message">{{ $notification->message }}</div>
                        <div class="notif-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                    @if(!$notification->is_read)
                        <div class="notif-dot"></div>
                    @endif
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection

@push('styles')
<style>
    .notif-list-full {
        display: flex;
        flex-direction: column;
    }

    .notif-row {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px;
        border-radius: 12px;
        text-decoration: none;
        transition: all .2s ease;
        position: relative;
    }

    .notif-row:hover {
        background: var(--bg);
    }

    .notif-row.unread {
        background: var(--primary-soft);
    }

    .notif-row.unread:hover {
        background: var(--primary-soft-hover);
    }

    .notif-row + .notif-row {
        border-top: 1px solid var(--border);
    }

    .notif-icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notif-icon-wrap i {
        font-size: 18px;
    }

    .notif-body {
        flex: 1;
        min-width: 0;
    }

    .notif-text {
        font-size: 14px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 2px;
    }

    .notif-message {
        font-size: 13px;
        color: var(--text);
        margin-bottom: 4px;
        line-height: 1.4;
    }

    .notif-time {
        font-size: 12px;
        color: var(--muted);
    }

    .notif-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--primary);
        flex-shrink: 0;
        margin-top: 6px;
    }
</style>
@endpush

@push('scripts')
<script>
    function markAsRead(id) {
        fetch('/notifications/' + id + '/read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
    }
</script>
@endpush
