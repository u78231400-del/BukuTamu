<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Tambahkan venue ke favorit
     */
    public function store($venueId)
    {
        $venue = Venue::findOrFail($venueId);

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'venue_id' => $venue->id,
        ]);

        return back()->with(
            'success',
            'Venue berhasil ditambahkan ke favorit.'
        );
    }

    /**
     * Hapus venue dari favorit
     */
    public function destroy($venueId)
    {
        Favorite::where('user_id', Auth::id())
            ->where('venue_id', $venueId)
            ->delete();

        return back()->with(
            'success',
            'Venue berhasil dihapus dari favorit.'
        );
    }
}
