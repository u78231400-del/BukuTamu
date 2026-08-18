@extends('layouts.app')

@section('title', 'Edit Tamu')
@section('page-title', 'Edit Tamu')

@section('content')
<style>
    .form-box { background: rgba(255, 255, 255, 0.98); padding: 30px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-width: 600px; }
    h1 { color: #333; text-align: center; }
    input, textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    label { margin-bottom: 0; display: block; }
    .btn-update { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
    .btn-update:hover { background: #41b632; }
    .btn-back { display: inline-block; padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
    .btn-back:hover { background: #5a6268; color: white; }
</style>

<div class="form-box">
    <a href="/bukutamu" class="btn-back">← Kembali</a>
    <h1>Edit Tamu</h1>
    
    <form action="{{ route('buku-tamu.update', $tamu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama/Instansi:</label>
        <input type="text" name="nama" value="{{ old('nama', $tamu->nama) }}" required>
        @error('nama')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror

        <label>Jumlah Orang:</label>
        <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', $tamu->jumlah_orang) }}" min="1" required>

        <label>Waktu Kedatangan:</label>
        <input type="time" name="waktu_kedatangan" value="{{ old('waktu_kedatangan', $tamu->waktu_kedatangan) }}" step="3600">

        <label>Nomor HP:</label>
        <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $tamu->nomor_hp) }}" required>
        @error('nomor_hp')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror

        <label>Tujuan Bertemu:</label>
        <input type="text" name="tujuan" value="{{ old('tujuan', $tamu->tujuan) }}" required>
        @error('tujuan')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror

        <label>Pesan/Keterangan:</label>
        <textarea name="pesan" rows="5">{{ old('pesan', $tamu->pesan) }}</textarea>
        @error('pesan')
            <div class="text-danger small mb-2">{{ $message }}</div>
        @enderror
        
        <button type="submit" class="btn-update">Simpan Perubahan</button>
    </form>
</div>
@endsection
