<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactorVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (
            $user->two_factor_secret &&
            $user->two_factor_confirmed_at &&
            !session()->has('2fa_verified')
        ) {

            if ($user->role === 'admin') {
                return redirect()->route('admin.2fa.index');
            }

            return redirect()->route('user.2fa.index');
        }
        
        return $next($request);
    }
}
