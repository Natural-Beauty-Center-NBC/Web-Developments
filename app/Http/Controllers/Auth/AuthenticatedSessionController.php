<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function createPegawai(): View
    {
        return view('auth.login-pegawai');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Default redirect
            return redirect()->intended(route('public.home'));
        }

        // Fallback if authentication fails
        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);

        // Default code (Deleting Soon ...)
        /*
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('public.home', absolute: false));
        */
    }

    public function storePegawai(LoginRequest $request): RedirectResponse
    {
        // Attempt to authenticate against the `pegawai` guard
        if (Auth::guard('pegawai')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $role = Auth::guard('pegawai')->user()->role;

            if ($role === 'Admin') {
                return redirect()->route('admin.home');
            } elseif ($role === 'Dokter') {
                return redirect()->route('user.dashboard');
            }

            // Default redirect
            return redirect()->intended(route('public.home'));
        }

        // Fallback if authentication fails
        return back()->withErrors([
            'email' => 'Invalid login credentials.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    
}
