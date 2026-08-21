<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::where('status', 'available')->get();

        // Diubah menjadi customer.venues.index
        return view('customer.venues.index', compact('venues'));
    }
    public function show($slug)
    {
        $venue = Venue::where('slug', $slug)->firstOrFail();

        return view('customer.venues.show', compact('venue'));
    }
}