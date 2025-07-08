<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VideoStreamController;
use App\Http\Controllers\VideoController;
use App\Models\Video;

Route::get('/', function () {
    $videos = Video::with('user')
        ->orderBy('created_at', 'desc')
        ->where('visibility', 'public')
        ->get();

    return Inertia::render('Welcome', ['videos' => $videos]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/video-stream/{filename}', [VideoStreamController::class, 'stream'])->name('video.stream');



Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/video/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/video/store', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/video/{id}', [VideoController::class, 'destroy'])->name('video.destroy');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
