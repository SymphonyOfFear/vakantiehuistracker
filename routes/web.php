<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\favorietenController;
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
Route::middleware('auth')->group(function () {
    Route::get('/verhuurder/dashboard', [VerhuurderDashboardController::class, 'dashboard'])->name('verhuurder.dashboard'); // Verhuurder Dashboard
    Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index'); // Beheer huizen
    Route::get('/verhuurder/huizen/toevoegen', [VerhuurderHuisController::class, 'create'])->name('verhuurder.huizen.create'); // Voeg nieuw huis toe
    Route::post('/verhuurder/huizen', [VerhuurderHuisController::class, 'store'])->name('verhuurder.huizen.store'); // Sla nieuw huis op
    Route::get('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show'); // Toon details van een huis
    Route::get('/verhuurder/huizen/{id}/bewerken', [VerhuurderHuisController::class, 'edit'])->name('verhuurder.huizen.edit'); // Bewerk een huis
    Route::put('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'update'])->name('verhuurder.huizen.update'); // Update een huis
    Route::delete('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'destroy'])->name('verhuurder.huizen.destroy'); // Verwijder een huis
});

// Reserveringen Routes
Route::middleware('auth')->group(function () {
    Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index'); // Overzicht van reserveringen
    Route::get('/reserveringen/nieuw', [ReserveringenController::class, 'create'])->name('reserveringen.create'); // Maak nieuwe reservering
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store'); // Sla reservering op
    Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show'); // Toon details van reservering
    Route::get('/reserveringen/{id}/bewerken', [ReserveringenController::class, 'edit'])->name('reserveringen.edit'); // Bewerk reservering
    Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update'); // Update reservering
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy'); // Verwijder reservering
});

// Favorieten Routes
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [favorietenController::class, 'index'])->name('favorieten.index'); // Toon alle favorieten
    Route::post('/favorieten/toevoegen/{vakantiehuisId}', [favorietenController::class, 'toevoegen'])->name('favorieten.toevoegen'); // Voeg een vakantiehuis toe aan favorieten
    Route::delete('/favorieten/verwijderen/{vakantiehuisId}', [favorietenController::class, 'verwijderen'])->name('favorieten.verwijderen'); // Verwijder een vakantiehuis van favorieten
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Bewerk profiel
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profiel
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Verwijder profiel
});

// Recensies (Feedback) Routes
Route::middleware('auth')->group(function () {
    Route::get('/recensies', [VerhuurderHuisController::class, 'recensies'])->name('recensies.index'); // Toon recensies
    Route::post('/recensies/beantwoorden', [VerhuurderHuisController::class, 'respond'])->name('recensies.beantwoorden'); // Beantwoord recensie
});

// Authentication Routes (Default Laravel Auth)
require __DIR__ . '/auth.php';
