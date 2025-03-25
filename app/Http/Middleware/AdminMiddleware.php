<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is an admin
        if (!Auth::guard('admin')->check()) {
            // If not, abort with a 403 error
            return redirect()->route('admin.login.show')->with('error', 'You must be logged in as an admin.');        }
        // If the user is an admin, continue with the request
        return $next($request);
    }
}
