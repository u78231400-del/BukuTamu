<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Venue;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalVenue = Venue::count();

        $venueAktif = Venue::where('status', 'available')->count();

        $totalReservasi = Reservation::count();

        $reservasiPending = Reservation::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalVenue',
            'venueAktif',
            'totalReservasi',
            'reservasiPending'
        ));
    }
}