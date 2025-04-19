<?php

use App\Http\Controllers\{
    ComputerController,
    ProfileController,
    AdminController,
    OrderController,
    MainController
};
use App\Http\Controllers\CartController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});


Route::controller(OrderController::class)->middleware('auth')->group(function () {
    Route::post('/order/store', 'store')->name('order.store');
});

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
        Route::get('/computer/edit/{computer}', 'edit')->name('computer.edit')->whereNumber('computer');
        Route::patch('/computer/update/{computer}', 'update')->name('computer.update')->whereNumber('computer');
    });
});

Route::controller(ComputerController::class)->group(function() {
    Route::get('shop', 'index')->name('shop.index');
    Route::get('/product/{computer}', 'show')->whereNumber('computer')->withTrashed()->name('computer.show');
});

Route::controller(CartController::class)->group(function() {
    Route::get('/cart', 'show')->name('cart.show');
    Route::post('/cart/store', 'store')->name('cart.store');
    Route::patch('/cart/quantity/update/{item}/{status}', 'update')->name('cart.update');
});

require __DIR__.'/auth.php';
