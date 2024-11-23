<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    /**
     * Handle register for User.
     */
    public function register(Request $request)
    {
        $registrationData = $request->all();

        // Validation rules
        $validate = Validator::make($registrationData, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:' . User::class],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'min_digits:12'],
            'alergi' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Return validation errors with status and message
        if ($validate->fails()) {
            return response([
                'status' => 'error',
                'message' => $validate->errors()->first(), // Return the first error message
            ], 400);
        }

        // Set default value for 'alergi' if null
        if ($request->alergi == null) {
            $registrationData['alergi'] = "Tidak ada";
        }

        // Hash the password
        $registrationData['password'] = Hash::make($request->password);
        $registrationData['id_customer'] = "-";

        // Create the user
        try {
            $user = User::create($registrationData);

            // Generate the ID Customer
            $currentMonth = date('m'); // Two-digit month of registration
            $currentYear = date('y');  // Two-digit year of registration

            // Extract date of birth components [ddMMyyyy]
            $dateOfBirth = date_create($registrationData['tanggal_lahir']);
            $dayOfBirth = date_format($dateOfBirth, 'd');
            $monthOfBirth = date_format($dateOfBirth, 'm');
            $yearOfBirth = date_format($dateOfBirth, 'Y');

            $dateSeries = $currentMonth . $currentYear . $dayOfBirth . $monthOfBirth . $yearOfBirth;
            $user->id_customer = $dateSeries . $user->id;
            $user->save();

            // Return success response
            return response([
                'status' => 'success',
                'message' => 'Registrasi berhasil.',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            // Return error response for unexpected exceptions
            return response([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat registrasi.',
            ], 500);
        }
    }

    /**
     * Handle login for both Pegawai and User.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if Pegawai exists
        $pegawai = Pegawai::where('email', $request->email)->first();

        if ($pegawai && Hash::check($request->password, $pegawai->password) && ($pegawai->role == "Beautician" || $pegawai->role == "Kepala Klinik")) {
            // If Pegawai found and password matches
            $token = $pegawai->createToken('pegawai-token')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Logged in as ' . $pegawai->role,
                'user_type' => 'pegawai',
                'pegawai' => $pegawai,
                'user' => null,
                'token' => $token,
            ], 200);
        }

        // Check if User exists
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // If User found and password matches
            $token = $user->createToken('user-token')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Logged in as User',
                'user_type' => 'customer',
                'pegawai' => null,
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'status' => 'Error',
            'message' => 'Invalid Email or Password!',
        ], 400);
    }
}
