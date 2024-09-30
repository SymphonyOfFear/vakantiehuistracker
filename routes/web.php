<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\RecensiesController;
use App\Http\Controllers\VerhuurderHuisController;
use App\Http\Controllers\VerhuurderDashboardController;
use App\Http\Controllers\FavorietenController;

// Homepage Route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Huizen Routes
Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index');
Route::get('/huizen/create', [HuizenController::class, 'create'])->name('huizen.create');
Route::post('/huizen', [HuizenController::class, 'store'])->name('huizen.store');
Route::get('/huizen/{id}', [HuizenController::class, 'show'])->name('huizen.show');
Route::get('/huizen/{id}/edit', [HuizenController::class, 'edit'])->name('huizen.edit');
Route::put('/huizen/{id}', [HuizenController::class, 'update'])->name('huizen.update');
Route::delete('/huizen/{id}', [HuizenController::class, 'destroy'])->name('huizen.destroy');

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Verhuurder Routes (Dashboard en Huizenbeheer)

// Routes for Verhuurder Huizen
Route::middleware('auth')->group(function () {
    Route::get('/verhuurder/dashboard', [VerhuurderHuisController::class, 'dashboard'])->name('verhuurder.dashboard'); // Verhuurder Dashboard
    Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index'); // Beheer huizen
    Route::get('/verhuurder/huizen/toevoegen', [VerhuurderHuisController::class, 'create'])->name('verhuurder.huizen.toevoegen'); // Voeg nieuw huis toe
    Route::post('/verhuurder/huizen', [VerhuurderHuisController::class, 'store'])->name('verhuurder.huizen.store'); // Sla nieuw huis op
    Route::get('/verhuurder/huizen/{huisje}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show'); // Toon details van een huis
    Route::get('/verhuurder/huizen/{huisje}/bewerken', [VerhuurderHuisController::class, 'edit'])->name('verhuurder.huizen.bewerken'); // Bewerk een huis
    Route::put('/verhuurder/huizen/{huisje}', [VerhuurderHuisController::class, 'update'])->name('verhuurder.huizen.update'); // Update een huis
    Route::delete('/verhuurder/huizen/{huisje}', [VerhuurderHuisController::class, 'destroy'])->name('verhuurder.huizen.destroy'); // Verwijder een huis
});


// Reserveringen Routes
Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index');
Route::get('/reserveringen/create', [ReserveringenController::class, 'create'])->name('reserveringen.create');
Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show');
Route::get('/reserveringen/{id}/edit', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');

// Recensies Routes
// Route::get('/recensies', [RecensiesController::class, 'index'])->name('recensies.index');
// Route::post('/recensies', [RecensiesController::class, 'store'])->name('recensies.store');
// Route::get('/recensies/respond', [RecensiesController::class, 'respond'])->name('recensies.respond');

// Favorieten Routes
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten.index');
    Route::post('/favorieten', [FavorietenController::class, 'store'])->name('favorieten.store');
    Route::delete('/favorieten/{id}', [FavorietenController::class, 'destroy'])->name('favorieten.destroy');
});

// Profile Routes (In English, default Laravel)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
