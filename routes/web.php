<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ReservationController;

// ==========================================
// PREVIEW
// ==========================================

Route::get('/preview', function () {
    return view('welcome');
});

// ==========================================
// AUTH
// ==========================================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// ==========================================
// HOME
// ==========================================

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('login');
});


// ==========================================
// CUSTOMER
// ==========================================

Route::middleware('auth')->group(function () {

    Route::get('/customer/dashboard', [
        CustomerDashboardController::class,
        'index'
    ])->name('customer.dashboard');

    Route::get('/customer/venues', [
        VenueController::class,
        'index'
    ])->name('customer.venues');

    Route::get('/customer/venues/{slug}', [
        VenueController::class,
        'show'
    ])->name('customer.venues.show');

    Route::post('/customer/venues/{slug}/reservasi', [
        ReservationController::class,
        'store'
    ])->name('customer.reservations.store');

    Route::get('/customer/reservations', [
    ReservationController::class,
    'index'
])->name('customer.reservations');
});


// ==========================================
// ADMIN / EXISTING DASHBOARD
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
