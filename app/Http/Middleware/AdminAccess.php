<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and using the 'pegawai' guard
        if (Auth::guard('pegawai')->check()) {
            // Retrieve the authenticated user from the pegawai guard
            $user = Auth::guard('pegawai')->user();

            // Check if the user's role is 'Admin'
            if ($user->role === 'Admin') {
                return $next($request);
            }
        }

        // Redirect if the user is not an admin or not authenticated
        return redirect()->route('public.home')->with('error', 'Unauthorized access.');
    }
}
