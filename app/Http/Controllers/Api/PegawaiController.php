<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Ruangan;

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
     * Getting Ruangan with status Available and Ruangan that currently get assigned
     */
    public function getRuangan($id)
    {
        $currentRuangan = Ruangan::where('assign_to', $id)->first();
        $listRuangan = Ruangan::where('status', 'Available')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Ruangan berhasil didapatkan!',
            'data' => [
                'current' => [
                    'ruangan' => $currentRuangan ?? null,
                    'assign_to' => $currentRuangan ? $currentRuangan->pegawai->nama : null,
                ],
                'listRuangan' => $listRuangan
            ]
        ]);
    }

    /**
     * Update Ruangan's status and who get assigned to it
     */
    public function updateRuangan($id_ruangan, $id_pegawai)
    {
        $current = Ruangan::where('assign_to', $id_pegawai)->first();
        $pegawai = Pegawai::find($id_pegawai);
        $ruangan = Ruangan::find($id_ruangan);

        if (!$pegawai || !$ruangan) {
            return response()->json([
                'status' => "error",
                'message' => "Pegawai or Ruangan not found"
            ], 404);
        }

        /**
         * Condition: Beautician is assigned but selects another room without unassigning the first
         */
        if ($current && $current->id != $ruangan->id) {
            return response()->json([
                'status' => "error",
                'message' => "Beautician tidak Available"
            ], 400);
        }

        /**
         * Condition: Beautician is assigned and selects the same room
         */
        if ($current && $current->id == $ruangan->id) {
            $pegawai->status = 'Available';
            $pegawai->save();

            $current->assign_to = null;
            $current->status = 'Available';
            $current->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Ruangan berhasil diupdate!',
                'ruangan' => $current
            ], 200);
        }

        /**
         * Condition: Beautician selects a room to get assigned
         */
        if (!$current) {
            $pegawai->status = 'Assigned';
            $pegawai->save();

            $ruangan->assign_to = $pegawai->id;  // Fix: update the new room
            $ruangan->status = 'Assigned';      // Fix: update new room status
            $ruangan->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Ruangan berhasil diupdate!',
                'ruangan' =>$ruangan
            ], 200);
        }

        return response()->json([
            'status' => "error",
            'message' => "Unexpected error"
        ], 500);
    }
}
