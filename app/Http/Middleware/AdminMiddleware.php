<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Якщо користувач не авторизований або не адмін
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Доступ заборонено');
        }

        return $next($request);
    }
}
