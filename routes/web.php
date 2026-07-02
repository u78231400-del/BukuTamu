<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TamuController;

Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('dashboard');
Route::get('/bukutamu/export', [TamuController::class, 'export'])->name('buku-tamu.export');
Route::get('/bukutamu', [TamuController::class, 'index']);
Route::post('/bukutamu', [TamuController::class, 'store']);

Route::get('/bukutamu/{id}/edit', [TamuController::class, 'edit'])->name('buku-tamu.edit');
Route::put('/bukutamu/{id}', [TamuController::class, 'update'])->name('buku-tamu.update');
Route::delete('/bukutamu/{id}', [TamuController::class, 'destroy'])->name('buku-tamu.destroy');