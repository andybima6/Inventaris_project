<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            return $next($request);
        }

        // Jika tidak ada sesi login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
