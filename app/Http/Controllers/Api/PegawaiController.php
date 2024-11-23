<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Getting a specific pegawai's data
     */
    public function getPegawaiData($id) 
    {
        $pegawai = Pegawai::find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Pegawai berhasil didapatkan!',
            'pegawai' => $pegawai,
            'user' => null
        ], 200);
    }

    /**
     * Handle Beautician's Jobdesc
     */


     // TODO
}
