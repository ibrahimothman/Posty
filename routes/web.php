<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


Route::get('/posts', function () {
    return view('posts.index');
});
