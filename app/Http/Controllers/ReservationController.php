<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('venue')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.reservations.index', compact('reservations'));
    }

    public function store(Request $request, $slug)
    {
        $venue = Venue::where('slug', $slug)
            ->where('status', 'available')
            ->firstOrFail();

        $validated = $request->validate([
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => ['required', 'date_format:H:i', 'after:waktu_mulai'],
            'jumlah_peserta' => ['required', 'integer', 'min:1', 'max:' . $venue->kapasitas],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        Reservation::create([
            'venue_id' => $venue->id,
            'user_id' => Auth::id(),
            'kode_booking' => 'BK-' . strtoupper(Str::random(8)),
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('customer.venues.show', $venue->slug)
            ->with('success', 'Reservasi berhasil diajukan dan sedang menunggu persetujuan admin.');
    }
}