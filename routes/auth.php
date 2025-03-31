<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');

    Route::controller(AuthenticatedSessionController::class)->group(function () {
        Route::post('login', 'store')->name('login');
        Route::get('/login/github', 'RedirectGithub')->name('login.github');
        Route::get('/login/github/callback', 'CallbackGithub')->name('login.github.call');
    });
});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
