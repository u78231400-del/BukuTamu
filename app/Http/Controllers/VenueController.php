<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::where('status', 'available')->get();

        $favoriteVenueIds = Favorite::where('user_id', Auth::id())
            ->pluck('venue_id')
            ->toArray();

        return view(
            'customer.venues.index',
            compact('venues', 'favoriteVenueIds')
        );
    }

    public function show($slug)
    {
        $venue = Venue::where('slug', $slug)->firstOrFail();

        $isFavorite = Favorite::where('user_id', Auth::id())
            ->where('venue_id', $venue->id)
            ->exists();

        return view(
            'customer.venues.show',
            compact('venue', 'isFavorite')
        );
    }
}

