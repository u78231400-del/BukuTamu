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
use App\Http\Controllers\CustomerVenueController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\OwnerVenueController;
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\OwnerReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MessageController;

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
// HOME / LANDING PAGE
// ==========================================

Route::get('/', function () {
    $venues = \App\Models\Venue::where('status', 'available')
        ->latest()
        ->take(4)
        ->get();

    return view('welcome', compact('venues'));
});


// ==========================================
// PUBLIC VENUE
// ==========================================

// Bisa diakses tanpa login
Route::get('/venues', [
    VenueController::class,
    'index'
])->name('venues.index');

// Bisa diakses tanpa login
Route::get('/venues/{slug}', [
    VenueController::class,
    'show'
])->name('venues.show');


// ==========================================
// CUSTOMER - AUTH REQUIRED
// ==========================================

Route::middleware('auth')->group(function () {

    // --------------------------------------
    // Customer Dashboard
    // --------------------------------------

    Route::get('/customer/dashboard', [
        CustomerDashboardController::class,
        'index'
    ])->name('customer.dashboard');


    // --------------------------------------
    // Customer Venue
    // --------------------------------------

    Route::get('/customer/venues', [
        CustomerVenueController::class,
        'index'
    ])->name('customer.venues');

    Route::get('/customer/venues/{slug}', [
        CustomerVenueController::class,
        'show'
    ])->name('customer.venues.show');


    // --------------------------------------
    // Customer Profile (redirects to shared profile)
    // --------------------------------------

    Route::get('/customer/profile', function () {
        return redirect()->route('profile.index');
    })->name('customer.profile');

    Route::put('/customer/profile', function () {
        return redirect()->route('profile.update');
    })->name('customer.profile.update');


    // --------------------------------------
    // Customer Reservation
    // --------------------------------------

    Route::post('/customer/venues/{slug}/reservasi', [
        ReservationController::class,
        'store'
    ])->name('customer.reservations.store');


    Route::get('/customer/reservations', [
        ReservationController::class,
        'index'
    ])->name('customer.reservations');


    // --------------------------------------
    // Customer Favorite
    // --------------------------------------

    Route::get('/customer/favorites', [
        FavoriteController::class,
        'index'
    ])->name('customer.favorites');

    Route::post('/customer/favorites/{venueId}', [
        FavoriteController::class,
        'store'
    ])->name('customer.favorites.store');

    Route::delete('/customer/favorites/{venueId}', [
        FavoriteController::class,
        'destroy'
    ])->name('customer.favorites.destroy');

    // --------------------------------------
    // Notifications
    // --------------------------------------

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

    // --------------------------------------
    // Messages
    // --------------------------------------

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');

});


// ==========================================
// PROFILE - SHARED FOR ALL ROLES
// ==========================================

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ==========================================
// ADMIN
// ==========================================

Route::middleware(['auth', 'admin'])->group(function () {

    // --------------------------------------
    // Admin Dashboard
    // --------------------------------------

    Route::get('/admin/dashboard', [
        AdminDashboardController::class,
        'index'
    ])->name('admin.dashboard');


    // --------------------------------------
    // Admin Venue
    // --------------------------------------

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


    // --------------------------------------
    // Admin Reservations
    // --------------------------------------

    Route::get('/admin/reservations', [
        AdminReservationController::class,
        'index'
    ])->name('admin.reservations.index');



    Route::post('/admin/reservations/{id}/approve', [
        AdminReservationController::class,
        'approve'
    ])->name('admin.reservations.approve');



    Route::post('/admin/reservations/{id}/reject', [
        AdminReservationController::class,
        'reject'
    ])->name('admin.reservations.reject');

    // --------------------------------------
    // Admin Owner
    // --------------------------------------

    Route::get('/admin/owners', [
        AdminOwnerController::class,
        'index'
    ])->name('admin.owners.index');

    Route::get('/admin/owners/create', [
        AdminOwnerController::class,
        'create'
    ])->name('admin.owners.create');

    Route::post('/admin/owners', [
        AdminOwnerController::class,
        'store'
    ])->name('admin.owners.store');

    // Admin Profile (redirects to shared profile)
    Route::get('/admin/profile', function () {
        return redirect()->route('profile.index');
    })->name('admin.profile');

    Route::put('/admin/profile', function () {
        return redirect()->route('profile.update');
    })->name('admin.profile.update');

});

// ==========================================
// OWNER
// ==========================================
Route::middleware(['auth', 'owner'])->group(function () {

    // --------------------------------------
    // Owner Dashboard
    // --------------------------------------

    Route::get('/owner/dashboard', [
        OwnerDashboardController::class,
        'index'
    ])->name('owner.dashboard');


    // --------------------------------------
    // Owner Venue
    // --------------------------------------

    Route::get('/owner/venues', [
        OwnerVenueController::class,
        'index'
    ])->name('owner.venues.index');

    Route::get('/owner/venues/create', [
        OwnerVenueController::class,
        'create'
    ])->name('owner.venues.create');

    Route::get('/owner/venues/{id}', [
        OwnerVenueController::class,
        'show'
    ])->name('owner.venues.show');

    Route::post('/owner/venues', [
        OwnerVenueController::class,
        'store'
    ])->name('owner.venues.store');

    Route::get('/owner/venues/{id}/edit', [
        OwnerVenueController::class,
        'edit'
    ])->name('owner.venues.edit');

    Route::put('/owner/venues/{id}', [
        OwnerVenueController::class,
        'update'
    ])->name('owner.venues.update');

    Route::delete('/owner/venues/{id}', [
        OwnerVenueController::class,
        'destroy'
    ])->name('owner.venues.destroy');

    Route::get('/owner/reservations', [
        OwnerReservationController::class,
        'index'
    ])->name('owner.reservations.index');

    Route::post('/owner/reservations/{id}/approve', [
        OwnerReservationController::class,
        'approve'
    ])->name('owner.reservations.approve');

    Route::post('/owner/reservations/{id}/reject', [
        OwnerReservationController::class,
        'reject'
    ])->name('owner.reservations.reject');

    // Owner Profile (redirects to shared profile)
    Route::get('/owner/profile', function () {
        return redirect()->route('profile.index');
    })->name('owner.profile');

    Route::put('/owner/profile', function () {
        return redirect()->route('profile.update');
    })->name('owner.profile.update');

});

// ==========================================
// BUKU TAMU - LEGACY
// ==========================================

// Halaman Buku Tamu lama
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
// LEGACY DASHBOARD BUKU TAMU
// ==========================================

Route::middleware(['auth', 'admin'])->group(function () {

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

Route::middleware(['auth', 'admin'])->group(function () {

    Route::post('/appointment/{id}/approve', [
        AppointmentController::class,
        'approve'
    ])->name('appointment.approve');


    Route::post('/appointment/{id}/reject', [
        AppointmentController::class,
        'reject'
    ])->name('appointment.reject');

});
