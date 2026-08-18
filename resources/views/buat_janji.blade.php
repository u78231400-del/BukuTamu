@extends('layouts.app')

@section('title', 'Jadwal Kunjungan - RS Medika')
@section('page-title', 'Jadwal Kunjungan')
@section('breadcrumb')
    <a href="/"><i class="fas fa-home me-2"></i>Home</a>
    <i class="fas fa-chevron-right text-xs"></i>
    <span>Jadwal Kunjungan</span>
@endsection

@push('styles')
<style>
    .two-col { display: grid; grid-template-columns: 420px 1fr; gap: 1.5rem; align-items: start; }
    .form-card { position: sticky; top: calc(var(--header-height) + 1.5rem); }
    .form-header { display: flex; align-items: center; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .form-icon { width: 40px; height: 40px; background: #fef3c7; border-radius: var(--radius); display: flex; align-items: center; justify-content: center; color: var(--warning); font-size: 1.1rem; }
    .form-header-text h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .form-header-text p { font-size: 0.75rem; color: var(--gray-500); margin: 0; }
    .form-body { padding: 1.25rem; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .form-control { padding-left: 2.5rem; }
    .input-icon-wrap i { position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 0.9rem; pointer-events: none; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .apt-list-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem; padding: 1.25rem; border-bottom: 1px solid var(--gray-200); }
    .apt-list-title { display: flex; align-items: center; gap: 0.75rem; }
    .apt-list-title h3 { font-size: 1rem; font-weight: 600; color: var(--gray-900); margin: 0; }
    .search-wrap { display: flex; align-items: center; gap: 0; }
    .search-wrap .form-control { border-radius: var(--radius) 0 0 var(--radius); height: 36px; padding: 0.375rem 0.75rem; font-size: 0.875rem; }
    .search-wrap .btn { border-radius: 0 var(--radius) var(--radius) 0; height: 36px; padding: 0 0.875rem; }
    .apt-list-body { padding: 0; }
    .apt-item { display: flex; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid var(--gray-100); transition: var(--transition); }
    .apt-item:hover { background: var(--gray-50); }
    .apt-item:last-child { border-bottom: none; }
    .apt-item.completed { opacity: 0.6; }
    .apt-avatar { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 1rem; flex-shrink: 0; }
    .apt-avatar.menunggu { background: var(--warning); }
    .apt-avatar.disetujui { background: var(--success); }
    .apt-avatar.ditolak { background: var(--danger); }
    .apt-avatar.selesai { background: var(--gray-400); }
    .apt-content { flex: 1; min-width: 0; }
    .apt-name { font-weight: 600; color: var(--gray-900); font-size: 0.9rem; display: flex; align-items: center; gap: 0.5rem; }
    .apt-meta { display: flex; flex-wrap: wrap; gap: 0.5rem 1rem; margin-top: 4px; font-size: 0.75rem; color: var(--gray-500); }
    .apt-meta span { display: flex; align-items: center; gap: 4px; }
    .apt-actions { display: flex; align-items: center; gap: 0.375rem; flex-shrink: 0; flex-wrap: wrap; }
    .apt-message { margin-top: 0.5rem; padding: 0.625rem; background: var(--gray-50); border-radius: var(--radius); font-size: 0.8rem; color: var(--gray-600); line-height: 1.5; }
    .apt-message a { color: var(--primary); }
    .apt-empty { text-align: center; padding: 4rem 1rem; color: var(--gray-400); }
    .apt-empty i { font-size: 3rem; margin-bottom: 1rem; display: block; }
    .pagination-wrap { padding: 1rem 1.25rem; border-top: 1px solid var(--gray-200); }
    .filter-tabs { display: flex; gap: 0.25rem; padding: 1rem 1.25rem; border-bottom: 1px solid var(--gray-200); overflow-x: auto; }
    .filter-tab { padding: 0.5rem 1rem; border-radius: var(--radius); font-size: 0.8rem; font-weight: 500; color: var(--gray-500); border: none; background: transparent; cursor: pointer; transition: var(--transition); white-space: nowrap; }
    .filter-tab:hover { background: var(--gray-100); color: var(--gray-700); }
    .filter-tab.active { background: var(--primary); color: white; }
    .filter-tab .tab-count { display: inline-flex; align-items: center; justify-content: center; min-width: 20px; height: 20px; border-radius: 10px; font-size: 0.65rem; font-weight: 700; margin-left: 4px; padding: 0 6px; }
    .filter-tab.active .tab-count { background: rgba(255,255,255,0.25); }
    .filter-tab .tab-count.waiting { background: var(--warning); color: #fff; }
    .filter-tab .tab-count.approve { background: var(--success); color: #fff; }
    .filter-tab .tab-count.reject { background: var(--danger); color: #fff; }
    .filter-tab .tab-count.done { background: var(--gray-400); color: #fff; }
    @media (max-width: 1024px) { .two-col { grid-template-columns: 1fr; } .form-card { position: static; } .form-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px) { .apt-list-header { flex-direction: column; align-items: flex-start; } .search-wrap { width: 100%; } .search-wrap .form-control { flex: 1; } }
</style>
@endpush

@section('content')
<div class="two-col">
    <div class="card form-card">
        <div class="form-header">
            <div class="form-icon"><i class="fas fa-calendar-plus"></i></div>
            <div class="form-header-text">
                <h3>Form Jadwal Kunjungan</h3>
                <p>Ajukan jadwal kunjungan Anda</p>
            </div>
        </div>
        <div class="form-body">
            <form action="/buat-janji" method="POST">
                @csrf
                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama" class="form-control" placeholder="Nama / Instansi" value="{{ old('nama') }}" required>
                </div>
                @error('nama')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="/buat-janji">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'menunggu' ? 'active' : '' }}" href="/buat-janji?status=menunggu">
                        Menunggu <span class="badge bg-warning text-dark ms-1">{{ $menunggu }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'disetujui' ? 'active' : '' }}" href="/buat-janji?status=disetujui">
                        Disetujui <span class="badge bg-success ms-1">{{ $disetujui }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'ditolak' ? 'active' : '' }}" href="/buat-janji?status=ditolak">
                        Ditolak <span class="badge bg-danger ms-1">{{ $ditolak }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}" href="/buat-janji?status=selesai">
                        Selesai <span class="badge bg-secondary ms-1">{{ $selesai }}</span>
                    </a>
                </li>
            </ul>

            @if(request('search') && $appointments->isEmpty())
                <div class="alert alert-warning text-center">
                    <strong>Data tidak ditemukan</strong><br>
                    Janji dengan nama "{{ request('search') }}" tidak ada di daftar.
                </div>
            @endif

            <div class="timeline">
            @forelse($appointments as $apt)
                @php
                    $isCompleted = $apt->status === 'selesai';
                @endphp
                <div class="timeline-item">
                    <div class="timeline-dot" style="background: 
                        @if($apt->status == 'disetujui') #1cc88a
                        @elseif($apt->status == 'ditolak') #e74a3b
                        @elseif($apt->status == 'selesai') #6c757d
                        @else #f6c23e @endif;">
                    </div>
                    <div class="appointment-card {{ $isCompleted ? 'completed' : '' }}" style="margin-bottom: 12px;">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <b>{{ $apt->nama }}</b>
                                    <span class="badge badge-{{ $apt->status }}">
                                        {{ ucfirst($apt->status) }}
                                    </span>
                                </div>
                                <small class="text-muted">
                                    @auth
                                        {{ $apt->nomor_hp }}
                                    @else
                                        {{ substr($apt->nomor_hp, 0, 4) }}{{ str_repeat('*', strlen($apt->nomor_hp) - 7) }}{{ substr($apt->nomor_hp, -3) }}
                                    @endauth
                                </small>
                                <br>
                                <small class="text-muted">Tujuan: {{ $apt->tujuan }}</small>
                                <br>
                                <small class="text-muted">Jumlah: {{ $apt->jumlah_orang }} orang</small>
                                <br>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($apt->tanggal_janji)->format('d M Y') }} - {{ \Carbon\Carbon::parse($apt->jam_janji)->format('H:i') }}
                                </small>
                            </div>
                            @if($apt->status === 'menunggu' || $apt->status === 'ditolak')
                            <div class="btn-group">
                                <a href="{{ route('appointment.edit', $apt->id) }}" class="btn btn-warning btn-sm" title="Edit" style="padding: 6px 14px; font-size: 13px;">Edit</a>
                                <form action="{{ route('appointment.destroy', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus janji ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" style="padding: 6px 14px; font-size: 13px;">Hapus</button>
                                </form>
                                @auth
                                <form action="{{ route('appointment.approve', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui janji ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" style="padding: 6px 14px; font-size: 13px;">Setujui</button>
                                </form>
                                <form action="{{ route('appointment.reject', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak janji ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-sm" style="padding: 6px 14px; font-size: 13px;">Tolak</button>
                                </form>
                                @endauth
                            </div>
                            @endif
                        </div>
                        
                        @if($apt->pesan)
                        <p class="mb-0">
                            {{ Str::limit($apt->pesan, 120) }}
                            @if(strlen($apt->pesan) > 120)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $apt->id }}">Baca selengkapnya...</a>
                            @endif
                        </p>
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="detailModal{{ $apt->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $apt->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $apt->id }}">Detail Pesan: {{ $apt->nama }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="white-space: pre-wrap;">{{ $apt->pesan }}</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted py-5">Belum ada janji yang dibuat.</p>
            @endforelse
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $appointments->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#jumlah_orang').select2({
            placeholder: 'Pilih jumlah orang',
            allowClear: false,
            width: '100%'
        });

        $('#tujuan').select2({
            placeholder: 'Pilih orang yang ditemui...',
            allowClear: true,
            width: '100%'
        });
    });

    const tanggalInput = document.getElementById('tanggal_janji');
    const jamInput = document.getElementById('jam_janji');
    const today = new Date().toISOString().split('T')[0];

    tanggalInput.min = today;

    function updateMinTime() {
        if (tanggalInput.value === today) {
            const now = new Date();
            const currentHour = String(now.getHours()).padStart(2, '0');
            const currentMinute = String(now.getMinutes()).padStart(2, '0');
            jamInput.min = `${currentHour}:${currentMinute}`;
        } else {
            jamInput.min = '';
        }
    }

    tanggalInput.addEventListener('change', updateMinTime);
    updateMinTime();
</script>
@endpush
