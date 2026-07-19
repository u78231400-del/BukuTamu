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

                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="nomor_hp" class="form-control" placeholder="Nomor HP (08xxxxxxxxxx)" value="{{ old('nomor_hp') }}" required>
                </div>
                @error('nomor_hp')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

                <div class="input-icon-wrap mb-3">
                    <i class="fas fa-bullseye"></i>
                    <input type="text" name="tujuan" class="form-control" placeholder="Bertemu dengan / Tujuan" value="{{ old('tujuan') }}" required>
                </div>
                @error('tujuan')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

                <div class="form-grid mb-3">
                    <div class="input-icon-wrap">
                        <i class="fas fa-users"></i>
                        <input type="number" name="jumlah_orang" class="form-control" placeholder="Jumlah orang" value="{{ old('jumlah_orang', 1) }}" min="1" max="100" required>
                    </div>
                </div>
                @error('jumlah_orang')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

                <div class="form-grid mb-3">
                    <div class="input-icon-wrap">
                        <i class="fas fa-calendar"></i>
                        <input type="date" name="tanggal_janji" id="tanggal_janji" class="form-control" value="{{ old('tanggal_janji') }}" required>
                    </div>
                    <div class="input-icon-wrap">
                        <i class="fas fa-clock"></i>
                        <input type="time" name="jam_janji" id="jam_janji" class="form-control" value="{{ old('jam_janji') }}" required>
                    </div>
                </div>
                @error('tanggal_janji')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror
                @error('jam_janji')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

                <div class="form-group mb-4">
                    <label class="form-label">Pesan / Keterangan</label>
                    <textarea name="pesan" class="form-control" rows="3" placeholder="Tulis pesan atau keterangan...">{{ old('pesan') }}</textarea>
                </div>
                @error('pesan')
                    <div class="text-danger text-xs mb-3" style="margin-top:-0.5rem;">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-success w-full" style="padding: 0.625rem;">
                    <i class="fas fa-calendar-check me-2"></i>Ajukan Kunjungan
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="apt-list-header">
            <div class="apt-list-title">
                <h3>Daftar Jadwal Kunjungan</h3>
                <span class="badge badge-primary">{{ $appointments->total() }} jadwal</span>
            </div>
            <form action="/buat-janji" method="GET" class="search-wrap">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="search" class="form-control" placeholder="Cari nama..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="/buat-janji{{ request('status') ? '?status=' . request('status') : '' }}" class="btn btn-outline"><i class="fas fa-times"></i></a>
                @endif
            </form>
        </div>

        <div class="filter-tabs">
            <a class="filter-tab {{ !request('status') ? 'active' : '' }}" href="/buat-janji">Semua</a>
            <a class="filter-tab {{ request('status') == 'menunggu' ? 'active' : '' }}" href="/buat-janji?status=menunggu">
                Menunggu <span class="tab-count waiting">{{ $menunggu }}</span>
            </a>
            <a class="filter-tab {{ request('status') == 'disetujui' ? 'active' : '' }}" href="/buat-janji?status=disetujui">
                Disetujui <span class="tab-count approve">{{ $disetujui }}</span>
            </a>
            <a class="filter-tab {{ request('status') == 'ditolak' ? 'active' : '' }}" href="/buat-janji?status=ditolak">
                Ditolak <span class="tab-count reject">{{ $ditolak }}</span>
            </a>
            <a class="filter-tab {{ request('status') == 'selesai' ? 'active' : '' }}" href="/buat-janji?status=selesai">
                Selesai <span class="tab-count done">{{ $selesai }}</span>
            </a>
        </div>

        <div class="apt-list-body">
            @if(request('search') && $appointments->isEmpty())
                <div class="apt-empty" style="padding:3rem;">
                    <i class="fas fa-search"></i>
                    <h4>Tidak ditemukan</h4>
                    <p class="text-muted">Jadwal dengan nama "{{ request('search') }}" tidak ada.</p>
                </div>
            @endif

            @forelse($appointments as $apt)
            <div class="apt-item {{ $apt->status === 'selesai' ? 'completed' : '' }}">
                <div class="apt-avatar {{ $apt->status }}">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="apt-content">
                    <div class="apt-name">
                        {{ $apt->nama }}
                        <span class="badge badge-{{ $apt->status === 'disetujui' ? 'success' : ($apt->status === 'ditolak' ? 'danger' : ($apt->status === 'selesai' ? 'gray' : 'warning')) }}">
                            {{ ucfirst($apt->status) }}
                        </span>
                    </div>
                    <div class="apt-meta">
                        <span><i class="fas fa-phone"></i>
                            @auth
                                {{ $apt->nomor_hp }}
                            @else
                                {{ substr($apt->nomor_hp, 0, 4) }}{{ str_repeat('*', max(0, strlen($apt->nomor_hp) - 7)) }}{{ substr($apt->nomor_hp, -3) }}
                            @endauth
                        </span>
                        <span><i class="fas fa-bullseye"></i> {{ $apt->tujuan }}</span>
                        <span><i class="fas fa-users"></i> {{ $apt->jumlah_orang }} org</span>
                        <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($apt->tanggal_janji)->format('d M Y') }}</span>
                        <span><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($apt->jam_janji)->format('H:i') }}</span>
                    </div>
                    @if($apt->pesan)
                    <div class="apt-message">
                        {{ Str::limit($apt->pesan, 150) }}
                        @if(strlen($apt->pesan) > 150)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $apt->id }}"> Baca selengkapnya...</a>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="apt-actions">
                    @if($apt->status === 'menunggu' || $apt->status === 'ditolak')
                        <a href="{{ route('appointment.edit', $apt->id) }}" class="btn btn-icon btn-outline" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        @auth
                        <form action="{{ route('appointment.approve', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui kunjungan ini?')">
                            @csrf
                            <button type="submit" class="btn btn-icon" title="Setujui" style="background:var(--success);color:white;">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('appointment.reject', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak kunjungan ini?')">
                            @csrf
                            <button type="submit" class="btn btn-icon" title="Tolak" style="background:var(--danger);color:white;">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endauth
                        <form action="{{ route('appointment.destroy', $apt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon btn-outline" title="Hapus" style="color:var(--danger);">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="modal fade" id="detailModal{{ $apt->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan dari {{ $apt->nama }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="white-space:pre-wrap;font-size:0.9rem;color:var(--gray-700);">{{ $apt->pesan }}</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="apt-empty">
                <i class="fas fa-calendar-times"></i>
                <h4>Belum ada jadwal kunjungan</h4>
                <p class="text-muted">Jadwal kunjungan pertama akan muncul di sini.</p>
            </div>
            @endforelse
        </div>

        @if($appointments->hasPages())
        <div class="pagination-wrap">
            {{ $appointments->appends(['search' => request('search'), 'status' => request('status')])->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const tanggalInput = document.getElementById('tanggal_janji');
    const jamInput = document.getElementById('jam_janji');
    if (tanggalInput && jamInput) {
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.min = today;
        function updateMinTime() {
            if (tanggalInput.value === today) {
                const now = new Date();
                jamInput.min = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}`;
            } else { jamInput.min = ''; }
        }
        tanggalInput.addEventListener('change', updateMinTime);
        updateMinTime();
    }
</script>
@endpush
