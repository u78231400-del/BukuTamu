<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar venue favorit customer
     */
    public function index()
    {
        $favorites = Favorite::with('venue')
            ->where('user_id', Auth::id())
            ->get();

        return view('customer.favorites.index', compact('favorites'));
    }

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

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Venue berhasil ditambahkan ke favorit.'
            ]);
        }

        return back()->with('success', 'Venue berhasil ditambahkan ke favorit.');
    }

    /**
     * Hapus venue dari favorit
     */
    public function destroy($venueId)
    {
        Favorite::where('user_id', Auth::id())
            ->where('venue_id', $venueId)
            ->delete();

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Venue berhasil dihapus dari favorit.'
            ]);
        }

        return back()->with('success', 'Venue berhasil dihapus dari favorit.');
    }
}
