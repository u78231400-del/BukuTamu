<?php

namespace App\Http\Controllers;

use App\Models\VenueSchedule;
use App\Models\Venue;
use App\Models\Reservation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerScheduleController extends Controller
{
    public function index()
    {
        $schedules = VenueSchedule::with('venue')
            ->where('owner_id', Auth::id())
            ->latest()
            ->get();

        $stats = [
            'total' => $schedules->count(),
            'online' => $schedules->where('jenis', 'online')->count(),
            'offline' => $schedules->where('jenis', 'offline')->count(),
            'internal' => $schedules->where('jenis', 'internal')->count(),
            'blocked' => $schedules->where('jenis', 'blocked')->count(),
        ];

        return view('owner.schedules.index', compact('schedules', 'stats'));
    }

    public function create()
    {
        $venues = Venue::where('owner_id', Auth::id())
            ->where('status', 'available')
            ->orderBy('nama_venue')
            ->get();

        return view('owner.schedules.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $venue = Venue::where('id', $request->venue_id)
            ->where('owner_id', Auth::id())
            ->first();

        if (!$venue) {
            return redirect()
                ->route('owner.schedules.create')
                ->with('error', 'Venue tidak valid.');
        }

        $validated = $request->validate([
            'venue_id' => ['required', 'integer'],
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:offline,internal,blocked,online'],
            'reservation_id' => ['nullable', 'integer'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => ['required', 'date_format:H:i', 'after:waktu_mulai'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama dengan atau setelah tanggal mulai.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);

        $conflictSchedule = VenueSchedule::checkConflict(
            $validated['venue_id'],
            $validated['tanggal_mulai'],
            $validated['tanggal_selesai'],
            $validated['waktu_mulai'],
            $validated['waktu_selesai']
        );

        if ($conflictSchedule) {
            return redirect()
                ->route('owner.schedules.create')
                ->withInput()
                ->with('error', 'Jadwal manual sudah bertabrakan dengan jadwal lain pada venue ini.');
        }

        $conflictingApproved = VenueSchedule::getConflictingReservations(
            $validated['venue_id'],
            $validated['tanggal_mulai'],
            $validated['tanggal_selesai'],
            $validated['waktu_mulai'],
            $validated['waktu_selesai']
        )->where('status', 'approved');

        if ($conflictingApproved->isNotEmpty()) {
            return redirect()
                ->route('owner.schedules.create')
                ->withInput()
                ->with('error', 'Jadwal tidak dapat dibuat karena venue sudah memiliki reservasi yang disetujui pada waktu tersebut.');
        }

        DB::transaction(function () use ($validated, $venue) {
            $conflictingPending = VenueSchedule::getConflictingReservations(
                $validated['venue_id'],
                $validated['tanggal_mulai'],
                $validated['tanggal_selesai'],
                $validated['waktu_mulai'],
                $validated['waktu_selesai']
            )->where('status', 'pending');

            VenueSchedule::create([
                'venue_id' => $validated['venue_id'],
                'owner_id' => Auth::id(),
                'reservation_id' => $validated['reservation_id'] ?? null,
                'judul' => $validated['judul'],
                'jenis' => $validated['jenis'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'waktu_mulai' => $validated['waktu_mulai'],
                'waktu_selesai' => $validated['waktu_selesai'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            foreach ($conflictingPending as $pending) {
                $pending->update(['status' => 'rejected']);

                Notification::createNotification(
                    $pending->user_id,
                    'Reservasi Ditolak',
                    'Reservasi ' . $pending->kode_booking . ' untuk ' . $pending->venue->nama_venue . ' tidak dapat diproses karena jadwal venue sudah digunakan/diblokir oleh owner.',
                    'customer.reservations',
                    'danger',
                    'bi-x-circle'
                );
            }
        });

        return redirect()
            ->route('owner.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = VenueSchedule::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $venues = Venue::where('owner_id', Auth::id())
            ->where('status', 'available')
            ->orderBy('nama_venue')
            ->get();

        return view('owner.schedules.edit', compact('schedule', 'venues'));
    }

    public function update(Request $request, $id)
    {
        $schedule = VenueSchedule::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $venue = Venue::where('id', $request->venue_id)
            ->where('owner_id', Auth::id())
            ->first();

        if (!$venue) {
            return redirect()
                ->route('owner.schedules.edit', $id)
                ->with('error', 'Venue tidak valid.');
        }

        $validated = $request->validate([
            'venue_id' => ['required', 'integer'],
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'in:offline,internal,blocked,online'],
            'reservation_id' => ['nullable', 'integer'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'waktu_mulai' => ['required', 'date_format:H:i'],
            'waktu_selesai' => ['required', 'date_format:H:i', 'after:waktu_mulai'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus sama dengan atau setelah tanggal mulai.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ]);

        if ($schedule->jenis === 'online') {
            return redirect()
                ->route('owner.schedules.index')
                ->with('error', 'Jadwal reservasi online tidak dapat diedit secara manual.');
        }

        $conflictSchedule = VenueSchedule::checkConflict(
            $validated['venue_id'],
            $validated['tanggal_mulai'],
            $validated['tanggal_selesai'],
            $validated['waktu_mulai'],
            $validated['waktu_selesai'],
            $schedule->id
        );

        if ($conflictSchedule) {
            return redirect()
                ->route('owner.schedules.edit', $id)
                ->withInput()
                ->with('error', 'Jadwal manual sudah bertabrakan dengan jadwal lain pada venue ini.');
        }

        $conflictingApproved = VenueSchedule::getConflictingReservations(
            $validated['venue_id'],
            $validated['tanggal_mulai'],
            $validated['tanggal_selesai'],
            $validated['waktu_mulai'],
            $validated['waktu_selesai'],
            $schedule->id
        )->where('status', 'approved');

        if ($conflictingApproved->isNotEmpty()) {
            return redirect()
                ->route('owner.schedules.edit', $id)
                ->withInput()
                ->with('error', 'Jadwal tidak dapat dibuat karena venue sudah memiliki reservasi yang disetujui pada waktu tersebut.');
        }

        DB::transaction(function () use ($validated, $schedule) {
            $schedule->update([
                'venue_id' => $validated['venue_id'],
                'reservation_id' => $validated['reservation_id'] ?? null,
                'judul' => $validated['judul'],
                'jenis' => $validated['jenis'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'waktu_mulai' => $validated['waktu_mulai'],
                'waktu_selesai' => $validated['waktu_selesai'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            $conflictingPending = VenueSchedule::getConflictingReservations(
                $validated['venue_id'],
                $validated['tanggal_mulai'],
                $validated['tanggal_selesai'],
                $validated['waktu_mulai'],
                $validated['waktu_selesai'],
                $schedule->id
            )->where('status', 'pending');

            foreach ($conflictingPending as $pending) {
                $pending->update(['status' => 'rejected']);

                Notification::createNotification(
                    $pending->user_id,
                    'Reservasi Ditolak',
                    'Reservasi ' . $pending->kode_booking . ' untuk ' . $pending->venue->nama_venue . ' tidak dapat diproses karena jadwal venue sudah digunakan/diblokir oleh owner.',
                    'customer.reservations',
                    'danger',
                    'bi-x-circle'
                );
            }
        });

        return redirect()
            ->route('owner.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = VenueSchedule::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        if ($schedule->jenis === 'online') {
            return redirect()
                ->route('owner.schedules.index')
                ->with('error', 'Jadwal reservasi online tidak dapat dihapus secara manual.');
        }

        $schedule->delete();

        return redirect()
            ->route('owner.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
