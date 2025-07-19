<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        if (! $request->expectsJson()) {
            return redirect()->route('admin.login'); // or use ->to('/admin/login')
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
