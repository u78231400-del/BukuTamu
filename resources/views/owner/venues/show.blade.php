@extends('layouts.admin')

@section('title', 'Detail Venue')
@section('subtitle', 'Informasi detail venue Anda')

@section('content')

<div class="container-fluid px-0">

    <div class="admin-card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">
                    Detail Venue
                </h4>
                <p class="text-muted mb-0">
                    Informasi lengkap venue Anda.
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('owner.venues.index') }}"
                   class="btn btn-light">
                    Kembali
                </a>

                <a href="{{ route('owner.venues.edit', $venue->id) }}"
                   class="btn btn-primary">
                    Edit Venue
                </a>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-md-5">
                @if($venue->foto)
                    <img
                        src="{{ asset('storage/' . $venue->foto) }}"
                        alt="{{ $venue->nama_venue }}"
                        class="img-fluid rounded"
                        style="width: 100%; max-height: 350px; object-fit: cover;"
                    >
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light rounded"
                         style="height: 300px;">
                        <i class="bi bi-building"
                           style="font-size: 60px; color: #aaa;"></i>
                    </div>
                @endif
            </div>

            <div class="col-md-7">

                <h3 class="fw-bold mb-3">
                    {{ $venue->nama_venue }}
                </h3>

                <div class="mb-3">
                    <strong>Lokasi</strong>
                    <p class="text-muted mb-0">
                        {{ $venue->lokasi }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Kapasitas</strong>
                    <p class="text-muted mb-0">
                        {{ $venue->kapasitas }} orang
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Status</strong>
                    <p class="mb-0">
                        {{ ucfirst($venue->status) }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Deskripsi</strong>
                    <p class="text-muted">
                        {{ $venue->deskripsi ?: 'Belum ada deskripsi.' }}
                    </p>
                </div>

                @if($venue->fasilitas)
                    <div>
                        <strong>Fasilitas</strong>

                        @php
                            $fasilitas = is_array($venue->fasilitas)
                                ? $venue->fasilitas
                                : json_decode($venue->fasilitas, true) ?? [];
                        @endphp

                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach($fasilitas as $item)
                                <span class="badge bg-light text-dark">
                                    {{ $item }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection