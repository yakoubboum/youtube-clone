<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VideoStreamController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/video-stream/{filename}', [VideoStreamController::class, 'stream']);


// Route::get('/video/{id}', [VideoController::class, 'show'])->name('videos.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/video/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/video/store', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/video/{id}', [VideoController::class, 'show'])->name('videos.show');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
