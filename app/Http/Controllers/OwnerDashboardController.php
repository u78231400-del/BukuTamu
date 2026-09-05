<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Reservation;
use App\Models\VenueSchedule;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $venues = Venue::where('owner_id', Auth::id())->get();

        $reservations = Reservation::whereHas('venue', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        $activeSchedulesCount = VenueSchedule::where('owner_id', Auth::id())->count();

        return view('owner.dashboard', compact('venues', 'reservations', 'activeSchedulesCount'));
    }
}