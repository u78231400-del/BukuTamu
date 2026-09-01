<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;
use App\Models\Notification;
use App\Models\User;
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
            'tanggal_mulai' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:' . \Carbon\Carbon::today()->addDays(2)->format('Y-m-d'),
            ],
            'tanggal_selesai' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:tanggal_mulai',
            ],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => ['required', 'date_format:H:i', 'after:waktu_mulai'],
            'jumlah_peserta' => ['required', 'integer', 'min:1', 'max:' . $venue->kapasitas],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ], [
            'tanggal_mulai.after_or_equal' => 'Reservasi harus dilakukan minimal 2 hari sebelum tanggal acara.',
        ]);

        $kodeBooking = 'BK-' . strtoupper(Str::random(8));

        $reservation = Reservation::create([
            'venue_id' => $venue->id,
            'user_id' => Auth::id(),
            'kode_booking' => $kodeBooking,
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'jumlah_peserta' => $validated['jumlah_peserta'],
            'keterangan' => $validated['keterangan'] ?? null,
            'status' => 'pending',
        ]);

        Notification::createNotification(
            Auth::id(),
            'Reservasi Berhasil Dibuat',
            'Reservasi ' . $kodeBooking . ' untuk ' . $venue->nama_venue . ' telah diajukan dan menunggu persetujuan.',
            'customer.reservations'
        );

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'Reservasi Baru',
                'Reservasi ' . $kodeBooking . ' untuk ' . $venue->nama_venue . ' menunggu persetujuan.',
                'admin.reservations.index',
                'warning',
                'bi-clock'
            );
        }

        if ($venue->owner_id) {
            Notification::createNotification(
                $venue->owner_id,
                'Reservasi Baru',
                'Venue ' . $venue->nama_venue . ' memiliki reservasi baru: ' . $kodeBooking,
                'owner.reservations.index',
                'warning',
                'bi-clock'
            );
        }

        return redirect()
            ->route('customer.venues.show', $venue->slug)
            ->with('success', 'Reservasi berhasil diajukan dan sedang menunggu persetujuan admin.');
    }
}