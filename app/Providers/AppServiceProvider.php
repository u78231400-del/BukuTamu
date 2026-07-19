<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Appointment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');

        View::composer('layouts.app', function ($view) {
            $pendingCount = 0;
            if (auth()->check()) {
                $pendingCount = Appointment::where('status', 'menunggu')->count();
            }
            $view->with('pendingCount', $pendingCount);
        });
    }
}
