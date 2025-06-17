<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if a user is authenticated and if that user is an admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            // If they are an admin, redirect them to the admin dashboard.
            return redirect()->route('admin.dashboard');
        }

        // Otherwise, allow them to access the requested page (like the welcome page).
        return $next($request);
    }
}
