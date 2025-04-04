<?php

use App\Http\Controllers\{
    ProfileController,
    MainController
};
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

Route::get('shop', function() {
    $videocards = [
        ['title' => 'GeForce RTX 2060 SUPER'],
        ['title' => 'GeForce RTX 2080 TI'],
        ['title' => 'AMD Radeon RX 7800'],
        ['title' => 'AMD Radeon RX 7600'],
    ];
    $cpus = [
        ['title' => 'Intel Core i5 5600'],
        ['title' => 'Intel Core i7 7700'],
        ['title' => 'AMD Ryzen 5 3600'],
        ['title' => 'AMD Ryzen 5 5600'],
    ];
    $ram = [
        ['value' => '8 ГБ'],
        ['value' => '16 ГБ'],
        ['value' => '32 ГБ'],
        ['value' => '64 ГБ'],
    ];
    $pc_list = [
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
    ];
    return view('shop.index', compact('videocards', 'cpus', 'ram', 'pc_list'));
})->name('shop.index');

require __DIR__.'/auth.php';
