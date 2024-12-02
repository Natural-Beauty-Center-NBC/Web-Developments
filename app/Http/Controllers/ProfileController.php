<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('public.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:' . User::class],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'min_digits:12'],
            'alergi' => ['nullable', 'string']
        ]);

        try {
            $user->update([
                'id_customer' => $user->id_customer,
                'nama' => $request->nama,
                'email' => $request->email,
                'tanggal_lahir' => $user->tanggal_lahir,
                'jenis_kelamin' => $user->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'alergi' => $request->alergi ?? 'Tidak Ada',
                'password' => $user->password
            ]);
            Alert::success('Success', 'Data Customer berhasil diubah!');
            return Redirect::route('profile.edit');
            
        } catch (Exception $e) {
            Alert::error('Error', 'Data Customer gagal diubah!');
            return Redirect::route('profile.edit');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::success('Success', 'Data telah berhasil dihapus!');
        return Redirect::to('/');
    }

    /**
     * Update the user's password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8'
        ]);

        if (Str::length($request->new_password) < 8) {
            Alert::warning('Warning', 'Password harus memiliki min 8 digits!');
        }

        if (!Hash::check($request->old_password, $request->user()->password)) {
            Alert::error('Error', 'Password tidak valid!');
            return back();
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        Alert::success('Success', 'Password anda berhasil diubah!');
        return back();
    }
}
