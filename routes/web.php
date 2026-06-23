<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/cancel', [DashboardController::class, 'cancelOwnBooking'])->name('bookings.cancel');
    Route::get('/available-slots', [BookingController::class, 'getAvailableSlots'])->name('slots.available');

    // Admin Routes
    Route::middleware(['can:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');
        Route::post('/blocked-dates', [AdminController::class, 'blockDate'])->name('blocked-dates.store');
        Route::delete('/blocked-dates/{blockedDate}', [AdminController::class, 'unblockDate'])->name('blocked-dates.delete');
    });
});

require __DIR__.'/auth.php';
