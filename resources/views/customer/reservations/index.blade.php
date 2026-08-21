<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reservasi Saya - Bukutamu</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm p-4 mb-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <h1 class="font-bold text-xl text-gray-800">
                Bukutamu Reservasi
            </h1>

            <div class="flex items-center">

                <a
                    href="{{ route('customer.dashboard') }}"
                    class="text-gray-600 hover:text-gray-900 mr-4"
                >
                    Dashboard
                </a>

                <a
                    href="{{ route('customer.venues') }}"
                    class="text-gray-600 hover:text-gray-900 mr-4"
                >
                    Daftar Venue
                </a>

                <span class="text-gray-700 mr-4">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf

                    <button
                        type="submit"
                        class="text-red-600 hover:underline"
                    >
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </nav>


    {{-- Content --}}
    <main class="max-w-7xl mx-auto px-4 pb-10">

        <div class="mb-6">

            <h2 class="text-3xl font-bold text-gray-800">
                Reservasi Saya
            </h2>

            <p class="text-gray-500 mt-1">
                Daftar reservasi yang telah kamu ajukan.
            </p>

        </div>


        {{-- Jika belum ada reservasi --}}
        @if($reservations->isEmpty())

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">

                <div class="text-gray-400 text-5xl mb-4">
                    🏢
                </div>

                <h3 class="text-xl font-semibold text-gray-800">
                    Belum ada reservasi
                </h3>

                <p class="text-gray-500 mt-2 mb-6">
                    Kamu belum mengajukan reservasi venue.
                </p>

                <a
                    href="{{ route('customer.venues') }}"
                    class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-lg"
                >
                    Cari Venue
                </a>

            </div>

        @else

            {{-- Daftar reservasi --}}
            <div class="space-y-5">

                @foreach($reservations as $reservation)

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">

                            {{-- Informasi utama --}}
                            <div>

                                <div class="flex items-center gap-3 mb-2">

                                    <h3 class="text-xl font-bold text-gray-800">
                                        {{ $reservation->venue->nama_venue }}
                                    </h3>

                                    @if($reservation->status === 'pending')

                                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                                            Menunggu Persetujuan
                                        </span>

                                    @elseif($reservation->status === 'approved')

                                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                                            Disetujui
                                        </span>

                                    @elseif($reservation->status === 'rejected')

                                        <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">
                                            Ditolak
                                        </span>

                                    @elseif($reservation->status === 'canceled')

                                        <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700">
                                            Dibatalkan
                                        </span>

                                    @endif

                                </div>

                                <p class="text-sm text-gray-500">
                                    Kode Booking:
                                    <span class="font-semibold text-gray-700">
                                        {{ $reservation->kode_booking }}
                                    </span>
                                </p>

                            </div>


                            {{-- Detail --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-3 text-sm">

                                <div>
                                    <p class="text-gray-400">
                                        Tanggal
                                    </p>

                                    <p class="font-medium text-gray-700">
                                        {{ \Carbon\Carbon::parse($reservation->tanggal_mulai)->format('d/m/Y') }}

                                        @if($reservation->tanggal_mulai != $reservation->tanggal_selesai)
                                            -
                                            {{ \Carbon\Carbon::parse($reservation->tanggal_selesai)->format('d/m/Y') }}
                                        @endif
                                    </p>
                                </div>


                                <div>
                                    <p class="text-gray-400">
                                        Waktu
                                    </p>

                                    <p class="font-medium text-gray-700">
                                        {{ \Carbon\Carbon::parse($reservation->waktu_mulai)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($reservation->waktu_selesai)->format('H:i') }}
                                    </p>
                                </div>


                                <div>
                                    <p class="text-gray-400">
                                        Jumlah Peserta
                                    </p>

                                    <p class="font-medium text-gray-700">
                                        {{ $reservation->jumlah_peserta }} orang
                                    </p>
                                </div>


                                <div>
                                    <p class="text-gray-400">
                                        Status
                                    </p>

                                    <p class="font-medium text-gray-700">
                                        {{ ucfirst($reservation->status) }}
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- Keterangan --}}
                        @if($reservation->keterangan)

                            <div class="mt-5 pt-4 border-t border-gray-100">

                                <p class="text-sm text-gray-400 mb-1">
                                    Keterangan
                                </p>

                                <p class="text-gray-600">
                                    {{ $reservation->keterangan }}
                                </p>

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>

        @endif

    </main>

</body>
</html>