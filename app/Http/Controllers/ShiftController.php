<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('core.kepala-klinik.data-shift.index', compact('shifts'))->with([
            'title' => 'Kepala Klinik | Shift'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core.kepala-klinik.data-shift.create')->with([
            'title' => 'Kepala Klinik | Tambah Shift'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        try {
            Shift::create([
                'nama' => $request->nama,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at
            ]);
            Alert::success('Success', 'Data Shift berhasil ditambahkan!');
            return redirect()->route('kepala-klinik.index-shift');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Shift gagal ditambahkan!');
            return redirect()->route('kepala-klinik.index-shift');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('core.kepala-klinik.data-shift.edit', compact('shift'))->with([
            'title' => 'Kepala Klinik | Update Shift'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);

        $request->validate([
            'nama' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        try {
            $shift->update([
                'nama' => $request->nama,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at
            ]);
            Alert::success('Success', 'Data Shift berhasil diubah!');
            return redirect()->route('kepala-klinik.index-shift');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Shift gagal diubah!');
            return redirect()->route('kepala-klinik.index-shift');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);
        $shift->delete();

        Alert::success('Success', 'Data Shift berhasil dihapus!');
        return redirect()->route('kepala-klinik.index-shift');
    }
}
