<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\VerhuurderHuisController;
use App\Http\Controllers\VerhuurderDashboardController;

// Homepage Route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Huizen Routes 
Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index');
Route::get('/huizen/{id}', [HuizenController::class, 'show'])->name('huizen.show');

// Contact Routes 
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Verhuurder Routes 
Route::middleware('auth')->group(function () {
    Route::get('/verhuurder/dashboard', [VerhuurderDashboardController::class, 'index'])->name('verhuurder.dashboard');
    Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index');
    Route::get('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show');
});

// Reserveringen Routes
Route::middleware('auth')->group(function () {
    Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index');
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
    Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show');
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
});

// Favorieten Routes
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [HuizenController::class, 'favorites'])->name('favorieten.index');
    Route::post('/favorieten/toevoegen', [HuizenController::class, 'addFavorite'])->name('favorieten.toevoegen');
    Route::delete('/favorieten/verwijderen/{id}', [HuizenController::class, 'removeFavorite'])->name('favorieten.verwijderen');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes
require __DIR__ . '/auth.php';
