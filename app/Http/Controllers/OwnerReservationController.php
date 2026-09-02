<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OwnerReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::whereHas('venue', function ($query) {
            $query->where('owner_id', Auth::id());
        })
            ->with(['venue', 'user'])
            ->latest()
            ->get();

        return view('owner.reservations.index', compact('reservations'));
    }

    public function approve($id)
    {
        $reservation = Reservation::with(['venue', 'user'])
            ->whereHas('venue', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        $reservation->update(['status' => 'approved']);

        Notification::createNotification(
            $reservation->user_id,
            'Reservasi Disetujui',
            'Reservasi ' . $reservation->kode_booking . ' untuk ' . $reservation->venue->nama_venue . ' telah disetujui oleh pemilik venue.',
            'customer.reservations',
            'success',
            'bi-check-circle'
        );

        return back()->with('success', 'Reservasi ' . $reservation->kode_booking . ' berhasil disetujui.');
    }

    public function reject($id)
    {
        $reservation = Reservation::with(['venue', 'user'])
            ->whereHas('venue', function ($query) {
                $query->where('owner_id', Auth::id());
            })
            ->findOrFail($id);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        $reservation->update(['status' => 'rejected']);

        Notification::createNotification(
            $reservation->user_id,
            'Reservasi Ditolak',
            'Reservasi ' . $reservation->kode_booking . ' untuk ' . $reservation->venue->nama_venue . ' telah ditolak oleh pemilik venue.',
            'customer.reservations',
            'danger',
            'bi-x-circle'
        );

        return back()->with('success', 'Reservasi ' . $reservation->kode_booking . ' berhasil ditolak.');
    }
}
