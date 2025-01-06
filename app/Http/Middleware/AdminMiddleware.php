<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!Auth::user()->is_admin) {
                Log::info('User is authenticated but not an admin.');
                return redirect('/');
            }
        } else {
            // Log a message if the user is not authenticated
            Log::info('User is not authenticated.');

            // Redirect to the login page or home page if not authenticated
            return redirect('/');
        }

        // Proceed with the request if the user is an admin
        return $next($request);
    }
}
