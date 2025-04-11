<?php

use App\Http\Controllers\{
    ComputerController,
    ProfileController,
    AdminController,
    MainController
};
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('profile.index');

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'index')->name('profile.index');
    Route::patch('/profile/edit', 'update')->name('profile.update');
});

Route::prefix('admin')->middleware(IsAdmin::class)->name('admin.')->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.index');
    });

    Route::controller(ComputerController::class)->group(function () {
        Route::get('/computer/create', 'create')->name('computer.create');
        Route::post('/computer/store', 'store')->name('computer.store');
        Route::delete('/computer/destroy/{computer}', 'destroy')->name('computer.destroy')->whereNumber('computer');
        Route::put('/computer/restore/{computer}', 'restore')->name('computer.restore')->whereNumber('computer')->withTrashed();
    });
});

Route::controller(ComputerController::class)->group(function() {
    Route::get('shop', 'index')->name('shop.index');
    Route::get('/product/{computer}', 'show')->whereNumber('computer')->name('computer.show');
});

require __DIR__.'/auth.php';
