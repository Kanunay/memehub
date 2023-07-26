<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;


Route::get('/home', function () {
    return view('home');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Media routes
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
Route::get('/media/{media}/edit', [MediaController::class, 'edit'])->name('media.edit');
Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
