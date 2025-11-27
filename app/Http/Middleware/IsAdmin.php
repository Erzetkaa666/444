<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Jika belum login
        if (! $user) {
            return redirect()->route('login');
        }

        // Jika bukan admin
        if ($user->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Hanya admin yang diperbolehkan.');
        }

        return $next($request);
    }
}
