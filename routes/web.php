<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Pages that require a login
Route::middleware('auth')->group(function () {

    // Cards
    Route::resource('cards', CardController::class);

    Route::post('/cards/{card}/toggle-status', [CardController::class, 'toggleStatus'])
        ->name('cards.toggleStatus');

    Route::post('/cards/{card}/seen', [CardController::class, 'recordView'])
        ->name('cards.recordView');

    Route::post('/cards/{card}/favorite', [CardController::class, 'toggleFavorite'])
        ->name('cards.toggleFavorite');

    Route::get('/favorites', [CardController::class, 'favorites'])
        ->name('cards.favorites');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
