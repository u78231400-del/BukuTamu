<!DOCTYPE html>
<html>
<head>
    <title>Edit Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; max-width: 500px; margin: 50px auto; background: url(images/background1.jpg) no-repeat center center fixed; background-size: cover; padding: 20px; }
        .box { background: rgba(255, 255, 255, 0.98); padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        h1 { color: #333; text-align: center; }
        input, textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        label { margin-bottom: 0; display: block; }
        .btn-update { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
        .btn-update:hover { background: #41b632; }
        .btn-back { display: inline-block; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
        .btn-back:hover { background: #5a6268; color: white; }
    </style>
</head>
<body>
    <div class="box">
        <a href="/bukutamu" class="btn-back">← Kembali</a>
        <h1>✏️ Edit Tamu</h1>
        
        <form action="{{ route('buku-tamu.update', $tamu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Nama:</label>
            <input type="text" name="nama" value="{{ old('nama', $tamu->nama) }}" required>
            @error('nama')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>No Tlp/Email:</label>
            <input type="text" name="kontak" value="{{ old('kontak', $tamu->kontak) }}" required>
            @error('kontak')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>Asal Instansi/Kota:</label>
            <input type="text" name="instansi" value="{{ old('instansi', $tamu->instansi) }}" required>
            @error('instansi')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror

            <label>Pesan/Saran:</label>
            <textarea name="pesan" rows="5" required>{{ old('pesan', $tamu->pesan) }}</textarea>
            @error('pesan')
                <div class="text-danger small mb-2">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="btn-update">Simpan Perubahan</button>
        </form>
    </div>
    @include('partials.toast')
</body>
</html>