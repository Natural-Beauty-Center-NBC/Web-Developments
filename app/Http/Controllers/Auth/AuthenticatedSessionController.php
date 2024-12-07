<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

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
            Alert::success('Success', 'Anda berhasil Login!');
            return redirect()->intended(route('public.home'));
        }

        // Attempt to authenticate against the `pegawai` guard
        if (Auth::guard('pegawai')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $role = Auth::guard('pegawai')->user()->role;

            if ($role === 'Admin') {
                Alert::success('Success', 'Anda berhasil Login sebagai Admin');
                return redirect()->route('admin.home');

            } elseif ($role === 'Kepala Klinik') {
                Alert::success('Success', 'Anda berhasil Login sebagai Kepala Klinik');
                return redirect()->route('kepala-klinik.home');

            } elseif ($role === 'Customer Service') {
                Alert::success('Success', 'Anda berhasil Login sebagai Customer Service');
                return redirect()->route('customer-service.home');

            } elseif ($role === 'Dokter') {
                Alert::success('Success', 'Anda berhasil Login sebagai Dokter');
                return redirect()->route('dokter.queue');

            } else if ($role === 'Kasir') {
                Alert::success('Success', 'Anda berhasil Login sebagai Kasir');
                return redirect()->route('kasir.daftar-pending');
            }

            // Default redirect
            return redirect()->intended(route('public.home'));
        }

        // Fallback if authentication fails
        Alert::error('Error', 'Akun tidak valid!');
        return back();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Success', 'Anda berhasil melakukan Logout!');
        return redirect('/');
    }

    public function destroyPegawai(Request $request): RedirectResponse
    {
        Auth::guard('pegawai')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Success', 'Anda berhasil melakukan Logout!');
        return redirect('/');
    }
}
