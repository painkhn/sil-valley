<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
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
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /**
     * Обновление информации профиля
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save(); // Обновляем информацию профиля

        return Redirect::route('profile.index')->with('success', 'Данные успешно обновлены');
    }
}
