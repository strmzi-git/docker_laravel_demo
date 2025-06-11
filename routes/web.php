<?php

use App\Http\Controllers\DiaryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [DiaryController::class, 'index']);

Route::get('/', function () {
    return redirect()->route('diary.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('/diary', DiaryController::class);
});


require __DIR__ . '/auth.php';
Route::get('/dashboard', fn () => redirect('/diary'))->name('dashboard');
