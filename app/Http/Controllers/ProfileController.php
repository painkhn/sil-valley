<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Отображение страницы профиля
     */
    public function index() {
        $pc_list = [
            ['title' => 'ARDOR GAMING NEO M143', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
            ['title' => 'zxc', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
            ['title' => '123', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
            ['title' => 'asd', 'desc' => 'Intel Core i5-12400F, 6 x 2.5 ГГц, 16 ГБ DDR4, GeForce RTX 3050, SSD 1000 ГБ, без ОС, 1 x DisplayPort, 1 x DVI-D, 1 x HDMI, Intel H610, блок питания - 500 Вт'],
        ];
        return view('profile.index', compact('pc_list'));
        // dd("Профиль");
    }

    /**
     * Обновление информации профиля
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
