<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MakananController as AdminMakananController;
use App\Http\Controllers\Admin\RumahMakanController;

// Route untuk halaman utama public
Route::get('/', [MakananController::class, 'home'])->name('home');
Route::get('/kuliner', [MakananController::class, 'index'])->name('kuliner.index');
Route::get('/kuliner/{id}', [MakananController::class, 'show'])->name('kuliner.show');
Route::post('/review-public', [MakananController::class, 'storeReview'])->name('review.public.store');

// Redirect ke dashboard admin setelah login
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Makanan
    Route::resource('makanan', AdminMakananController::class);
    // Custom Route: Attach & Detach Rumah Makan ke Makanan
    Route::post('/makanan/{makanan}/attach', [AdminMakananController::class, 'attachRumahMakan'])->name('makanan.attach');
    Route::delete('/makanan/{makanan}/rumah-makan/{rumahMakanId}', [AdminMakananController::class, 'destroyRumahMakan'])->name('makanan.rumah-makan.destroy');

    // CRUD Rumah Makan
    Route::resource('rumah-makan', RumahMakanController::class);
    // Custom Route: Review Manual dari Admin
    Route::post('/rumah-makan/{rumah_makan}/review', [RumahMakanController::class, 'storeReview'])->name('rumah-makan.review.store');
    Route::delete('/review/{review}', [RumahMakanController::class, 'destroyReview'])->name('review.destroy');
});

require __DIR__ . '/auth.php';
