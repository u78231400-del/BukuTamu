<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userFavoriteCount = Favorite::where('user_id', Auth::id())->count();

        return view('customer.dashboard', compact('userFavoriteCount'));
    }
}