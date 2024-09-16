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
Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index'); // Overzicht van huizen
Route::get('/huizen/search', [HuizenController::class, 'search'])->name('huizen.search'); // Zoekfunctie
Route::get('/huizen/{id}', [HuizenController::class, 'show'])->name('huizen.show'); // Details van een huis

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index'); // Contactpagina

// Verhuurder Routes (Dashboard en Huizenbeheer)
Route::get('/verhuurder/dashboard', [VerhuurderDashboardController::class, 'index'])->name('verhuurder.dashboard');
Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index'); // Overzicht van huizen
Route::get('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show'); // Details van een huis

// Routes for adding and editing vacation houses
Route::get('/verhuurder/huis/toevoegen', [VerhuurderHuisController::class, 'create'])->name('verhuurder.huis.toevoegen'); // Voeg een huis toe
Route::post('/verhuurder/huis/toevoegen', [VerhuurderHuisController::class, 'store'])->name('verhuurder.huis.store'); // Sla nieuw huis op
Route::get('/verhuurder/huis/bewerken/{id}', [VerhuurderHuisController::class, 'edit'])->name('verhuurder.huis.bewerken'); // Bewerk een huis
Route::put('/verhuurder/huis/bewerken/{id}', [VerhuurderHuisController::class, 'update'])->name('verhuurder.huis.update'); // Sla wijzigingen op

// Reserveringen Routes
Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index'); // Overzicht van reserveringen
Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store'); // Nieuwe reservering maken
Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show'); // Reservering details
Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy'); // Verwijder reservering

// Favorieten Routes (in Dutch)
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [HuizenController::class, 'favorites'])->name('favorieten.index'); // Toon alle favorieten
    Route::post('/favorieten/toevoegen', [HuizenController::class, 'addFavorite'])->name('favorieten.toevoegen'); // Voeg een huis toe aan favorieten
    Route::delete('/favorieten/verwijderen/{id}', [HuizenController::class, 'removeFavorite'])->name('favorieten.verwijderen'); // Verwijder een huis van favorieten
});

// Profile Routes (in English)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index'); // Show profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
});

// Beschikbaarheid Routes (in Dutch)
Route::middleware('auth')->group(function () {
    Route::get('/verhuurder/huizen/{id}/beschikbaarheid', [VerhuurderHuisController::class, 'beschikbaarheid'])->name('verhuurder.huizen.beschikbaarheid'); // Beschikbaarheid bekijken
    Route::post('/verhuurder/huizen/{id}/beschikbaarheid', [VerhuurderHuisController::class, 'updateBeschikbaarheid'])->name('verhuurder.huizen.beschikbaarheid.update'); // Beschikbaarheid aanpassen
});

// Recensies Routes (in Dutch)
Route::middleware('auth')->group(function () {
    Route::get('/recensies', [VerhuurderHuisController::class, 'recensies'])->name('recensies.index'); // Toon alle recensies
    Route::post('/recensies/beantwoorden', [VerhuurderHuisController::class, 'respond'])->name('recensies.beantwoorden'); // Beantwoord een recensie
});

// Authentication Routes
require __DIR__ . '/auth.php';
