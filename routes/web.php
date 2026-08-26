<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminVenueController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;


// ==========================================
// PREVIEW
// ==========================================

Route::get('/preview', function () {
    return view('welcome');
});


// ==========================================
// AUTH
// ==========================================

Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    AuthController::class,
    'login'
]);

Route::get('/register', [
    RegisterController::class,
    'showRegister'
])->name('register');

Route::post('/register', [
    RegisterController::class,
    'register'
]);

Route::post('/logout', [
    AuthController::class,
    'logout'
])->name('logout');


// ==========================================
// HOME
// ==========================================

Route::get('/', function () {

    if (auth()->check()) {

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    return redirect()->route('login');

});


// ==========================================
// CUSTOMER
// ==========================================

Route::middleware('auth')->group(function () {

    // Customer Dashboard
    Route::get('/customer/dashboard', [
        CustomerDashboardController::class,
        'index'
    ])->name('customer.dashboard');


    // Daftar Venue
    Route::get('/customer/venues', [
        VenueController::class,
        'index'
    ])->name('customer.venues');


    // Detail Venue
    Route::get('/customer/venues/{slug}', [
        VenueController::class,
        'show'
    ])->name('customer.venues.show');


    // Buat Reservasi
    Route::post('/customer/venues/{slug}/reservasi', [
        ReservationController::class,
        'store'
    ])->name('customer.reservations.store');


    // Riwayat Reservasi Customer
    Route::get('/customer/reservations', [
        ReservationController::class,
        'index'
    ])->name('customer.reservations');

    // Favorit Customer
    Route::post('/customer/favorites/{venueId}', [
        FavoriteController::class,
        'store'
    ])->name('customer.favorites.store');

    Route::delete('/customer/favorites/{venueId}', [
        FavoriteController::class,
        'destroy'
    ])->name('customer.favorites.destroy');

});


// ==========================================
// ADMIN
// ==========================================

Route::middleware('auth')->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', [
        AdminDashboardController::class,
        'index'
    ])->name('admin.dashboard');


    // Admin Venue
    Route::get('/admin/venues', [
        AdminVenueController::class,
        'index'
    ])->name('admin.venues.index');

    Route::get('/admin/venues/create', [
        AdminVenueController::class,
        'create'
    ])->name('admin.venues.create');

    Route::post('/admin/venues', [
        AdminVenueController::class,
        'store'
    ])->name('admin.venues.store');

    Route::get('/admin/venues/{id}/edit', [
        AdminVenueController::class,
        'edit'
    ])->name('admin.venues.edit');

    Route::put('/admin/venues/{id}', [
        AdminVenueController::class,
        'update'
    ])->name('admin.venues.update');

    Route::delete('/admin/venues/{id}', [
        AdminVenueController::class,
        'destroy'
    ])->name('admin.venues.destroy');

    Route::post('/admin/venues/{id}/activate', [
        AdminVenueController::class,
        'activate'
    ])->name('admin.venues.activate');

    // Admin Reservations
    Route::get('/admin/reservations', [
        AdminReservationController::class,
        'index'
    ])->name('admin.reservations.index');


    // Approve Reservation
    Route::post('/admin/reservations/{id}/approve', [
        AdminReservationController::class,
        'approve'
    ])->name('admin.reservations.approve');


    // Reject Reservation
    Route::post('/admin/reservations/{id}/reject', [
        AdminReservationController::class,
        'reject'
    ])->name('admin.reservations.reject');

});


// ==========================================
// BUKU TAMU
// ==========================================

Route::get('/bukutamu', [
    TamuController::class,
    'index'
]);

Route::post('/bukutamu', [
    TamuController::class,
    'store'
]);

Route::get('/bukutamu/{id}/edit', [
    TamuController::class,
    'edit'
])->name('buku-tamu.edit');

Route::put('/bukutamu/{id}', [
    TamuController::class,
    'update'
])->name('buku-tamu.update');

Route::delete('/bukutamu/{id}', [
    TamuController::class,
    'destroy'
])->name('buku-tamu.destroy');


// ==========================================
// ADMIN / EXISTING DASHBOARD BUKU TAMU
// ==========================================

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [
        TamuController::class,
        'dashboard'
    ])->name('dashboard');

    Route::get('/bukutamu/export', [
        TamuController::class,
        'export'
    ])->name('buku-tamu.export');

});


// ==========================================
// APPOINTMENT
// ==========================================

Route::get('/buat-janji', [
    AppointmentController::class,
    'create'
]);

Route::post('/buat-janji', [
    AppointmentController::class,
    'store'
]);

Route::get('/agenda', [
    AppointmentController::class,
    'agenda'
]);

Route::get('/buat-janji/export', [
    AppointmentController::class,
    'export'
]);

Route::get('/appointment/{id}/edit', [
    AppointmentController::class,
    'edit'
])->name('appointment.edit');

Route::put('/appointment/{id}', [
    AppointmentController::class,
    'update'
])->name('appointment.update');

Route::delete('/appointment/{id}', [
    AppointmentController::class,
    'destroy'
])->name('appointment.destroy');


// ==========================================
// ADMIN - APPOINTMENT ACTION
// ==========================================

Route::middleware('auth')->group(function () {

    Route::post('/appointment/{id}/approve', [
        AppointmentController::class,
        'approve'
    ])->name('appointment.approve');


    Route::post('/appointment/{id}/reject', [
        AppointmentController::class,
        'reject'
    ])->name('appointment.reject');

});
