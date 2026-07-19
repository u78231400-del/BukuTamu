@extends('layouts.app')

@section('title', 'Edit Janji - NurseCall')
@section('page-title', 'Edit Janji')
@section('breadcrumb')
    <a href="/"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <a href="/buat-janji">Buat Janji</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Edit</span>
@endsection

@push('styles')
<style>
    .edit-layout { display: flex; justify-content: center; }
    .edit-card { width: 100%; max-width: 560px; }
    .form-header { display: flex; align-items: center; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .form-icon { width: 40px; height: 40px; background: #fef3c7; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: var(--warning); font-size: 1.1rem; }
    .form-header-text h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .form-header-text p { font-size: 0.75rem; color: var(--gray-500); margin: 0; }
    .form-body { padding: 1.25rem; }
    .input-icon-wrap { position: relative; margin-bottom: 1rem; }
    .input-icon-wrap .form-control { padding-left: 2.5rem; width: 100%; }
    .input-icon-wrap i { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 0.9rem; pointer-events: none; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .btn-back-link { display: inline-flex; align-items: center; gap: 0.5rem; color: var(--gray-500); font-size: 0.875rem; transition: var(--transition); margin-bottom: 1.5rem; }
    .btn-back-link:hover { color: var(--primary); }
    @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="edit-layout">
    <div class="edit-card">
        <div class="card">
            <div class="form-header">
                <div class="form-icon"><i class="fas fa-calendar-edit"></i></div>
                <div class="form-header-text">
                    <h3>Edit Janji</h3>
                    <p>Perbarui jadwal janji</p>
                </div>
            </div>
            <div class="form-body">
                <a href="/buat-janji" class="btn-back-link"><i class="fas fa-arrow-left"></i> Kembali</a>

                <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="input-icon-wrap">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nama" class="form-control" placeholder="Nama / Instansi" value="{{ old('nama', $appointment->nama) }}" required>
                    </div>
                    @error('nama')
                        <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                    @enderror

                    <div class="input-icon-wrap">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor HP" value="{{ old('nomor_hp', $appointment->nomor_hp) }}" required>
                    </div>
                    @error('nomor_hp')
                        <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                    @enderror

                    <div class="input-icon-wrap">
                        <i class="fas fa-bullseye"></i>
                        <input type="text" name="tujuan" class="form-control" placeholder="Bertemu dengan" value="{{ old('tujuan', $appointment->tujuan) }}" required>
                    </div>
                    @error('tujuan')
                        <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                    @enderror

                    <div class="form-grid">
                        <div class="input-icon-wrap">
                            <i class="fas fa-users"></i>
                            <input type="number" name="jumlah_orang" class="form-control" placeholder="Jumlah orang" value="{{ old('jumlah_orang', $appointment->jumlah_orang) }}" min="1" max="100" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="input-icon-wrap">
                            <i class="fas fa-calendar"></i>
                            <input type="date" name="tanggal_janji" id="tanggal_janji" class="form-control" value="{{ old('tanggal_janji', $appointment->tanggal_janji) }}" required>
                        </div>
                        <div class="input-icon-wrap">
                            <i class="fas fa-clock"></i>
                            <input type="time" name="jam_janji" id="jam_janji" class="form-control" value="{{ old('jam_janji', $appointment->jam_janji) }}" required>
                        </div>
                    </div>
                    @error('tanggal_janji')
                        <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                    @enderror
                    @error('jam_janji')
                        <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label class="form-label">Pesan / Keterangan</label>
                        <textarea name="pesan" class="form-control" rows="3" placeholder="Pesan atau keterangan...">{{ old('pesan', $appointment->pesan) }}</textarea>
                    </div>
                    @error('pesan')
                        <div class="text-danger text-xs mb-3">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-success w-full" style="padding: 0.625rem;">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const tanggalInput = document.getElementById('tanggal_janji');
    const jamInput = document.getElementById('jam_janji');
    if (tanggalInput && jamInput) {
        function updateTimeMin() {
            const today = new Date().toISOString().split('T')[0];
            if (tanggalInput.value === today) {
                const now = new Date();
                now.setMinutes(now.getMinutes() + 30);
                jamInput.min = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}`;
            } else {
                jamInput.removeAttribute('min');
            }
        }
        tanggalInput.addEventListener('change', updateTimeMin);
        updateTimeMin();
    }
</script>
@endpush
