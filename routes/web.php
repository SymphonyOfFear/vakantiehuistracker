<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HuizenController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::get('/huizen', [HuizenController::class, 'index'])->name('huizen.index');
Route::get('/huizen/{huizen}', [HuizenController::class, 'show'])->name('huizen.show');
Route::get('/reserveringen/boeken', [HuizenController::class, 'show'])->name('reserveringen.boeken');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
require __DIR__ . '/auth.php';
