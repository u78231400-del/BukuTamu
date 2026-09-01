<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua venue milik Owner yang sedang login
        $venues = Venue::where('owner_id', Auth::id())->get();

        // Ambil semua reservasi yang masuk ke venue milik Owner
        $reservations = Reservation::whereHas('venue', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        return view('owner.dashboard', compact('venues', 'reservations'));
    }
}