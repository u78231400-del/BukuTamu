<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Notification;
use App\Models\VenueSchedule;
use App\Services\VenueScheduleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $conflictType = VenueScheduleService::checkApprovalConflict(
            $reservation->venue_id,
            $reservation->tanggal_mulai,
            $reservation->tanggal_selesai,
            $reservation->waktu_mulai,
            $reservation->waktu_selesai,
            $reservation->id
        );

        if ($conflictType === 'schedule') {
            return back()->with('error', 'Jadwal tidak dapat disetujui karena bentrok dengan jadwal venue yang diblokir oleh Owner.');
        }

        if ($conflictType === 'reservation') {
            return back()->with('error', 'Jadwal tidak dapat disetujui karena bentrok dengan reservasi lain yang sudah disetujui.');
        }

        try {
            DB::transaction(function () use ($reservation) {
                $reservation->update(['status' => 'approved']);

                $existingSchedule = VenueSchedule::where('reservation_id', $reservation->id)
                    ->where('jenis', 'online')
                    ->first();

                if (!$existingSchedule) {
                    VenueSchedule::create([
                        'venue_id' => $reservation->venue_id,
                        'owner_id' => $reservation->venue->owner_id,
                        'reservation_id' => $reservation->id,
                        'judul' => $reservation->venue->nama_venue . ' - ' . $reservation->kode_booking,
                        'jenis' => 'online',
                        'tanggal_mulai' => $reservation->tanggal_mulai,
                        'tanggal_selesai' => $reservation->tanggal_selesai,
                        'waktu_mulai' => $reservation->waktu_mulai,
                        'waktu_selesai' => $reservation->waktu_selesai,
                        'keterangan' => $reservation->keterangan,
                    ]);
                }

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
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses approval: ' . $e->getMessage());
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