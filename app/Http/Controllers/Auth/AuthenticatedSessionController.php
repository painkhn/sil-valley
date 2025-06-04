<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{
    Auth,
    Route,
    Hash
};

class AuthenticatedSessionController extends Controller
{

    public function create()
    {
        return view('components.auth.login');
    }

    /**
     * Авторизируем пользователя
     *
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('profile.index', absolute: false));
    }

    /**
     * Выход из аккаунта
     *
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Редирект на GitHub
     *
     */
    public function RedirectGithub(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Получение пользователя GitHub
     *
     */
    public function CallbackGithub(): RedirectResponse
    {
        // Получаем данные о пользователе и проверяем, есть ли такой в бд
        $user = Socialite::driver('github')->user();
        $existingUser = User::where('email', $user->email)->first();

        // Если нет такого, то создаем
        if (!$existingUser) {
            $newUser = User::create([
                'name' => $user->nickname,
                'email' => $user->email,
                'provider' => 'github',
                'password' => Hash::make(Str::random(16))
            ]);

            Auth::login($newUser);
            return redirect(route('profile.index'));
        } else {
            // Если есть, то проверяем метод регистрации
            if ($existingUser->provider === 'github') {
                // Если github то авторизируем
                Auth::login($existingUser);
                return redirect(route('profile.index'));
            } else {
                // Если нет, то просим войти через форму входа
                return redirect(route('index'))->with('error', 'Используйте логин-пароль для входа');
            }
        }
    }
}
