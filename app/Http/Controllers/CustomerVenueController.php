<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;

class CustomerVenueController extends Controller
{
    public function index()
    {
        $query = Venue::where('status', 'available');

        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_venue', 'like', '%' . $search . '%')
                  ->orWhere('lokasi', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        if (request()->has('lokasi') && request('lokasi') !== '') {
            $query->where('lokasi', request('lokasi'));
        }

        $venues = $query->get();

        $favoriteVenueIds = [];
        if (Auth::check()) {
            $favoriteVenueIds = Favorite::where('user_id', Auth::id())
                ->pluck('venue_id')
                ->toArray();
        }

        return view('customer.venues.index', compact('venues', 'favoriteVenueIds'));
    }

    public function show($slug)
    {
        $venue = Venue::where('slug', $slug)
            ->where('status', 'available')
            ->firstOrFail();

        $isFavorite = false;

        if (Auth::check()) {
            $isFavorite = Favorite::where('user_id', Auth::id())
                ->where('venue_id', $venue->id)
                ->exists();
        }

        return view('customer.venues.show', compact('venue', 'isFavorite'));
    }
}
