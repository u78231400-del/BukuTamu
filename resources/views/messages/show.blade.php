@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('subtitle', 'Baca pesan')

@section('content')

<div class="admin-card p-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('messages.index') }}" class="btn btn-sm d-inline-flex align-items-center justify-content-center" style="background: var(--bg); color: var(--text); width: 36px; height: 36px; border-radius: 8px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="fw-bold mb-0" style="color: var(--dark);">
            <i class="bi bi-envelope-open me-2" style="color: var(--primary);"></i>
            Detail Pesan
        </h5>
    </div>

    @php
        $isReceived = $message->receiver_id === auth()->id();
        $contact = $isReceived ? $message->sender : $message->receiver;
    @endphp

    <div class="message-detail">
        <div class="message-header-info">
            <div class="message-avatar">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
            </div>
            <div class="message-meta">
                <div class="message-from">
                    <span style="font-weight: 600; color: var(--dark);">{{ $contact->name }}</span>
                    <span style="color: var(--muted); font-size: 13px;">{{ ucfirst($contact->role) }}</span>
                </div>
                <div class="message-date">
                    {{ $message->created_at->format('d F Y') }} pukul {{ $message->created_at->format('H:i') }}
                </div>
            </div>
            @if($message->isUnreadForUser(auth()->id()))
                <span class="badge ms-auto" style="background: var(--primary); color: white; font-size: 11px; padding: 5px 10px;">
                    <i class="bi bi-envelope me-1"></i> Baru
                </span>
            @endif
        </div>

        <div class="message-subject">
            {{ $message->subject }}
        </div>

        <div class="message-body">
            {!! nl2br(e($message->message)) !!}
        </div>

        @if($isReceived && auth()->user()->role !== 'admin')
            <div class="message-actions mt-4 pt-4" style="border-top: 1px solid var(--border);">
                <a href="{{ route('messages.create', ['reply_to' => $message->sender_id, '_original_subject' => $message->subject]) }}" class="btn-secondary-custom">
                    <i class="bi bi-reply"></i>
                    Balas Pesan
                </a>
            </div>
        @endif
    </div>
</div>

@endsection

@push('styles')
<style>
    .message-detail {
        padding: 0;
    }

    .message-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 16px;
    }

    .message-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
    }

    .message-meta {
        flex: 1;
    }

    .message-from {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2px;
    }

    .message-date {
        font-size: 12px;
        color: var(--muted);
    }

    .message-subject {
        font-size: 18px;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 16px;
    }

    .message-body {
        font-size: 14px;
        color: var(--text);
        line-height: 1.7;
        white-space: pre-wrap;
    }
</style>
@endpush
