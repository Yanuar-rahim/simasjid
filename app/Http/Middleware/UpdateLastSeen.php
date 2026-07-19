<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastSeen
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            $user = auth()->user();

            $user->last_seen = now();

            $user->save();

            logger()->info('LAST SEEN UPDATED', [
                'user' => $user->id,
                'last_seen' => $user->fresh()->last_seen,
            ]);
        }

        return $next($request);
    }
}
