<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userFavoriteCount = Favorite::where('user_id', Auth::id())->count();

        $activeReservations = Reservation::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->where('tanggal_selesai', '>=', Carbon::today())
            ->count();

        $historyReservations = Reservation::where('user_id', Auth::id())
            ->count();

        $completedReservations = Reservation::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->where('tanggal_selesai', '<', Carbon::today())
            ->count();

        return view('customer.dashboard', compact(
            'userFavoriteCount',
            'activeReservations',
            'historyReservations',
            'completedReservations'
        ));
    }
}