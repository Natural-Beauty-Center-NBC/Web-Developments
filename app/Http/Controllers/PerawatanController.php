<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $query = $request->input('query', '');

    
    $perawatans = Perawatan::where('nama', 'LIKE', '%' . $query . '%')->paginate(10); 

    return view('core.admin.data-perawatan.index', compact('perawatans'))->with([
        'title' => 'Admin | Perawatan'
    ]);
    }

    public function show($id)
    {
        $perawatan = Perawatan::find($id);
        return view('core.admin.data-perawatan.show', compact('perawatan'))->with([
            'title'=>'Admin | Show Perawatan'
        ]);
    }

    public function create()
    {
        return view('core.admin.data-perawatan.create')->with([
            'title' => 'Admin | Tambah Perawatan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'jumlah_potongan_poin' => 'required',
            'tipe' => 'required'
        ]);

        try {
            Perawatan::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'jumlah_potongan_poin' => $request->jumlah_potongan_poin,
                'tipe' => $request->tipe
            ]);
            Alert::success('Success', 'Data Perawatan berhasil ditambahkan!');
            return redirect()->route('admin.index-perawatan');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Perawatan gagal ditambahkan!');
            return redirect()->route('admin.index-perawatan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $perawatan = Perawatan::find($id);
        return view('core.admin.data-perawatan.edit', compact('perawatan'))->with([
            'title' => 'Admin | Update Perawatan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $perawatan = Perawatan::find($id);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'jumlah_potongan_poin' => 'required',
            'tipe' => 'required'
        ]);

        try {
            $perawatan->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'jumlah_potongan_poin' => $request->jumlah_potongan_poin,
                'tipe' => $request->tipe
            ]);
            Alert::success('Success', 'Data Perawatan berhasil diubah!');
            return redirect()->route('admin.index-perawatan');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Perawatan gagal diubah!');
            return redirect()->route('admin.index-perawatan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $perawatan = Perawatan::find($id);
        $perawatan->delete();

        Alert::success('Success', 'Data Perawatan berhasil dihapus!');
        return redirect()->route('admin.index-perawatan');
    }
}
