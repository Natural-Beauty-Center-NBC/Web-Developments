<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Promo;
use App\Models\User;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $promos = Promo ::all();
        return view('core.kepala-klinik.data-promo.index', compact('promos'))->with([
            'title' => 'Kepala Klinik | Promo'
        ]);
    }

    public function show($id)
    {
        $promos = Promo::find($id);
        return view('core.kepala-klinik.data-promo.show', compact('promos'))->with([
            'title'=>'Kepala Klinik | Show Promo'
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    
    public function create()
    {
        return view('core.kepala-klinik.data-promo.create')->with([
            'title' => 'Kepala Klinik | Create Promo'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|unique:promos,kode', 
            'jenis' => 'required|string',
            'keterangan' => 'required|string',
            'jenis_potongan' => 'required|in:Persen,Nominal', // Jenis potongan hanya boleh persen atau potongan
            'nilai_potongan' => 'required|nullable|numeric|min:0', 
            'periode' => 'required|string', 
            'status' => 'required|in:Aktif,Non-Aktif', // Status promo, hanya bisa 'Aktif' atau 'Non-Aktif'
        ]);

        try {
            
            Promo::create([
                'kode' => $request->kode,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
                'jenis_potongan' => $request->jenis_potongan,
                'nilai_potongan' => $request->nilai_potongan,
                'periode' => $request->periode,
                'status' => $request->status,
            ]);

            // Redirect dengan sukses
            Alert::success('Success', 'Data Promo berhasil ditambahkan!');
            return redirect()->route('kepala-klinik.index-promo');
        } catch (\Exception $e) {
            // Jika ada error, kembali dengan error message
            Alert::error('Error', 'Data Promo gagal ditambahkan!');
            return redirect()->route('kepala-klinik.index-promo');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function edit($id)
    {
        $promos = Promo::find($id);
        return view('core.kepala-klinik.data-promo.edit', compact('promos'))->with([
            'title' => 'Kepala Klinik | Edit Promo'
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'kode' => 'required|string',
        'jenis' => 'required|string', // Perbaikan nama kolom 'jenis'
        'keterangan' => 'required|string',
        'jenis_potongan' => 'nullable|string',
        'nilai_potongan' => 'nullable|numeric|min:0',
        'periode' => 'nullable|string',
        'status' => 'required|in:Aktif,Non-Aktif',
    ]);

    try {
        $promos = Promo::findOrFail($id);
        $promos->update([
            'kode' => $request->kode,
            'jenis' => $request->jenis, // Perbaikan untuk mengambil nilai 'jenis' dari request
            'keterangan' => $request->keterangan,
            'jenis_potongan' => $request->jenis_potongan,
            'nilai_potongan' => $request->nilai_potongan,
            'periode' => $request->periode,
            'status' => $request->status,
        ]);

        Alert::success('Success', 'Data Promo berhasil diubah!');
        return redirect()->route('kepala-klinik.index-promo');

    } catch (Exception $e) {
        Alert::error('Error', 'Data Promo gagal diubah!');
        return redirect()->route('kepala-klinik.index-promo');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promos = Promo::find($id);
        $promos->delete();

        Alert::success('Success', 'Data Promo berhasil dihapus!');
        return redirect()->route('kepala-klinik.index-promo');
    }
}
