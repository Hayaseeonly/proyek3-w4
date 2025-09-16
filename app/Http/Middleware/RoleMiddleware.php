<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->session()->get('user');

        if (!$user || $user->role !== $role) {
            return redirect('/login')->withErrors('Akses ditolak!');
        }

        return $next($request);
    }
}
