<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OwnerReportController extends Controller
{
    public function index(Request $request)
    {
        $ownerId = Auth::id();

        $ownerVenues = Venue::where('owner_id', $ownerId)->get();
        $totalVenue = $ownerVenues->count();
        $venueAvailable = $ownerVenues->where('status', 'available')->count();

        $venueIds = $ownerVenues->pluck('id');

        $query = Reservation::with(['venue', 'user'])
            ->whereIn('venue_id', $venueIds);

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

        $totalReservation = Reservation::whereIn('venue_id', $venueIds)->count();
        $reservationPending = Reservation::whereIn('venue_id', $venueIds)->where('status', 'pending')->count();
        $reservationApproved = Reservation::whereIn('venue_id', $venueIds)->where('status', 'approved')->count();
        $reservationRejected = Reservation::whereIn('venue_id', $venueIds)->where('status', 'rejected')->count();
        $reservationCanceled = Reservation::whereIn('venue_id', $venueIds)->where('status', 'canceled')->count();

        $stats = [
            'totalVenue' => $totalVenue,
            'venueAvailable' => $venueAvailable,
            'totalReservation' => $totalReservation,
            'reservationPending' => $reservationPending,
            'reservationApproved' => $reservationApproved,
            'reservationRejected' => $reservationRejected,
            'reservationCanceled' => $reservationCanceled,
        ];

        return view('owner.reports.index', compact(
            'stats',
            'reservations',
            'ownerVenues'
        ));
    }
}
