@extends('layouts.admin')

@section('title', 'Edit Jadwal Venue')
@section('subtitle', 'Perbarui jadwal booking offline, acara internal, atau blokir venue.')

@section('content')

<div class="container-fluid px-0">

    @if($venues->isEmpty())
        <div class="admin-alert alert-warning mb-4">
            <i class="bi bi-exclamation-triangle"></i>
            Anda belum memiliki venue. Silakan tambah venue terlebih dahulu.
        </div>
        <div class="text-center">
            <a href="{{ route('owner.venues.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Venue
            </a>
        </div>
    @else

        @if(session('error'))
            <div class="admin-alert alert-danger mb-4">
                <i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif


        <div class="admin-card p-4 mb-4">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('owner.schedules.index') }}" class="text-decoration-none" style="color: var(--muted);">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h4 class="fw-bold mb-0" style="color: var(--dark);">
                    <i class="bi bi-calendar3 me-2" style="color: var(--primary);"></i>
                    Edit Jadwal Venue
                </h4>
            </div>
        </div>


        <div class="admin-card p-4">

            <form method="POST" action="{{ route('owner.schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Venue <span class="text-danger">*</span>
                        </label>
                        <select name="venue_id"
                                class="form-select @error('venue_id') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Venue --</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}"
                                        {{ (old('venue_id', $schedule->venue_id) == $venue->id) ? 'selected' : '' }}>
                                    {{ $venue->nama_venue }}
                                </option>
                            @endforeach
                        </select>
                        @error('venue_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Jenis <span class="text-danger">*</span>
                        </label>
                        <select name="jenis"
                                class="form-select @error('jenis') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="offline" {{ (old('jenis', $schedule->jenis) == 'offline') ? 'selected' : '' }}>
                                Booking Offline
                            </option>
                            <option value="internal" {{ (old('jenis', $schedule->jenis) == 'internal') ? 'selected' : '' }}>
                                Acara Internal
                            </option>
                            <option value="blocked" {{ (old('jenis', $schedule->jenis) == 'blocked') ? 'selected' : '' }}>
                                Venue Diblokir
                            </option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Judul <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $schedule->judul) }}"
                               placeholder="Contoh: Booking Offline - PT ABC"
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Tanggal Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="tanggal_mulai"
                               class="form-control @error('tanggal_mulai') is-invalid @enderror"
                               value="{{ old('tanggal_mulai', $schedule->tanggal_mulai->format('Y-m-d')) }}"
                               required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Tanggal Selesai <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               name="tanggal_selesai"
                               class="form-control @error('tanggal_selesai') is-invalid @enderror"
                               value="{{ old('tanggal_selesai', $schedule->tanggal_selesai->format('Y-m-d')) }}"
                               required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Waktu Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="time"
                               name="waktu_mulai"
                               class="form-control @error('waktu_mulai') is-invalid @enderror"
                               value="{{ old('waktu_mulai', $schedule->waktu_mulai) }}"
                               required>
                        @error('waktu_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Waktu Selesai <span class="text-danger">*</span>
                        </label>
                        <input type="time"
                               name="waktu_selesai"
                               class="form-control @error('waktu_selesai') is-invalid @enderror"
                               value="{{ old('waktu_selesai', $schedule->waktu_selesai) }}"
                               required>
                        @error('waktu_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold" style="color: var(--dark);">
                            Keterangan
                        </label>
                        <textarea name="keterangan"
                                  class="form-control @error('keterangan') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Tambahkan keterangan jika diperlukan">{{ old('keterangan', $schedule->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <hr class="my-4">


                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('owner.schedules.index') }}" class="btn-secondary-custom">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary-custom">
                        <i class="bi bi-check-lg"></i>
                        Perbarui Jadwal
                    </button>
                </div>

            </form>

        </div>

    @endif

</div>

@endsection
