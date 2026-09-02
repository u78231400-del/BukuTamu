@extends('layouts.admin')

@section('title', 'Kirim Pesan')
@section('subtitle', 'Kirim pesan ke user lain')

@section('content')

<div class="admin-card p-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('messages.index') }}" class="btn btn-sm d-inline-flex align-items-center justify-content-center" style="background: var(--bg); color: var(--text); width: 36px; height: 36px; border-radius: 8px;">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h5 class="fw-bold mb-0" style="color: var(--dark);">
            <i class="bi bi-envelope-plus me-2" style="color: var(--primary);"></i>
            Kirim Pesan
        </h5>
    </div>

    @if(session('error'))
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label" style="font-size: 13px; color: var(--text); font-weight: 500;">
                Tujuan
            </label>
            <select name="receiver_id" class="form-select @error('receiver_id') is-invalid @enderror" required style="border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 14px;">
                <option value="">-- Pilih Penerima --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('receiver_id', $selectedUser->id ?? '') == $user->id) ? 'selected' : '' }}>
                        {{ $user->name }} ({{ ucfirst($user->role) }})
                    </option>
                @endforeach
            </select>
            @error('receiver_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-size: 13px; color: var(--text); font-weight: 500;">
                Subjek
            </label>
            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', $subject) }}" required style="border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 14px;" placeholder="Masukkan subjek pesan">
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label" style="font-size: 13px; color: var(--text); font-weight: 500;">
                Isi Pesan
            </label>
            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="8" required style="border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 14px; resize: vertical;" placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-send"></i>
                Kirim Pesan
            </button>
            <a href="{{ route('messages.index') }}" class="btn-secondary-custom">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
