<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\hari;
use App\Models\Pegawai;
use App\Models\Penjadwalan;
use App\Models\Perawatan;
use App\Models\Produk;

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
     * Handle List Doctor
     */
    public function getListDokter()
    {
        $dokters = Pegawai::where('role', 'Dokter')->limit(10)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data List Dokter berhasil; didapatkan!',
            'dokters' => $dokters
        ]);
    }

    /**
     * Handle Jadwal Dokter
     */
    public function getJadwalDokter()
    {
        $currentDay = now()->format('l');

        $jadwal = Penjadwalan::with(['pegawai', 'shift', 'hari'])
            ->get()
            ->groupBy('hari.nama')
            ->map(function ($items, $hari) {
                return [
                    'hari' => $hari,
                    'jadwal' => $items->map(function ($item) {
                        return [
                            'dokter' => [
                                'nama' => $item->pegawai->nama ?? 'Unknown',
                                'no_telp' => $item->pegawai->no_telp
                            ],
                            'shift' => [
                                'nama' => $item->shift->nama,
                                'start_at' => $item->shift->start_at,
                                'end_at' => $item->shift->end_at,
                            ],
                        ];
                    }),
                ];
            })
            ->sortBy(function ($item) use ($currentDay) {
                return $item['hari'] === $currentDay ? 0 : 1; // Current day comes first
            })->values();

        return response()->json([
            'status' => 'success',
            'message' => 'Data Jadwal Dokter berasil didapatkan!',
            'data' => $jadwal
        ]);
    }
}
