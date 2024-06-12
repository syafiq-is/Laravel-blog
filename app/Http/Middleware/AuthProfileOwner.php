<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthProfileOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedUserId = $request->route('userId');
        $authenticatedUserId = auth()->id();

        if ($requestedUserId != $authenticatedUserId) {
            abort(403, 'Unauthorized access');
        }
        return $next($request);
    }
}
