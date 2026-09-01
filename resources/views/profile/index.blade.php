@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('subtitle', 'Kelola informasi profil Anda')

@section('content')

<div class="admin-card p-4">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="profile-header-icon" style="background: var(--primary-soft); color: var(--primary);">
            <i class="bi bi-person"></i>
        </div>
        <div>
            <h5 class="fw-bold mb-0" style="color: var(--dark);">Profil Saya</h5>
            <small style="color: var(--muted);">Kelola informasi profil dan akun Anda.</small>
        </div>
    </div>

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" id="profile-form">
        @csrf
        @method('PUT')

        <div class="profile-content">
            <div class="profile-identity">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                </div>

                <h5 class="fw-bold mt-3 mb-1" style="color: var(--dark);">{{ $user->name }}</h5>
                <span class="profile-role-badge">
                    <i class="bi bi-shield-check me-1"></i>
                    {{ ucfirst($user->role) }}
                </span>
                <p class="mt-2 mb-0" style="color: var(--muted); font-size: 13px;">
                    @if($user->role === 'owner')
                        Pemilik Venue
                    @elseif($user->role === 'admin')
                        Administrator
                    @else
                        Pelanggan
                    @endif
                </p>
            </div>

            <div class="profile-form">
                <h6 class="profile-section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Akun
                </h6>

                <div class="form-group-custom">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control-custom @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control-custom @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback-custom">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Role</label>
                            <div class="form-control-custom form-control-disabled">
                                <span class="role-text">{{ ucfirst($user->role) }}</span>
                            </div>
                            <small class="form-hint">Role tidak dapat diubah</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Tanggal Registrasi</label>
                            <div class="form-control-custom form-control-disabled">
                                <span class="role-text">{{ $user->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3" style="border-top: 1px solid var(--border);">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-lg"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .profile-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .profile-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    @media (min-width: 768px) {
        .profile-content {
            flex-direction: row;
            align-items: flex-start;
        }

        .profile-identity {
            flex: 0 0 220px;
            text-align: center;
            padding: 24px;
            background: var(--bg);
            border-radius: 16px;
            border: 1px solid var(--border);
        }

        .profile-form {
            flex: 1;
            padding: 24px;
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
        }
    }

    @media (max-width: 767px) {
        .profile-identity {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: var(--bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            flex-wrap: wrap;
            justify-content: center;
            text-align: left;
        }

        .profile-avatar-wrapper {
            flex-shrink: 0;
        }

        .profile-avatar, .profile-avatar-img {
            width: 64px !important;
            height: 64px !important;
            font-size: 20px;
        }

        .profile-identity h5 {
            font-size: 16px;
            margin-bottom: 0 !important;
        }

        .profile-identity .profile-role-badge {
            font-size: 11px;
            padding: 3px 8px;
        }

        .profile-identity > p {
            display: none;
        }

        .profile-photo-actions {
            width: 100%;
            justify-content: center;
            margin-top: 12px;
        }

        .profile-form {
            padding: 20px;
            background: var(--white);
            border-radius: 12px;
            border: 1px solid var(--border);
        }
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 600;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(240, 68, 93, 0.3);
    }

    .profile-role-badge {
        display: inline-flex;
        align-items: center;
        background: var(--primary-soft);
        color: var(--primary);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .profile-section-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group-custom {
        margin-bottom: 18px;
    }

    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: var(--text);
        margin-bottom: 6px;
    }

    .form-control-custom {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 14px;
        color: var(--dark);
        background: var(--white);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(240, 68, 93, 0.1);
    }

    .form-control-custom.is-invalid {
        border-color: #dc3545;
    }

    .form-control-disabled {
        background: var(--bg) !important;
        color: var(--text);
        cursor: not-allowed;
    }

    .role-text {
        color: var(--muted);
    }

    .form-hint {
        display: block;
        font-size: 11px;
        color: var(--muted);
        margin-top: 4px;
    }

    .invalid-feedback-custom {
        font-size: 12px;
        color: #dc3545;
        margin-top: 4px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(240, 68, 93, 0.3);
    }

    .btn-save:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(240, 68, 93, 0.4);
    }

    .btn-save:active {
        transform: translateY(0);
    }
</style>

@endsection
