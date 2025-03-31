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
    public function RedirectGithub() : RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Получение пользователя GitHub
     *
     */
    public function CallbackGithub() : RedirectResponse
    {
        $user = Socialite::driver('github')->user();
        $existingUser = User::where('email', $user->email)->first();

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
            if ($existingUser->provider === 'github') {
                Auth::login($existingUser);
                return redirect(route('profile.index'));
            } else {
                return redirect(route('index'))->with('error', 'Используйте логин-пароль для входа');
            }
        }
    }
}
