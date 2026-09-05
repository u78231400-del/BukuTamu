<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\VenueSchedule;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () use ($reservation) {
            $reservation->update(['status' => 'approved']);

            if (!$reservation->schedule) {
                VenueSchedule::create([
                    'venue_id' => $reservation->venue_id,
                    'owner_id' => $reservation->venue->owner_id,
                    'reservation_id' => $reservation->id,
                    'judul' => 'Reservasi Online - ' . $reservation->kode_booking,
                    'jenis' => 'online',
                    'tanggal_mulai' => $reservation->tanggal_mulai,
                    'tanggal_selesai' => $reservation->tanggal_selesai,
                    'waktu_mulai' => $reservation->waktu_mulai,
                    'waktu_selesai' => $reservation->waktu_selesai,
                    'keterangan' => 'Jadwal otomatis dari reservasi online ' . $reservation->kode_booking,
                ]);
            }

            $conflictingReservations = Reservation::where('venue_id', $reservation->venue_id)
                ->where('id', '!=', $reservation->id)
                ->where('status', 'pending')
                ->where(function ($query) use ($reservation) {
                    $query->where(function ($q) use ($reservation) {
                        $q->where('tanggal_mulai', '<=', $reservation->tanggal_selesai)
                          ->where('tanggal_selesai', '>=', $reservation->tanggal_mulai);
                    });
                })
                ->where(function ($query) use ($reservation) {
                    $query->where(function ($q) use ($reservation) {
                        $q->where('tanggal_mulai', $reservation->tanggal_mulai)
                          ->where('waktu_mulai', '<', $reservation->waktu_selesai)
                          ->where('waktu_selesai', '>', $reservation->waktu_mulai);
                    })
                    ->orWhere(function ($q) use ($reservation) {
                        $q->where('tanggal_mulai', '>', $reservation->tanggal_mulai)
                          ->where('tanggal_mulai', '<=', $reservation->tanggal_selesai)
                          ->where('waktu_mulai', '<', $reservation->waktu_selesai)
                          ->where('waktu_selesai', '>', $reservation->waktu_mulai);
                    })
                    ->orWhere(function ($q) use ($reservation) {
                        $q->where('tanggal_selesai', '<', $reservation->tanggal_selesai)
                          ->where('tanggal_selesai', '>=', $reservation->tanggal_mulai)
                          ->where('waktu_mulai', '<', $reservation->waktu_selesai)
                          ->where('waktu_selesai', '>', $reservation->waktu_mulai);
                    })
                    ->orWhere(function ($q) use ($reservation) {
                        $q->where('tanggal_mulai', '<', $reservation->tanggal_mulai)
                          ->where('tanggal_selesai', '>', $reservation->tanggal_selesai)
                          ->where('waktu_mulai', '<', $reservation->waktu_selesai)
                          ->where('waktu_selesai', '>', $reservation->waktu_mulai);
                    });
                })
                ->with(['venue', 'user'])
                ->get();

            foreach ($conflictingReservations as $conflicting) {
                $conflicting->update(['status' => 'rejected']);

                Notification::createNotification(
                    $conflicting->user_id,
                    'Reservasi Ditolak',
                    'Reservasi ' . $conflicting->kode_booking . ' untuk ' . $conflicting->venue->nama_venue . ' tidak dapat diproses karena jadwal yang dipilih sudah tidak tersedia. Reservasi lain pada venue tersebut telah disetujui.',
                    'customer.reservations',
                    'danger',
                    'bi-x-circle'
                );
            }
        });

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
