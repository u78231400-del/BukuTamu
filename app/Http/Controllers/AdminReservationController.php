<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class AdminReservationController extends Controller
{
    /**
     * Menampilkan semua reservasi untuk admin
     */
    public function index()
    {
        $reservations = Reservation::with(['venue', 'user'])
            ->latest()
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Menyetujui reservasi
     */
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with(
                'error',
                'Reservasi ini sudah diproses.'
            );
        }

        $reservation->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Reservasi ' . $reservation->kode_booking . ' berhasil disetujui.'
        );
    }

    /**
     * Menolak reservasi
     */
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with(
                'error',
                'Reservasi ini sudah diproses.'
            );
        }

        $reservation->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Reservasi ' . $reservation->kode_booking . ' berhasil ditolak.'
        );
    }
}