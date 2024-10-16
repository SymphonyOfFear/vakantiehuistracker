<?php

use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecensiesController;
use App\Http\Controllers\FavorietenController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\Verhuurder\ResultsController as VerhuurderResultsController;
use App\Http\Controllers\Huurder\ResultsController as HuurderResultsController;
use App\Http\Controllers\Admin\ResultsController as AdminResultsController;
use Illuminate\Support\Facades\Route;

// General Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index');
Route::get('/huizen/{id}', [HuizenController::class, 'show'])->name('huizen.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/results', [AdminResultsController::class, 'index'])->name('admin.results.index');
});

// Verhuurder 
Route::middleware(['auth', 'role:verhuurder'])->group(function () {
    Route::get('/verhuurder/dashboard', [VerhuurderResultsController::class, 'dashboard'])->name('verhuurder.dashboard');
    Route::get('/verhuurder/results', [VerhuurderResultsController::class, 'index'])->name('verhuurder.results.index');
    Route::get('/verhuurder/huizen', [VerhuurderResultsController::class, 'huizen'])->name('verhuurder.huizen.index');
    Route::get('/verhuurder/huizen/create', [VerhuurderResultsController::class, 'create'])->name('verhuurder.huizen.create');
    Route::post('/verhuurder/huizen', [VerhuurderResultsController::class, 'store'])->name('verhuurder.huizen.store');
    Route::get('/verhuurder/huizen/{id}/edit', [VerhuurderResultsController::class, 'edit'])->name('verhuurder.huizen.edit');
    Route::put('/verhuurder/huizen/{id}', [VerhuurderResultsController::class, 'update'])->name('verhuurder.huizen.update');
    Route::delete('/verhuurder/huizen/{id}', [VerhuurderResultsController::class, 'destroy'])->name('verhuurder.huizen.destroy');
});

// Huurder 
Route::middleware(['auth', 'role:huurder'])->group(function () {
    Route::get('/huurder/dashboard', [HuurderResultsController::class, 'dashboard'])->name('huurder.dashboard');
    Route::get('/huurder/results', [HuurderResultsController::class, 'index'])->name('huurder.results.index');
});

// Recensies
Route::middleware('auth')->group(function () {
    Route::get('/recensies', [RecensiesController::class, 'index'])->name('recensies.index');
    Route::post('/recensies', [RecensiesController::class, 'store'])->name('recensies.store');
    Route::get('/recensies/{id}', [RecensiesController::class, 'show'])->name('recensies.show');
    Route::get('/recensies/{id}/edit', [RecensiesController::class, 'edit'])->name('recensies.edit');
    Route::put('/recensies/{id}', [RecensiesController::class, 'update'])->name('recensies.update');
    Route::delete('/recensies/{id}', [RecensiesController::class, 'destroy'])->name('recensies.destroy');
});

// Favorieten
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten.index');
    Route::post('/favorieten', [FavorietenController::class, 'store'])->name('favorieten.store');
    Route::post('/favorieten/toggle/{id}', [FavorietenController::class, 'toggle'])->name('favorieten.toggle');
    Route::delete('/favorieten/{id}', [FavorietenController::class, 'destroy'])->name('favorieten.destroy');
});

// Reserveringen
Route::middleware('auth')->group(function () {
    Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index');
    Route::get('/reserveringen/create', [ReserveringenController::class, 'create'])->name('reserveringen.create');
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
    Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show');
    Route::get('/reserveringen/{id}/edit', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
    Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
