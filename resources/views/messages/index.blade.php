@extends('layouts.admin')

@section('title', 'Pesan')
@section('subtitle', 'Kelola pesan masuk dan keluar')

@section('content')

<div class="admin-card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0" style="color: var(--dark);">
            <i class="bi bi-envelope me-2" style="color: var(--primary);"></i>
            Pesan
        </h5>
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
            <a href="{{ route('messages.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Kirim Pesan
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($messages->isEmpty())
        <div class="text-center py-5">
            <div style="width: 80px; height: 80px; background: var(--primary-soft); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <i class="bi bi-inbox" style="font-size: 36px; color: var(--primary);"></i>
            </div>
            <h5 style="color: var(--dark); margin-bottom: 8px;">Tidak Ada Pesan</h5>
            <p style="color: var(--muted); font-size: 14px;">
                Pesan akan muncul di sini ketika Anda menerima pesan.
            </p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid var(--border); padding: 12px 8px;">
                            <i class="bi bi-person me-1"></i> Pengirim / Penerima
                        </th>
                        <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid var(--border); padding: 12px 8px;">
                            <i class="bi bi-chat-left-text me-1"></i> Subjek
                        </th>
                        <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid var(--border); padding: 12px 8px;">
                            <i class="bi bi-clock me-1"></i> Waktu
                        </th>
                        <th style="font-size: 12px; color: var(--muted); font-weight: 600; border-bottom: 2px solid var(--border); padding: 12px 8px; text-align: center;">
                            <i class="bi bi-info-circle me-1"></i> Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        @php
                            $isReceived = $message->receiver_id === auth()->id();
                            $contact = $isReceived ? $message->sender : $message->receiver;
                        @endphp
                        <tr style="cursor: pointer;" onclick="window.location='{{ route('messages.show', $message->id) }}'">
                            <td style="padding: 16px 8px;">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 36px; height: 36px; border-radius: 8px; background: {{ $isReceived ? 'var(--primary-soft)' : '#f8fafc' }}; display: flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 600; font-size: 12px;">
                                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-size: 14px; font-weight: 500; color: var(--dark);">
                                            {{ $contact->name }}
                                        </div>
                                        <div style="font-size: 11px; color: var(--muted);">
                                            {{ $isReceived ? 'Dari' : 'Kepada' }}: {{ ucfirst($contact->role) }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 16px 8px;">
                                <div style="font-size: 14px; color: var(--dark); font-weight: {{ $message->isUnreadForUser(auth()->id()) ? '600' : '400' }};">
                                    {{ $message->subject }}
                                </div>
                            </td>
                            <td style="padding: 16px 8px;">
                                <span style="font-size: 13px; color: var(--muted);">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td style="padding: 16px 8px; text-align: center;">
                                @if($message->isUnreadForUser(auth()->id()))
                                    <span class="badge" style="background: var(--primary); color: white; font-size: 11px; padding: 5px 10px;">
                                        <i class="bi bi-envelope me-1"></i> Baru
                                    </span>
                                @else
                                    <span class="badge" style="background: #f8fafc; color: var(--muted); font-size: 11px; padding: 5px 10px;">
                                        <i class="bi bi-envelope-open me-1"></i> Dibaca
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

@endsection
