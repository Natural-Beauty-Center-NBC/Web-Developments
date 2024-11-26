<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
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
     * Handle User's Profile (Transaction's History) - the user's point is already fetch in getUserData function
     */

     public function getUserTransactionHistory(string $id)
     {
        $user = User::where('id_customer', $id)->first();
        $transaksis = Transaksi::where('customer_id', $user->id)->where('status_pembayaran', 'Paid')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Riwayat Transaksi berhasil didapatkan!',
            'transaksi' => $transaksis 
        ]);
     }
}
