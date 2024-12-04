<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPerawatan;
use App\Models\DetailProduk;
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
        $transaksis = Transaksi::where('customer_id', $user->id)->where('status_pembayaran', 'Paid')->orderBy('tanggal_transaksi', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Riwayat Transaksi berhasil didapatkan!',
            'transaksi' => $transaksis
        ]);
    }

    /**
     * Getting Detail Transaction
     */
    public function getDetailTransaction(string $id)
    {
        $transaksi = Transaksi::where('no_transaksi', $id)->first();
        $detailProduk = DetailProduk::where('transaksi_id', $transaksi->id)
            ->with('produk')
            ->get();

        $detailPerawatan = DetailPerawatan::where('transaksi_id', $transaksi->id)
            ->with('perawatan')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Transaksi berhasil didapatkan.',
            'data' => [
                'transaksi' => $transaksi,
                'detailProduk' => $detailProduk,
                'detailPerawatan' => $detailPerawatan
            ],
        ]);
    }
}
