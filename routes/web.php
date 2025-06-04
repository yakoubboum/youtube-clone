<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VideoStreamController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');



Route::get('/video/{id}', [\App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');

Route::get('/video/add', [\App\Http\Controllers\VideoController::class, 'add'])->name('videos.add');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/video-stream/{filename}', [VideoStreamController::class, 'stream']);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
