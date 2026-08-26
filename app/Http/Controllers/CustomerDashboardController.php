<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userFavoriteCount = Favorite::where('user_id', Auth::id())->count();

        $activeReservations = Reservation::where('user_id', Auth::id())
            ->whereIn('status', ['pending'])
            ->count();

        $historyReservations = Reservation::where('user_id', Auth::id())
            ->count();

        $completedReservations = Reservation::where('user_id', Auth::id())
            ->whereIn('status', ['approved'])
            ->count();

        return view('customer.dashboard', compact(
            'userFavoriteCount',
            'activeReservations',
            'historyReservations',
            'completedReservations'
        ));
    }
}