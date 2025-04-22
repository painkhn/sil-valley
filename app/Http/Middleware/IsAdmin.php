<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Проверка запроса
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, авторизован ли пользователь и является ли он администратором
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Если не администратор, вызываем ошибку 403
        abort(403);
    }
}
