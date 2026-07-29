<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\LikeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Спринт 2: Просмотр анкет
Route::get('/discover', [BrowseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('discover');

// Спринт 3: Лайки
Route::get('/my-likes', [LikeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('likes.index');

Route::post('/likes/{user}', [LikeController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('likes.store');

Route::delete('/likes/{like}', [LikeController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('likes.destroy');

Route::get('/my-profile/{id}', function ($id) {
    return view('my-profile');
})->middleware(['auth', 'verified'])->name('my-profile');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
