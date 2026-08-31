@extends('layouts.admin')

@section('title', 'Tambah Venue')
@section('subtitle', 'Tambahkan venue baru')

@section('content')

<div style="max-width: 700px; margin: 0 auto;">

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            <div>
                <strong>Ada kesalahan:</strong>
                <ul class="mb-0 mt-2" style="padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.venues.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="admin-card p-4 mb-4">

            <h4 class="fw-bold mb-4" style="color: var(--dark);">
                <i class="bi bi-building me-2" style="color: var(--primary);"></i>
                Informasi Venue
            </h4>

            <div class="mb-3">
                <label class="form-label">
                    Nama Venue <span class="text-danger">*</span>
                </label>
                <input type="text"
                       name="nama_venue"
                       class="form-control"
                       value="{{ old('nama_venue') }}"
                       placeholder="Masukkan nama venue"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3"
                          placeholder="Jelaskan tentang venue ini">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Kapasitas <span class="text-danger">*</span>
                    </label>
                    <input type="number"
                           name="kapasitas"
                           class="form-control"
                           value="{{ old('kapasitas') }}"
                           placeholder="Contoh: 100"
                           min="1"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-select" required>
                        <option value="">Pilih Status</option>
                        <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>
                            Tidak Tersedia
                        </option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Lokasi <span class="text-danger">*</span>
                </label>
                <input type="text"
                       name="lokasi"
                       class="form-control"
                       value="{{ old('lokasi') }}"
                       placeholder="Contoh: Jl. Sudirman No. 123, Jakarta"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fasilitas</label>
                <div class="row g-2">
                    @php
                        $fasilitasOptions = [
                            'wifi' => 'WiFi Gratis',
                            'parkir' => 'Area Parkir',
                            'ac' => 'AC',
                            'sound_system' => 'Sound System',
                            'proyektor' => 'Proyektor',
                            ' whiteboard' => 'Whiteboard',
                            'tv' => 'TV/Layar',
                            'telepon' => 'Telepon Konferensi',
                        ];
                    @endphp
                    @foreach($fasilitasOptions as $value => $label)
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{ $value }}" id="fasilitas_{{ $value }}" {{ is_array(old('fasilitas')) && in_array($value, old('fasilitas')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="fasilitas_{{ $value }}">
                                    {{ $label }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-0">
                <label class="form-label">Foto Venue</label>
                <div class="file-upload" id="file-upload">
                    <input type="file"
                           name="foto"
                           id="foto-input"
                           accept="image/jpg,jpeg,png,webp">
                    <div class="file-upload-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div class="file-upload-text">
                        <span>Klik untuk upload</span> atau drag file di sini
                    </div>
                    <div class="file-upload-text" style="font-size: 11px; margin-top: 4px; color: var(--muted);">
                        JPG, PNG, WEBP - Maksimal 2MB
                    </div>
                    <div class="file-preview" id="file-preview"></div>
                </div>
            </div>

        </div>

        <div class="d-flex flex-column flex-sm-row gap-2">
            <button type="submit" class="btn-primary-custom flex-grow-1 justify-content-center">
                <i class="bi bi-check-lg"></i>
                Simpan Venue
            </button>
            <a href="{{ route('admin.venues.index') }}" class="btn-secondary-custom justify-content-center">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

    </form>

</div>

<style>
    .form-label {
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--dark);
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 14px;
        color: var(--dark);
        background: var(--white);
        transition: border-color .2s, box-shadow .2s;
    }

    .form-control:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 68, 93, .10);
    }

    .form-control::placeholder {
        color: var(--muted);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .file-upload {
        border: 2px dashed var(--border);
        border-radius: 12px;
        padding: 24px 16px;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        background: #fafbfc;
    }

    .file-upload:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .file-upload input {
        display: none;
    }

    .file-upload-icon {
        font-size: 36px;
        color: #d48aaa;
        margin-bottom: 8px;
    }

    .file-upload-text {
        font-size: 13px;
        color: var(--muted);
    }

    .file-upload-text span {
        color: var(--primary);
        font-weight: 600;
    }

    .file-preview {
        margin-top: 12px;
    }

    .file-preview img {
        max-width: 180px;
        max-height: 140px;
        border-radius: 10px;
        border: 1px solid var(--border);
        object-fit: cover;
    }
</style>

<script>
    document.getElementById('file-upload').addEventListener('click', function() {
        document.getElementById('foto-input').click();
    });

    document.getElementById('foto-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('file-preview');
                preview.innerHTML = '<img src="' + event.target.result + '" alt="Preview">';
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
