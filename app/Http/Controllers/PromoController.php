<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = Promo::all();

        return view('core.kepala-klinik.data-promo.index', compact('promos'))->with([
            'title' => 'Kepala Klinik | Promo'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core.kepala-klinik.data-promo.create')->with([
            'title' => 'Kepala Klinik | Tambah Promo'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required'
        ]);

        try {
            Promo::create([
                'kode' => $request->kode,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan
            ]);
            Alert::success('Success', 'Data Promo berhasil ditambahkan!');
            return redirect()->route('kepala-klinik.index-promo');

        } catch(Exception $e) {
            Alert::error('Error', 'Data Promo gagal ditambahkan!');
            return redirect()->route('kepala-klinik.index-promo');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('core.kepala-klinik.data-promo.edit', compact('promo'))->with([
            'title' => 'Kepala Klinik | Update Promo'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $promo = Promo::find($id);
        $request->validate([
            'kode' => 'required',
            'jenis' => 'required',
            'keterangan' => 'required'
        ]);

        try {
            $promo->update([
                'kode' => $request->kode,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan
            ]);
            Alert::success('Success', 'Data Promo berhasil diubah!');
            return redirect()->route('kepala-klinik.index-promo');

        } catch(Exception $e) {
            Alert::error('Error', 'Data Promo gagal diubah!');
            return redirect()->route('kepala-klinik.index-promo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $promo = Promo::find($id);
        $promo->delete();

        Alert::success('Success', 'Data Promo berhasil dihapus!');
        return redirect()->route('kepala-klinik.index-promo');
    }
}
