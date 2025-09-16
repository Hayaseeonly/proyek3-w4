<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // kalau user admin
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // kalau user mahasiswa
                if ($user->role === 'mahasiswa') {
                    return redirect()->route('mahasiswa.dashboard');
                }
            }
        }

        return $next($request);
    }
}
