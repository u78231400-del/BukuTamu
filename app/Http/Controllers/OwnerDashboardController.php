<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $venues = Venue::where('owner_id', Auth::id())->get();

        return view('owner.dashboard', compact('venues'));
    }
}