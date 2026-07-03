<!DOCTYPE html>
<html>
<head>
    <title>Buat Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-box, .list-box { background: rgba(255, 255, 255, 0.98); padding: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .form-box { height: fit-content; position: sticky; top: 20px; }
        .list-box { max-height: calc(100vh - 120px); overflow-y: auto; }
        h3 { color: #333; }
        input[type="text"], input[type="email"], input[type="date"], input[type="time"], textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input:focus, textarea:focus { outline: none; border-color: #4e73df; box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1); }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .btn-nav { padding: 8px 16px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; font-size: 14px; }
        .btn-nav:hover { background: #5a6268; color: white; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-pending { background: linear-gradient(135deg, #f6c23e, #dda20a); }
        .card-approved { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .stat-cards-horizontal { display: flex; gap: 10px; margin-bottom: 15px; }
        .stat-card-sm { flex: 1; padding: 12px; border-radius: 10px; color: #fff; text-align: center; }
        .stat-card-sm .stat-number { font-size: 20px; font-weight: 700; }
        .stat-card-sm .stat-label { font-size: 10px; opacity: 0.9; }
        .appointment-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 12px; border-radius: 8px; }
        .appointment-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #ccc; border-radius: 3px; }
        .badge-menunggu { background: #f6c23e; }
        .badge-disetujui { background: #1cc88a; }
        .badge-ditolak { background: #e74a3b; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Buku Tamu</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link active" href="/buat-janji">Buat Janji</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="form-box">
                    <h3>📅 Form Buat Janji</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="/buat-janji" method="POST">
                        @csrf
                        <label>Nama/Instansi:</label>
                        <input type="text" name="nama" placeholder="Nama atau instansi..." value="{{ old('nama') }}" required>
                        @error('nama')
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

                        <div class="row">
                            <div class="col-6">
                                <label>Tanggal Janji:</label>
                                <input type="date" name="tanggal_janji" value="{{ old('tanggal_janji') }}" required>
                                @error('tanggal_janji')
                                    <div class="text-danger small mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label>Jam Janji:</label>
                                <input type="time" name="jam_janji" value="{{ old('jam_janji') }}" required>
                                @error('jam_janji')
                                    <div class="text-danger small mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <label>Pesan/Keterangan:</label>
                        <textarea name="pesan" rows="4" placeholder="Tulis pesan atau keterangan...">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                        
                        <button type="submit" class="btn-submit">Buat Janji</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="list-box scrollbar-thin">
                    <div class="stat-cards-horizontal">
                        <div class="stat-card-sm card-total">
                            <div class="stat-number">{{ $totalAppointment }}</div>
                            <div class="stat-label">Total Janji</div>
                        </div>
                        <div class="stat-card-sm card-pending">
                            <div class="stat-number">{{ $menunggu }}</div>
                            <div class="stat-label">Menunggu</div>
                        </div>
                        <div class="stat-card-sm card-approved">
                            <div class="stat-number">{{ $disetujui }}</div>
                            <div class="stat-label">Disetujui</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <h3 class="mb-0">📋 Daftar Janji</h3>
                            <span class="badge bg-primary">{{ $appointments->total() }} janji</span>
                        </div>
                        <a href="/buat-janji" class="btn-nav">+ Buat Janji</a>
                    </div>

                    @forelse($appointments as $apt)
                        <div class="appointment-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <b>{{ $apt->nama }}</b>
                                        <span class="badge badge-{{ $apt->status == 'menunggu' ? 'menunggu' : ($apt->status == 'disetujui' ? 'disetujui' : 'ditolak') }}">
                                            {{ ucfirst($apt->status) }}
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        {{ $apt->nomor_hp }}
                                    </small>
                                    <br>
                                    <small class="text-muted">Tujuan: {{ $apt->tujuan }}</small>
                                    <br>
                                    <small class="text-muted">
                                        📅 {{ \Carbon\Carbon::parse($apt->tanggal_janji)->format('d M Y') }} • 🕐 {{ \Carbon\Carbon::parse($apt->jam_janji)->format('H:i') }}
                                    </small>
                                </div>
                                @auth
                                <div class="btn-group btn-group-sm">
                                    <form action="{{ route('appointment.approve', $apt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm py-0 px-2">✓</button>
                                    </form>
                                    <form action="{{ route('appointment.reject', $apt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm py-0 px-2">✗</button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                            
                            @if($apt->pesan)
                            <p class="mb-0">
                                {{ Str::limit($apt->pesan, 100) }}
                                @if(strlen($apt->pesan) > 100)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $apt->id }}">Baca selengkapnya...</a>
                                @endif
                            </p>
                            @endif
                        </div>

                        <div class="modal fade" id="detailModal{{ $apt->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pesan: {{ $apt->nama }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

                    <div class="d-flex justify-content-center mt-3">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toast')
</body>
</html>
