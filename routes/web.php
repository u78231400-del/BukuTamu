<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('dashboard');
    Route::get('/bukutamu/export', [TamuController::class, 'export'])->name('buku-tamu.export');
    Route::get('/bukutamu/{id}/edit', [TamuController::class, 'edit'])->name('buku-tamu.edit');
    Route::put('/bukutamu/{id}', [TamuController::class, 'update'])->name('buku-tamu.update');
    Route::delete('/bukutamu/{id}', [TamuController::class, 'destroy'])->name('buku-tamu.destroy');
});

// Public routes (tidak butuh login)
Route::get('/bukutamu', [TamuController::class, 'index']);
Route::post('/bukutamu', [TamuController::class, 'store']);
Route::get('/buat-janji', [AppointmentController::class, 'create']);
Route::post('/buat-janji', [AppointmentController::class, 'store']);

// Protected appointment routes
Route::middleware('auth')->group(function () {
    Route::post('/appointment/{id}/approve', [AppointmentController::class, 'approve'])->name('appointment.approve');
    Route::post('/appointment/{id}/reject', [AppointmentController::class, 'reject'])->name('appointment.reject');
    Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});
