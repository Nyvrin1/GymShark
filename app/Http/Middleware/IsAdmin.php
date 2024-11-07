<?php

// app/Http/Middleware/IsAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If the user is not an admin, log them out and redirect to the admin login page
            if (!Auth::user()->isAdmin) {
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'login' => 'You have been logged out. Admin access is required.'
                ]);
            }

            // Allow the request to proceed if the user is an admin
            return $next($request);
        }

        // Redirect to the admin login page if not authenticated
        return redirect()->route('admin.login')->withErrors([
            'login' => 'Please log in as an admin to access this page.'
        ]);
    }
}

