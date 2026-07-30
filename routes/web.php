<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Спринт 2-5: Swipe discover
Route::get('/discover', [BrowseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('discover');

Route::get('/discover/next', [BrowseController::class, 'nextCard'])
    ->middleware(['auth', 'verified'])
    ->name('discover.next');

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

// Спринт 6: Skip (пропуски анкет)
Route::post('/skips', [BrowseController::class, 'storeSkip'])
    ->middleware(['auth', 'verified'])
    ->name('skips.store');

// Language switcher
Route::get('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
