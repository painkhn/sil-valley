<?php

use App\Http\Controllers\{
    ComparisonController,
    ComputerController,
    FavoriteController,
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
    Route::get('/profile/orders', 'index')->name('profile.orders');
    Route::post('/order/store', 'store')->name('order.store');
});

Route::controller(FavoriteController::class)->middleware('auth')->group(function () {
    Route::get('/favorites', 'show')->name('favorites.show');
    Route::post('/favorites/{computer}/store', 'store')->name('favorites.store');
    Route::delete('/favorites/clear', 'clear')->name('favorites.clear');
});

Route::controller(ComparisonController::class)->middleware('auth')->group(function () {
    Route::get('/comparison', 'show')->name('comparisons.show');
    Route::post('/comparison/store', 'store')->name('comparison.store');
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'index')->name('profile.index');
    Route::patch('/profile/edit', 'update')->name('profile.update');
});

Route::prefix('admin')->middleware(IsAdmin::class)->name('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/products', 'products')->name('products');
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/excel', 'excel')->name('excel');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::patch('/orders/{order}/update', 'update')->whereNumber('order')->name('orders.update');
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
