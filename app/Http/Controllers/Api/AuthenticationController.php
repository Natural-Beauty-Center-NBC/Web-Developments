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

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        if ($request->alergi == null) {
            $registrationData['alergi'] = "Tidak ada";
        }
        $registrationData['password'] = bcrypt($request->password);
        $registrationData['id_customer'] = "-";
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

        return response([
            'message' => 'Registrasi Success',
            'user' => $user
        ], 200);
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

        if ($pegawai && Hash::check($request->password, $pegawai->password) && $pegawai->role == "Beautician") {
            // If Pegawai found and password matches
            $token = $pegawai->createToken('pegawai-token')->accessToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Logged in as Pegawai',
                'user_type' => 'pegawai',
                'pegawai' => $pegawai,
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
                'user_type' => 'user',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If neither found, throw an error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
