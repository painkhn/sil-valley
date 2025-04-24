<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Обновленеи пароля пользователя
     */
    public function update(Request $request): RedirectResponse
    {
        // Валидируем новые данные
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Обновляем пароль
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Возвращаем с уведомлением
        return back()->with('success', 'Пароль успешно изменен');
    }
}
