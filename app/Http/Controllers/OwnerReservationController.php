<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
}
