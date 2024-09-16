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
})->name('home');

// Huizen Routes
Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index'); // Overzicht van huizen
Route::get('/huizen/search', [HuizenController::class, 'search'])->name('huizen.search'); // Zoekfunctie
Route::get('/huizen/{id}', [HuizenController::class, 'show'])->name('huizen.show'); // Details van een huis

// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index'); // Contactpagina

// Verhuurder Routes (Dashboard en Huizenbeheer)
Route::get('/verhuurder/dashboard', [VerhuurderDashboardController::class, 'index'])->name('verhuurder.dashboard');
Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index');
Route::get('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show');

// Reserveringen Routes
Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index'); // Overzicht van reserveringen
Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store'); // Nieuwe reservering maken
Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show'); // Reservering details
Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
//
require __DIR__ . '/auth.php';
