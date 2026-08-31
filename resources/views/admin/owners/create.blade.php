@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Tambah Owner</h2>

    <form action="{{ route('admin.owners.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Simpan Owner</button>
    </form>
</div>

@endsection