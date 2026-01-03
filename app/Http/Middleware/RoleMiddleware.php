<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Get the current user (may be null for guests)
        $user = auth()->user();

        // If the user is not authenticated, redirect them to the login page
        if (! $user) {
            return redirect()->route('login');
        }

        // Support multiple roles passed as a comma-separated string: 'admin,manager'
        $allowed = array_map('trim', explode(',', $role));

        if (! in_array($user->role, $allowed, true)) {
            // Use HTTP status constant for clarity
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
