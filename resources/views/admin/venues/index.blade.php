@extends('layouts.admin')

@section('title', 'Kelola Venue')
@section('subtitle', 'Kelola dan pantau venue')

@section('content')

<div style="max-width: 1200px; margin: 0 auto;">

    @if(session('success'))
        <div class="admin-alert alert-success">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="admin-alert alert-danger">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="admin-card p-3 p-md-4 mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--dark); font-size: 20px;">
                    Daftar Venue
                </h4>
                <p class="mb-0" style="color: var(--muted); font-size: 13px;">
                    Kelola dan pantau venue yang tersedia untuk reservasi customer.
                </p>
            </div>
            <a href="{{ route('admin.venues.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Venue
            </a>
        </div>
    </div>

    @if($venues->count())

        <div class="venue-grid">

            @foreach($venues as $venue)

                <div class="venue-card">

                    @if($venue->foto)

                        <img
                            src="{{ asset('storage/' . $venue->foto) }}"
                            alt="{{ $venue->nama_venue }}"
                            class="venue-image"
                        >

                    @else

                        <div class="venue-placeholder">
                            <i class="bi bi-building"></i>
                        </div>

                    @endif


                    <div class="venue-body">

                        <h2 class="venue-title">
                            {{ $venue->nama_venue }}
                        </h2>


                        <div class="venue-description">

                            {{ $venue->deskripsi
                                ? \Illuminate\Support\Str::limit($venue->deskripsi, 80)
                                : 'Belum ada deskripsi venue.'
                            }}

                        </div>


                        <div class="venue-info">

                            <div class="venue-info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>
                                    {{ $venue->lokasi ?? 'Lokasi belum tersedia' }}
                                </span>
                            </div>


                            <div class="venue-info-item">
                                <i class="bi bi-people-fill"></i>
                                <span>
                                    Kapasitas {{ $venue->kapasitas }} orang
                                </span>
                            </div>

                        </div>


                        <div class="venue-footer">

                            <div class="venue-footer-left">
                                @if($venue->status === 'available')

                                    <span class="status-badge status-available">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Tersedia
                                    </span>

                                @else

                                    <span class="status-badge status-unavailable">
                                        <i class="bi bi-x-circle-fill"></i>
                                        Tidak tersedia
                                    </span>

                                @endif
                            </div>

                            <div class="venue-actions">
                                <a href="{{ route('admin.venues.edit', $venue->id) }}"
                                   class="btn-action btn-edit"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                @if($venue->status === 'available')
                                    <form method="POST"
                                          action="{{ route('admin.venues.destroy', $venue->id) }}"
                                          id="deactivate-form-{{ $venue->id }}"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button"
                                            class="btn-action btn-delete"
                                            title="Nonaktifkan"
                                            onclick="confirmDeactivate({{ $venue->id }})">
                                        <i class="bi bi-slash-circle"></i>
                                    </button>
                                @else
                                    <form method="POST"
                                          action="{{ route('admin.venues.activate', $venue->id) }}"
                                          id="activate-form-{{ $venue->id }}"
                                          style="display:none;">
                                        @csrf
                                    </form>
                                    <button type="button"
                                            class="btn-action btn-activate"
                                            title="Aktifkan"
                                            onclick="confirmActivate({{ $venue->id }})">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="admin-card p-5 text-center">
            <div class="empty-icon">
                <i class="bi bi-building"></i>
            </div>
            <h5 style="color: var(--dark); margin-bottom: 8px;">Belum ada venue</h5>
            <p style="color: var(--muted); margin-bottom: 20px; font-size: 14px;">
                Tambahkan venue pertama untuk memulai.
            </p>
            <a href="{{ route('admin.venues.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-lg"></i>
                Tambah Venue
            </a>
        </div>

    @endif

</div>

<style>
    .venue-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 16px;
    }

    .venue-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(15, 23, 42, .04);
        transition: transform .25s ease, box-shadow .25s ease;
        display: flex;
        flex-direction: column;
    }

    .venue-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(190, 120, 150, .12);
    }

    .venue-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .venue-placeholder {
        width: 100%;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--primary-soft), #fdf2f8);
        color: #d48aaa;
        font-size: 48px;
    }

    .venue-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .venue-title {
        margin: 0 0 8px;
        font-size: 18px;
        font-weight: 700;
        color: var(--dark);
    }

    .venue-description {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.5;
        margin-bottom: 16px;
        flex-grow: 1;
        min-height: 40px;
    }

    .venue-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .venue-info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--text);
        font-size: 13px;
    }

    .venue-info-item i {
        color: var(--primary);
        width: 16px;
        text-align: center;
    }

    .venue-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 10px;
    }

    .venue-footer-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .venue-actions {
        display: flex;
        gap: 6px;
    }

    .empty-icon {
        font-size: 48px;
        color: #d48aaa;
        margin-bottom: 16px;
    }

    .btn-activate {
        background: #ecfdf5;
        color: #15803d;
    }

    .btn-activate:hover {
        background: #16a34a;
        color: white;
    }

    @media (min-width: 640px) {
        .venue-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .venue-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<script>
    function confirmDeactivate(id) {
        if (confirm('Apakah Anda yakin ingin menonaktifkan venue ini?')) {
            document.getElementById('deactivate-form-' + id).submit();
        }
    }

    function confirmActivate(id) {
        if (confirm('Apakah Anda yakin ingin mengaktifkan kembali venue ini?')) {
            document.getElementById('activate-form-' + id).submit();
        }
    }
</script>

@endsection
