<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penjadwalan;
use App\Models\Perawatan;
use App\Models\Produk;
use Illuminate\Http\Request;

class InformasiKlinikController extends Controller
{
    /**
     * Handle List Perawatan
     */
     public function getPerawatansData()
     {
        $perawatans = Perawatan::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Perawatan berhasil didapatkan!',
            'perawatans' => $perawatans
        ]);
     }

     /**
     * Handle List Produk
     */
    public function getProduksData()
    {
        $produks = Produk::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Produk berhasil didapatkan!',
            'produks' => $produks
        ]);
    }

    /**
     * Handle Jadwal Dokter
     */
    public function getJadwalDokter() 
    {
        
    }

    /**
     * Handle Jadwal Beautician
     */
    public function getJadwalBeautician()
    {

    }
}
