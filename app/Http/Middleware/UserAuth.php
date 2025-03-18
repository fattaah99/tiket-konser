<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // Jika belum login, redirect ke halaman login user
        return redirect()->route('user.login')->with('error', 'Silakan login terlebih dahulu.');
    }
}