<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BeforeTeamMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('X-Team-Id')) {
            session()->put(config('app.system.sessions.keys.team'), $request->header('X-Team-Id'));
        }

        return $next($request);
    }
}
