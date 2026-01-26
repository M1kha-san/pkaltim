<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
// GANTI INI: Panggil DashboardController
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::get('/', [PublicController::class, 'index'])->name('landing');

// LOGIN & LOGOUT
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD (Sekarang pakai DashboardController)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// CRUD DATA (Tetap arahkan ke DashboardController)
Route::post('/destinations', [DashboardController::class, 'store'])
    ->middleware('auth')
    ->name('destinations.store');

Route::delete('/destinations/{id}', [DashboardController::class, 'destroy'])
    ->middleware('auth')
    ->name('destinations.destroy');