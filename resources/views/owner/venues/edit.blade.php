@extends('layouts.admin')

@section('title', 'Edit Venue')
@section('subtitle', 'Perbarui informasi venue milik Anda')

@section('content')

<div class="container-fluid px-0">

    <div class="admin-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark);">
                    Edit Venue
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 14px;">
                    Perbarui informasi venue Anda.
                </p>
            </div>

            <a href="{{ route('owner.venues.index') }}"
               class="btn-secondary-custom">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="admin-alert alert-danger mb-4">
                <i class="bi bi-exclamation-circle"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>

                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('owner.venues.update', $venue->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Nama Venue --}}
                <div class="col-md-6">

                    <label for="nama_venue" class="form-label fw-semibold">
                        Nama Venue <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           id="nama_venue"
                           name="nama_venue"
                           value="{{ old('nama_venue', $venue->nama_venue) }}"
                           class="form-control"
                           required>

                </div>

                {{-- Kapasitas --}}
                <div class="col-md-6">

                    <label for="kapasitas" class="form-label fw-semibold">
                        Kapasitas <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           id="kapasitas"
                           name="kapasitas"
                           value="{{ old('kapasitas', $venue->kapasitas) }}"
                           class="form-control"
                           min="1"
                           required>

                </div>

                {{-- Lokasi --}}
                <div class="col-12">

                    <label for="lokasi" class="form-label fw-semibold">
                        Lokasi <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           id="lokasi"
                           name="lokasi"
                           value="{{ old('lokasi', $venue->lokasi) }}"
                           class="form-control"
                           required>

                </div>

                {{-- Deskripsi --}}
                <div class="col-12">

                    <label for="deskripsi" class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea id="deskripsi"
                              name="deskripsi"
                              rows="5"
                              class="form-control"
                              placeholder="Jelaskan mengenai venue ini...">{{ old('deskripsi', $venue->deskripsi) }}</textarea>

                </div>

                {{-- Fasilitas --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Fasilitas
                    </label>

                    @php
                        $fasilitasOptions = [
                            'wifi',
                            'parkir',
                            'ac',
                            'sound_system',
                            'proyektor',
                            'tv',
                            'kursi',
                            'meja',
                            'toilet'
                        ];

                        $currentFasilitas = is_array($venue->fasilitas)
                            ? $venue->fasilitas
                            : (json_decode($venue->fasilitas ?? '[]', true) ?? []);

                        $selectedFasilitas = old('fasilitas', $currentFasilitas);
                    @endphp

                    <div class="row g-2">

                        @foreach($fasilitasOptions as $fasilitas)

                            <div class="col-6 col-md-3">

                                <label class="facility-option">

                                    <input type="checkbox"
                                           name="fasilitas[]"
                                           value="{{ $fasilitas }}"
                                           {{ in_array($fasilitas, $selectedFasilitas) ? 'checked' : '' }}>

                                    <span>
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ ucwords(str_replace('_', ' ', $fasilitas)) }}
                                    </span>

                                </label>

                            </div>

                        @endforeach

                    </div>

                </div>

                {{-- Foto Lama --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Foto Saat Ini
                    </label>

                    @if($venue->foto)

                        <div class="mb-2">

                            <img src="{{ asset('storage/' . $venue->foto) }}"
                                 alt="{{ $venue->nama_venue }}"
                                 style="width: 180px; height: 110px; object-fit: cover; border-radius: 10px;">

                        </div>

                    @else

                        <div class="text-muted mb-2">
                            Belum ada foto.
                        </div>

                    @endif

                    <label for="foto" class="form-label fw-semibold">
                        Ganti Foto
                    </label>

                    <input type="file"
                           id="foto"
                           name="foto"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti foto.
                        Maksimal 2 MB.
                    </small>

                </div>

                {{-- Status --}}
                <div class="col-md-6">

                    <label for="status" class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>

                    <select id="status"
                            name="status"
                            class="form-select"
                            required>

                        <option value="available"
                            {{ old('status', $venue->status) === 'available' ? 'selected' : '' }}>
                            Available
                        </option>

                        <option value="maintenance"
                            {{ old('status', $venue->status) === 'maintenance' ? 'selected' : '' }}>
                            Maintenance
                        </option>

                    </select>

                </div>

            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('owner.venues.index') }}"
                   class="btn-secondary-custom">
                    Batal
                </a>

                <button type="submit"
                        class="btn-primary-custom">
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

<style>

.form-label {
    color: var(--dark);
    font-size: 14px;
    margin-bottom: 8px;
}

.form-control,
.form-select {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 11px 13px;
    font-size: 14px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
}

.facility-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
    color: var(--dark);
    transition: .2s;
}

.facility-option:hover {
    border-color: var(--primary);
}

.facility-option input {
    accent-color: var(--primary);
}

.facility-option span {
    flex: 1;
}

</style>

@endsection