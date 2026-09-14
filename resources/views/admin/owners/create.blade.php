@extends('layouts.admin')

@section('title', 'Tambah Owner')
@section('subtitle', 'Tambahkan pemilik venue baru')

@section('content')

<div style="max-width: 700px; margin: 0 auto;">

    @if($errors->any())
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            <div>
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 8px 0 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="admin-card p-3 p-md-4 mb-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <a href="{{ route('admin.owners.index') }}" class="btn-secondary-custom btn-sm-custom">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0" style="color: var(--dark); font-size: 18px;">
                    Tambah Owner
                </h4>
                <p class="mb-0 mt-1" style="color: var(--muted); font-size: 13px;">
                    Tambahkan pemilik venue baru ke dalam sistem
                </p>
            </div>
        </div>
    </div>

    <div class="admin-card p-3 p-md-4">
        <div class="form-section-header">
            <i class="bi bi-person-badge"></i>
            <div>
                <h5 class="mb-0">Informasi Owner</h5>
                <small>Data ini digunakan untuk akun pemilik venue</small>
            </div>
        </div>

        <form action="{{ route('admin.owners.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="form-group-custom">
                <label for="name" class="form-label-custom">
                    <i class="bi bi-person"></i>
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    class="form-control-custom @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap owner"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="form-group-custom">
                <label for="email" class="form-label-custom">
                    <i class="bi bi-envelope"></i>
                    Alamat Email
                </label>
                <input
                    type="email"
                    class="form-control-custom @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-row">
                <div class="form-group-custom">
                    <label for="password" class="form-label-custom">
                        <i class="bi bi-lock"></i>
                        Password
                    </label>
                    <input
                        type="password"
                        class="form-control-custom @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        required
                    >
                </div>

                <div class="form-group-custom">
                    <label for="password_confirmation" class="form-label-custom">
                        <i class="bi bi-lock-fill"></i>
                        Konfirmasi Password
                    </label>
                    <input
                        type="password"
                        class="form-control-custom"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.owners.index') }}" class="btn-secondary-custom">
                    <i class="bi bi-x-lg"></i>
                    Batal
                </a>
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-check-lg"></i>
                    Simpan Owner
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    .form-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: var(--primary-soft);
        border-radius: 10px;
        margin-bottom: 4px;
    }

    .form-section-header i {
        font-size: 22px;
        color: var(--primary);
    }

    .form-section-header h5 {
        font-size: 14px;
        font-weight: 700;
        color: var(--dark);
    }

    .form-section-header small {
        color: var(--muted);
        font-size: 12px;
    }

    .form-group-custom {
        margin-bottom: 18px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-label-custom {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .form-label-custom i {
        color: var(--primary);
        font-size: 14px;
    }

    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        font-size: 13px;
        color: var(--dark);
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 9px;
        transition: all .2s ease;
        outline: none;
    }

    .form-control-custom::placeholder {
        color: var(--muted);
    }

    .form-control-custom:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 68, 93, .1);
    }

    .form-control-custom.is-invalid {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, .1);
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    @media (max-width: 576px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn-primary-custom,
        .form-actions .btn-secondary-custom {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@endsection
