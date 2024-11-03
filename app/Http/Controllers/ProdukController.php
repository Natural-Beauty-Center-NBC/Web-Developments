<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('core.admin.data-produk.index', compact('produks'))->with([
            'title' => 'Admin | Produk'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core.admin.data-produk.create')->with([
            'title' => 'Admin | Tambah Produk'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'ukuran' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        try {
            Produk::create($request->all());
            Alert::success('Success', 'Data Produk berhasil ditambahkan!');
            return redirect()->route('admin.index-produk');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Produk gagal ditambahkan!');
            return redirect()->route('admin.index-produk');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('core.admin.data-produk.edit', compact('produk'))->with([
            'title' => 'Admin | Update Produk'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'ukuran' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        try {
            $produk->update($request->all());
            Alert::success('Success', 'Data Produk berhasil diubah!');
            return redirect()->route('admin.index-produk');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Produk gagal diubah!');
            return redirect()->route('admin.index-produk');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        try {
            Alert::success('Success', 'Data Produk berhasil dihapus!');
            return redirect()->route('admin.index-produk');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Produk gagal dihapus!');
            return redirect()->route('admin.index-produk');
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $produks = Produk::where('nama', 'like', "%{$query}%")->get();
        return view('core.admin.data-produk.index', compact('produks'))->with([
            'title' => 'Admin | Search Produk'
        ]);
    }
}