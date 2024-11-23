<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Getting a specific User's data
     */
    public function getUserData(string $id)
    {
        $user = User::where('id_customer', $id)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Customer berhasil didapatkan!',
            'pegawai' => null,
            'user' => $user
        ], 200);
    }

    /**
     * Handle User's Profile (Transaction's History and Personal Point)
     */

     // TODO
}
