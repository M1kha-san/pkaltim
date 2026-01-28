<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;

/*
|--------------------------------------------------------------------------
| BAGIAN PUBLIC (PENGUNJUNG)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'landing'])->name('landing');

// Halaman List Wisata (URL: /destination)
Route::get('/destination', [PublicController::class, 'index'])->name('destination.index');

// Halaman Detail Wisata (URL: /destination/nama-slug)
Route::get('/destination/{slug}', [PublicController::class, 'show'])->name('destination.show');

// Kirim Review
Route::post('/review/{id}', [PublicController::class, 'storeReview'])->name('review.store');

/*
|--------------------------------------------------------------------------
| BAGIAN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| BAGIAN ADMIN
|--------------------------------------------------------------------------
| Menggunakan prefix 'admin' dan name 'admin.'
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // 1. Dashboard Admin
    // URL Browser: http://127.0.0.1:8000/admin/dashboard
    // Route Name: admin.dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Kelola Destinasi (CRUD)
    // URL Browser: http://127.0.0.1:8000/admin/destinations
    // Route Name: admin.destinations.index (dan turunannya)
    Route::resource('admin/destinations', DestinationController::class);

});