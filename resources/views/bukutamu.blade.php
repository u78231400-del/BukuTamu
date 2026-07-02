<!DOCTYPE html>
<html>
<head>
    <title>Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
        .box { background: rgba(255, 255, 255, 0.98); padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-width: 650px; margin: 50px auto; }
        h1 { color: #333; text-align: center; }
        textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input[type="text"], input[type="search"] { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .input-group input[type="text"] { margin: 0; }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .stat-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 25px; }
        .stat-card { padding: 20px 15px; border-radius: 12px; color: #fff; text-align: center; position: relative; overflow: hidden; }
        .stat-card .stat-icon { font-size: 28px; margin-bottom: 8px; opacity: 0.85; }
        .stat-card .stat-number { font-size: 28px; font-weight: 700; line-height: 1; }
        .stat-card .stat-label { font-size: 12px; opacity: 0.9; margin-top: 4px; }
        .card-total { background: linear-gradient(135deg, #4e73df, #224abe); }
        .card-today { background: linear-gradient(135deg, #1cc88a, #13855c); }
        .card-month { background: linear-gradient(135deg, #f6c23e, #dda20a); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Buku Tamu</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/bukutamu">Buku Tamu</a>
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="box">
        <div class="stat-cards">
            <div class="stat-card card-total">
                <div class="stat-icon">👥</div>
                <div class="stat-number">{{ $totalTamu }}</div>
                <div class="stat-label">Total Tamu</div>
            </div>
            <div class="stat-card card-today">
                <div class="stat-icon">📅</div>
                <div class="stat-number">{{ $tamuHariIni }}</div>
                <div class="stat-label">Hari Ini</div>
            </div>
            <div class="stat-card card-month">
                <div class="stat-icon">📆</div>
                <div class="stat-number">{{ $tamuBulanIni }}</div>
                <div class="stat-label">Bulan Ini</div>
            </div>
        </div>

        @if(!request('search'))
        <h1>📝 Isi Buku Tamu</h1>

        <form action="/bukutamu" method="POST">
            @csrf
            <label>Nama:</label>
            <input type="text" name="nama" placeholder="Tulis namamu..." value="{{ old('nama') }}" required>
            @error('nama')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>No Tlp/Email:</label>
            <input type="text" name="kontak" placeholder="No telepon atau email..." value="{{ old('kontak') }}" required>
            @error('kontak')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>Asal Instansi/Kota:</label>
            <input type="text" name="instansi" placeholder="Asal instansi atau kota..." value="{{ old('instansi') }}" required>
            @error('instansi')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>Pesan/Saran:</label>
            <textarea name="pesan" rows="4" placeholder="Tulis pesan atau saran..." required>{{ old('pesan') }}</textarea>
            @error('pesan')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="btn-submit">Kirim Pesan</button>
        </form>
        @endif

        <form action="/bukutamu" method="GET" class="mt-4 mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, kontak, instansi, atau pesan..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                @if(request('search'))
                    <a href="/bukutamu" class="btn btn-outline-secondary">Kembali</a>
                @endif
            </div>
        </form>

        @if(request('search') && $tamus->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>Data tidak ditemukan</strong><br>
                Tamu dengan nama "{{ request('search') }}" tidak ada di daftar.
            </div>
        @endif

        @if(!request('search') || !$tamus->isEmpty())
        <hr style="margin: 30px 0;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Daftar Tamu:</h3>
        </div>

        @forelse($tamus as $tamu)
            <div style="border:1px solid #ddd; padding:15px; margin:10px 0; border-radius:8px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <b>{{ $tamu->nama }}</b>
                            <small style="color:gray;">{{ \Carbon\Carbon::parse($tamu->created_at)->format('d M Y') }} • {{ \Carbon\Carbon::parse($tamu->created_at)->format('H:i') }}</small>
                        </div>
                        <small class="text-muted">{{ $tamu->kontak }} • {{ $tamu->instansi }}</small>
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
                
                <p class="mb-0">
                    {{ Str::limit($tamu->pesan, 150) }}
                    @if(strlen($tamu->pesan) > 150)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $tamu->id }}">
                            Baca selengkapnya...
                        </a>
                    @endif
                </p>
            </div>

            <!-- Modal Detail -->
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
            <p class="text-center text-muted">Belum ada tamu yang mengisi buku tamu.</p>
        @endforelse
        @endif

        <div class="d-flex justify-content-center mt-4">
            {{ $tamus->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('partials.toast')
</body>
</html>