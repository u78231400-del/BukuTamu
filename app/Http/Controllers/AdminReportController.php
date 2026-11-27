<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $totalVenue = Venue::count();
        $totalOwner = User::where('role', 'owner')->count();
        $totalCustomer = User::where('role', 'customer')->count();
        $totalReservation = Reservation::count();
        $reservationPending = Reservation::where('status', 'pending')->count();
        $reservationApproved = Reservation::where('status', 'approved')->count();
        $reservationRejected = Reservation::where('status', 'rejected')->count();
        $reservationCanceled = Reservation::where('status', 'canceled')->count();
        $venueAvailable = Venue::where('status', 'available')->count();

        $query = Reservation::with(['venue', 'user']);

        if ($request->has('tanggal_mulai') && $request->tanggal_mulai) {
            $query->where('tanggal_mulai', '>=', Carbon::parse($request->tanggal_mulai)->format('Y-m-d'));
        }

        if ($request->has('tanggal_akhir') && $request->tanggal_akhir) {
            $query->where('tanggal_selesai', '<=', Carbon::parse($request->tanggal_akhir)->format('Y-m-d'));
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('venue_id') && $request->venue_id) {
            $query->where('venue_id', $request->venue_id);
        }

        $reservations = $query->latest()->get();
        $venues = Venue::orderBy('nama_venue')->get();

        $stats = [
            'totalVenue' => $totalVenue,
            'totalOwner' => $totalOwner,
            'totalCustomer' => $totalCustomer,
            'totalReservation' => $totalReservation,
            'reservationPending' => $reservationPending,
            'reservationApproved' => $reservationApproved,
            'reservationRejected' => $reservationRejected,
            'reservationCanceled' => $reservationCanceled,
            'venueAvailable' => $venueAvailable,
        ];

        return view('admin.reports.index', compact(
            'stats',
            'reservations',
            'venues'
        ));
    }
}
