<!DOCTYPE html>
<html>
<head>
    <title>Edit Janji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; min-height: 100vh; }
        .form-container { background: rgba(255, 255, 255, 0.98); padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-width: 600px; margin: 50px auto; }
        h3 { color: #333; }
        input[type="text"], input[type="email"], input[type="date"], input[type="time"], textarea, select { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #4e73df; box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1); }
        label { margin-bottom: 0; display: block; }
        .btn-submit { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-submit:hover { background: #41b632; }
        .btn-back { background: #6c757d; color: white; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer; }
        .navbar-collapse { background: #0d6efd; margin-top: 10px; padding: 10px; border-radius: 8px; }
        .navbar-collapse .nav-link { padding: 8px 12px; }
        .navbar-mobile-menu { display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); min-width: 180px; z-index: 1000; overflow: hidden; }
        .navbar-mobile-menu.show { display: block; }
        .navbar-mobile-menu .nav-link { color: #333 !important; padding: 12px 16px; border-bottom: 1px solid #eee; display: block; }
        .navbar-mobile-menu .nav-link:last-child { border-bottom: none; }
        .navbar-mobile-menu .nav-link:hover { background: #f8f9fa; }
        .navbar-mobile-menu .nav-link.active { background: #e7f1ff; color: #0d6efd !important; }
        @media (max-width: 991px) {
            .navbar .container { position: relative; }
            .navbar .navbar-collapse { display: none !important; }
        }
        @media (min-width: 992px) {
            .navbar-mobile-menu { display: none !important; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
            <a class="navbar-brand" href="/bukutamu">Buku Tamu</a>
            <div class="d-flex align-items-center gap-2">
                <div class="navbar-mobile-menu" id="mobileMenu">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link active" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="/bukutamu">Buku Tamu</a>
                    <a class="nav-link active" href="/buat-janji">Buat Janji</a>
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function toggleMobileMenu() { var menu = document.getElementById('mobileMenu'); menu.classList.toggle('show'); }
        document.addEventListener('click', function(e) { var menu = document.getElementById('mobileMenu'); if (!e.target.closest('.d-flex')) menu.classList.remove('show'); });
    </script>

    <div class="container">
        <div class="form-container">
            <h3>Edit Janji</h3>
            <a href="/buat-janji" class="btn btn-back mb-3">← Kembali</a>

            <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label>Nama/Instansi:</label>
                <input type="text" name="nama" value="{{ old('nama', $appointment->nama) }}" required>
                @error('nama')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <label>Nomor HP:</label>
                <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $appointment->nomor_hp) }}" required>
                @error('nomor_hp')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <label>Bertemu Dengan:</label>
                <input type="text" name="tujuan" value="{{ old('tujuan', $appointment->tujuan) }}" required>
                @error('tujuan')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <label>Jumlah Orang:</label>
                <input type="number" name="jumlah_orang" min="1" max="100" value="{{ old('jumlah_orang', $appointment->jumlah_orang) }}" required>
                @error('jumlah_orang')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror

                <div class="row">
                    <div class="col-6">
                        <label>Tanggal Janji:</label>
                        <input type="date" name="tanggal_janji" id="tanggal_janji" value="{{ old('tanggal_janji', $appointment->tanggal_janji) }}" min="{{ date('Y-m-d') }}" required>
                        @error('tanggal_janji')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>Jam Janji:</label>
                        <input type="time" name="jam_janji" id="jam_janji" value="{{ old('jam_janji', $appointment->jam_janji) }}" required>
                        @error('jam_janji')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <label>Pesan/Keterangan:</label>
                <textarea name="pesan" rows="4">{{ old('pesan', $appointment->pesan) }}</textarea>
                @error('pesan')
                    <div class="text-danger small mb-2">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
    <script>
        const tanggalInput = document.getElementById('tanggal_janji');
        const jamInput = document.getElementById('jam_janji');

        function updateTimeMin() {
            const today = new Date().toISOString().split('T')[0];
            if (tanggalInput.value === today) {
                const now = new Date();
                now.setMinutes(now.getMinutes() + 30);
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                jamInput.min = hours + ':' + minutes;
            } else {
                jamInput.removeAttribute('min');
            }
        }

        tanggalInput.addEventListener('change', updateTimeMin);
        updateTimeMin();
    </script>
</body>
</html>
