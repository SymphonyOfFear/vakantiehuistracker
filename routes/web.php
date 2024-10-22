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
use App\Http\Controllers\VerhuurderHuisController;
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
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminResultsController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminResultsController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/permissions', [AdminResultsController::class, 'permissionsIndex'])->name('admin.permissions.index');
    Route::get('/settings', [AdminResultsController::class, 'settings'])->name('admin.settings');
    Route::get('/users/edit', [AdminResultsController::class, 'edit'])->name('users.edit');
    Route::delete('/users/destroy', [AdminResultsController::class, 'destroy'])->name('users.destroy');
});

// Verhuurder
Route::prefix('verhuurder')->group(function () {
    Route::get('/dashboard', [VerhuurderResultsController::class, 'index'])->name('verhuurder.dashboard');
    Route::get('/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index');
    Route::get('/huizen/create', [VerhuurderHuisController::class, 'create'])->name('verhuurder.huizen.create');
    Route::post('/huizen', [VerhuurderHuisController::class, 'store'])->name('verhuurder.huizen.store');
    Route::get('/huizen/{id}/edit', [VerhuurderHuisController::class, 'edit'])->name('verhuurder.huizen.edit');
    Route::put('/huizen/{id}', [VerhuurderHuisController::class, 'update'])->name('verhuurder.huizen.update');
    Route::delete('/huizen/{id}', [VerhuurderHuisController::class, 'destroy'])->name('verhuurder.huizen.destroy');
    Route::get('/huizen/{id}/show', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show');
});

// Huurder
Route::prefix('huurder')->group(function () {
    Route::get('/dashboard', [HuurderResultsController::class, 'dashboard'])->name('huurder.dashboard');
});

// Recensies
Route::group(['middleware' => 'auth'], function () {
    Route::get('/recensies', [RecensiesController::class, 'index'])->name('recensies.index');
    Route::get('/recensies/create', [RecensiesController::class, 'create'])->name('recensies.create');
    Route::post('/recensies', [RecensiesController::class, 'store'])->name('recensies.store');
    Route::get('/recensies/{id}/edit', [RecensiesController::class, 'edit'])->name('recensies.edit');
    Route::put('/recensies/{id}', [RecensiesController::class, 'update'])->name('recensies.update');
    Route::delete('/recensies/{id}', [RecensiesController::class, 'destroy'])->name('recensies.destroy');
});

// Favorieten
Route::group(['middleware' => 'auth'], function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten.index');
    Route::post('/favorieten', [FavorietenController::class, 'store'])->name('favorieten.store');
    Route::post('/favorieten/toggle/{id}', [FavorietenController::class, 'toggle'])->name('favorieten.toggle');
    Route::delete('/favorieten/{id}', [FavorietenController::class, 'destroy'])->name('favorieten.destroy');
});

// Reserveringen
Route::group(['middleware' => 'auth'], function () {
    Route::get('/reserveringen', [ReserveringenController::class, 'index'])->name('reserveringen.index');
    Route::get('/reserveringen/create', [ReserveringenController::class, 'create'])->name('reserveringen.create');
    Route::post('/reserveringen', [ReserveringenController::class, 'store'])->name('reserveringen.store');
    Route::get('/reserveringen/{id}', [ReserveringenController::class, 'show'])->name('reserveringen.show');
    Route::get('/reserveringen/{id}/edit', [ReserveringenController::class, 'edit'])->name('reserveringen.edit');
    Route::put('/reserveringen/{id}', [ReserveringenController::class, 'update'])->name('reserveringen.update');
    Route::delete('/reserveringen/{id}', [ReserveringenController::class, 'destroy'])->name('reserveringen.destroy');
});

// Profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
