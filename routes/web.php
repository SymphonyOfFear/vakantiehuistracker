<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecensiesController;
use App\Http\Controllers\FavorietenController;
use App\Http\Controllers\ReserveringenController;
use App\Http\Controllers\VerhuurderHuisController;

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
/*
Route::get('/verhuurders', function () {
    $user = User::factory()->create();
    $this->actingAs($user)->assertAuthenticated();

    $response = $this->get('/verhuurders');
    $response->assertStatus(200);
});*/
// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// Verhuurder Routes (Dashboard en Huizenbeheer)
Route::middleware(['auth'])->group(function () {
    Route::get('/verhuurder/dashboard', [VerhuurderHuisController::class, 'dashboard'])->name('verhuurder.dashboard');

    // Routes voor het beheren van vakantiehuizen door verhuurders
    Route::get('/verhuurder/huizen', [VerhuurderHuisController::class, 'index'])->name('verhuurder.huizen.index');
    Route::get('/verhuurder/huizen/create', [VerhuurderHuisController::class, 'create'])->name('verhuurder.huizen.create');
    Route::post('/verhuurder/huizen', [VerhuurderHuisController::class, 'store'])->name('verhuurder.huizen.store');
    Route::get('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'show'])->name('verhuurder.huizen.show');
    Route::get('/verhuurder/huizen/{id}/edit', [VerhuurderHuisController::class, 'edit'])->name('verhuurder.huizen.edit');
    Route::put('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'update'])->name('verhuurder.huizen.update');
    Route::delete('/verhuurder/huizen/{id}', [VerhuurderHuisController::class, 'destroy'])->name('verhuurder.huizen.destroy');
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
Route::middleware(['auth'])->group(function () {
    Route::get('/recensies', [RecensiesController::class, 'index'])->name('recensies.index');
    Route::post('/recensies', [RecensiesController::class, 'store'])->name('recensies.store');
    Route::get('/recensies/respond', [RecensiesController::class, 'create'])->name('recensies.respond');
    Route::get('/recensies/{id}/edit', [RecensiesController::class, 'edit'])->name('recensies.edit');
    Route::get('/recensies/{id}', [RecensiesController::class, 'show'])->name('recensies.show');
});


// Favorieten Routes
Route::middleware('auth')->group(function () {
    Route::get('/favorieten', [FavorietenController::class, 'index'])->name('favorieten.index');
    Route::post('/favorieten', [FavorietenController::class, 'store'])->name('favorieten.store');
    Route::post('/favorieten/toggle/{id}', [FavorietenController::class, 'toggle'])->name('favorieten.toggle');

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
