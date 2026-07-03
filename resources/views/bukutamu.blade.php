<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-box, .list-box { background: rgba(255, 255, 255, 0.98); padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .form-box { height: fit-content; position: sticky; top: 20px; }
        .list-box { max-height: calc(100vh - 120px); overflow-y: auto; }
        h3 { color: #333; }
        textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .stat-cards-horizontal { display: flex; gap: 10px; margin-bottom: 15px; }
        .stat-card-sm { flex: 1; padding: 12px; border-radius: 10px; color: #fff; text-align: center; }
        .stat-card-sm .stat-number { font-size: 20px; font-weight: 700; }
        .stat-card-sm .stat-label { font-size: 10px; opacity: 0.9; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-today { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .card-month { background: linear-gradient(135deg, #f6c23e, #dda20a); }
        .guest-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 8px; }
        .guest-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }
        .search-box { display: flex; align-items: center; gap: 0; }
        .search-box input { border-radius: 4px 0 0 4px; height: 32px; padding: 6px 10px; font-size: 13px; margin: 0; width: auto; }
        .search-box .btn { border-radius: 0 4px 4px 0; height: 32px; padding: 0 12px; font-size: 13px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Home</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link" href="/buat-janji">Buat Janji</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="form-box scrollbar-thin">
                    <h3>📝 Isi Buku Tamu</h3>
                    <form action="/bukutamu" method="POST">
                        @csrf
                        <label>Nama/Instansi:</label>
                        <input type="text" name="nama" placeholder="Nama atau instansi..." value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <label>Jumlah Orang:</label>
                        <input type="number" name="jumlah_orang" placeholder="Jumlah orang..." value="{{ old('jumlah_orang', 1) }}" min="1" required>
                        @error('jumlah_orang')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <label>Nomor HP:</label>
                        <input type="text" name="nomor_hp" placeholder="08xxxxxxxxxx" value="{{ old('nomor_hp') }}" required>
                        @error('nomor_hp')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <label>Tujuan Bertemu:</label>
                        <input type="text" name="tujuan" placeholder="Siapa yang ingin ditemui..." value="{{ old('tujuan') }}" required>
                        @error('tujuan')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror

                        <label>Pesan/Keterangan:</label>
                        <textarea name="pesan" rows="4" placeholder="Tulis pesan atau keterangan...">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                        
                        <button type="submit" class="btn-submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="list-box scrollbar-thin">
                    <div class="stat-cards-horizontal">
                        <div class="stat-card-sm card-total">
                            <div class="stat-number">{{ $totalTamu }}</div>
                            <div class="stat-label">Total Kunjungan</div>
                        </div>
                        <div class="stat-card-sm card-today">
                            <div class="stat-number">{{ $tamuHariIni }}</div>
                            <div class="stat-label">Kunjungan Hari Ini</div>
                        </div>
                        <div class="stat-card-sm card-month">
                            <div class="stat-number">{{ $tamuBulanIni }}</div>
                            <div class="stat-label">Kunjungan Bulan Ini</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="mb-0">📋 Daftar Tamu</h3>
                            <span class="badge bg-primary">{{ $tamus->total() }} tamu</span>
                        </div>
                        <form action="/bukutamu" method="GET" class="mb-0">
                            <div class="search-box">
                                <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Cari</button>
                                @if(request('search'))
                                    <a href="/bukutamu" class="btn btn-outline-secondary">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if(request('search') && $tamus->isEmpty())
                        <div class="alert alert-warning text-center">
                            <strong>Data tidak ditemukan</strong><br>
                            Tamu dengan nama "{{ request('search') }}" tidak ada di daftar.
                        </div>
                    @endif

                    @forelse($tamus as $tamu)
                        <div class="guest-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <b>{{ $tamu->nama }}</b>
                                        <small style="color:gray;">{{ \Carbon\Carbon::parse($tamu->created_at)->format('d M Y') }} • {{ \Carbon\Carbon::parse($tamu->created_at)->format('H:i') }}</small>
                                    </div>
                                    <small class="text-muted">
                                        {{ $tamu->nomor_hp }} • {{ $tamu->jumlah_orang }} orang
                                    </small>
                                    <br>
                                    <small class="text-muted">Tujuan: {{ $tamu->tujuan }}</small>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('buku-tamu.edit', $tamu->id) }}" class="btn btn-warning btn-sm py-0 px-2 me-1">Edit</a>
                                    <form action="{{ route('buku-tamu.destroy', $tamu->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm py-0 px-2" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            
                            @if($tamu->pesan)
                            <p class="mb-0">
                                {{ Str::limit($tamu->pesan, 120) }}
                                @if(strlen($tamu->pesan) > 120)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $tamu->id }}">
                                        Baca selengkapnya...
                                    </a>
                                @endif
                            </p>
                            @endif
                        </div>

                        <div class="modal fade" id="detailModal{{ $tamu->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $tamu->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $tamu->id }}">Detail Pesan: {{ $tamu->nama }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="white-space: pre-wrap;">{{ $tamu->pesan }}</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-5">Belum ada tamu yang mengisi buku tamu.</p>
                    @endforelse

                    <div class="d-flex justify-content-center mt-3">
                        {{ $tamus->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toast')
</body>
</html>
