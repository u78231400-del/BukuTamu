<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $venue->nama_venue }} - Bukutamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl text-gray-800">Bukutamu Reservasi</h1>
            <div>
                <a href="{{ route('customer.dashboard') }}" class="text-gray-600 hover:text-gray-900 mr-4">Dashboard</a>
                <a href="{{ route('customer.venues') }}" class="text-gray-600 hover:text-gray-900 mr-4">Daftar Venue</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto py-4 px-4">
        @if(session('success'))
    <div class="mb-6 rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-800">
        {{ session('success') }}
    </div>
@endif

 @if(session('error'))
    <div class="mb-6 rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-red-800">
        {{ session('error') }}
       </div>
@endif
        <a href="{{ route('customer.venues') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali ke Daftar Venue</a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-2">
            <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between gap-4 mb-2">
    <h1 class="text-3xl font-bold text-gray-800">
        {{ $venue->nama_venue }}
    </h1>

    @if($isFavorite)
        <form action="{{ route('customer.favorites.destroy', $venue->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="flex items-center gap-2 rounded-lg bg-red-100 px-4 py-2 text-red-600 hover:bg-red-200 transition"
                title="Hapus dari favorit"
            >
                <span class="text-xl">♥</span>
                <span class="font-medium">Hapus Favorit</span>
            </button>
        </form>
    @else
        <form action="{{ route('customer.favorites.store', $venue->id) }}" method="POST">
            @csrf

            <button
                type="submit"
                class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200 transition"
                title="Tambah ke favorit"
            >
                <span class="text-xl">♡</span>
                <span class="font-medium">Tambah Favorit</span>
            </button>
        </form>
    @endif
</div>
                <p class="text-gray-500 mb-4">📍 {{ $venue->lokasi ?? 'Lokasi belum diatur' }} | 👥 Kapasitas: {{ $venue->kapasitas }} Orang</p>
                <div class="border-t pt-4">
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">Deskripsi Ruangan</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $venue->deskripsi }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Form Reservasi</h2>
                <form action="{{ route('customer.reservations.store', $venue->slug) }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Tanggal Mulai
        </label>
        <input
            type="date"
            name="tanggal_mulai"
            value="{{ old('tanggal_mulai') }}"
            min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            required
        >

        @error('tanggal_mulai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Tanggal Selesai
        </label>
        <input
            type="date"
            name="tanggal_selesai"
            value="{{ old('tanggal_selesai') }}"
            min="{{ \Carbon\Carbon::today()->addDays(2)->format('Y-m-d') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            required
        >

        @error('tanggal_selesai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Jam Mulai
        </label>
        <input
            type="time"
            name="waktu_mulai"
            value="{{ old('waktu_mulai') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            required
        >

        @error('waktu_mulai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Jam Selesai
        </label>
        <input
            type="time"
            name="waktu_selesai"
            value="{{ old('waktu_selesai') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            required
        >

        @error('waktu_selesai')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Jumlah Peserta
        </label>
        <input
            type="number"
            name="jumlah_peserta"
            value="{{ old('jumlah_peserta') }}"
            min="1"
            max="{{ $venue->kapasitas }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            required
        >

        <p class="text-xs text-gray-500 mt-1">
            Maksimal {{ $venue->kapasitas }} orang.
        </p>

        @error('jumlah_peserta')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">
            Keterangan / Keperluan
        </label>
        <textarea
            name="keterangan"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2"
            placeholder="Contoh: Rapat Koordinasi Tim"
        >{{ old('keterangan') }}</textarea>

        @error('keterangan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button
        type="submit"
        class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition"
    >
        Ajukan Reservasi
    </button>
</form>
            </div>
        </div>
    </div>
</body>
</html>