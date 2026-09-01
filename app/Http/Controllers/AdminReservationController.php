<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['venue', 'user'])
            ->latest()
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function approve($id)
    {
        $reservation = Reservation::with(['venue', 'user'])->findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        $reservation->update(['status' => 'approved']);

        Notification::createNotification(
            $reservation->user_id,
            'Reservasi Disetujui',
            'Reservasi ' . $reservation->kode_booking . ' untuk ' . $reservation->venue->nama_venue . ' telah disetujui.',
            'customer.reservations',
            'success',
            'bi-check-circle'
        );

        if ($reservation->venue->owner_id) {
            Notification::createNotification(
                $reservation->venue->owner_id,
                'Reservasi Disetujui',
                'Reservasi ' . $reservation->kode_booking . ' untuk venue ' . $reservation->venue->nama_venue . ' telah disetujui oleh admin.',
                'owner.reservations.index',
                'success',
                'bi-check-circle'
            );
        }

        return back()->with('success', 'Reservasi ' . $reservation->kode_booking . ' berhasil disetujui.');
    }

    public function reject($id)
    {
        $reservation = Reservation::with(['venue', 'user'])->findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        $reservation->update(['status' => 'rejected']);

        Notification::createNotification(
            $reservation->user_id,
            'Reservasi Ditolak',
            'Reservasi ' . $reservation->kode_booking . ' untuk ' . $reservation->venue->nama_venue . ' telah ditolak.',
            'customer.reservations',
            'danger',
            'bi-x-circle'
        );

        if ($reservation->venue->owner_id) {
            Notification::createNotification(
                $reservation->venue->owner_id,
                'Reservasi Ditolak',
                'Reservasi ' . $reservation->kode_booking . ' untuk venue ' . $reservation->venue->nama_venue . ' telah ditolak oleh admin.',
                'owner.reservations.index',
                'danger',
                'bi-x-circle'
            );
        }

        return back()->with('success', 'Reservasi ' . $reservation->kode_booking . ' berhasil ditolak.');
    }
}