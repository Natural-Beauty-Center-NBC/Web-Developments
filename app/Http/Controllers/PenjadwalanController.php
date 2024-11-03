<?php

namespace App\Http\Controllers;

use App\Models\hari;
use App\Models\Pegawai;
use App\Models\Penjadwalan;
use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjadwalans = Penjadwalan::all();
        return view('core.kepala-klinik.data-penjadwalan.index', compact('penjadwalans'))->with([
            'title' => 'Kepala Klinik | Penjadwalan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokters = Pegawai::where('role', 'Dokter')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->get();
        $haris = hari::all();
        $shifts = Shift::all();

        return view('core.kepala-klinik.data-penjadwalan.create', compact('dokters', 'beauticians', 'haris', 'shifts'))->with([
            'title' => 'Kepala Klinik | Create Penjadwalan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai' => 'required',
            'shift' => 'required',
            'hari' => 'required'
        ]);

        // Fetch the pegawai's data
        $pegawai = Pegawai::find($request->pegawai);

        // Checking Penjadwalan Condition (Has limit of 6 schedule each and dont has duplicated schedule)
        $limitJadwal = Penjadwalan::where('pegawai_id', $request->pegawai)->count() > 6;
        $duplicateJadwal = Penjadwalan::where('pegawai_id', $request->pegawai)
            ->where('shift_id', $request->shift)
            ->where('hari_id', $request->hari)
            ->exists();

        if ($limitJadwal) {
            Alert::warning('Warning', 'Jadwal Pegawai [' . $pegawai->nama . '] telah mencapai maksimum (6 Jadwal)!');
            return redirect()->back();
        }

        if ($duplicateJadwal) {
            Alert::warning('Warning', 'Jadwal Pegawai [' . $pegawai->nama . '] tidak bisa duplikat!');
            return redirect()->back();
        }

        try {
            Penjadwalan::create([
                'pegawai_id' => $request->pegawai,
                'shift_id' => $request->shift,
                'hari_id' => $request->hari
            ]);
            Alert::success('Success', 'Data Jadwal [' . $pegawai->nama . '] berhasil ditambahkan!');
            return redirect()->route('kepala-klinik.index-penjadwalan');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Jadwal [' . $pegawai->nama . '] gagal ditambahkan!');
            return redirect()->route('kepala-klinik.index-penjadwalan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penjadwalan = Penjadwalan::find($id);
        $dokters = Pegawai::where('role', 'Dokter')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->get();
        $haris = hari::all();
        $shifts = Shift::all();

        return view('core.kepala-klinik.data-penjadwalan.edit', compact('penjadwalan', 'dokters', 'beauticians', 'haris', 'shifts'))->with([
            'title' => 'Kepala Klinik | Update Penjadwalan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penjadwalan = Penjadwalan::find($id);

        $request->validate([
            'pegawai' => 'required',
            'shift' => 'required',
            'hari' => 'required'
        ]);

        $duplicateJadwal = Penjadwalan::where('pegawai_id', $request->pegawai)
            ->where('shift_id', $request->shift)
            ->where('hari_id', $request->hari)
            ->exists();

        if ($duplicateJadwal) {
            Alert::warning('Warning', 'Jadwal Pegawai [' . $penjadwalan->pegawai->nama . '] tidak bisa duplikat!');
            return redirect()->back();
        }

        try {
            $penjadwalan->update([
                'pegawai_id' => $request->pegawai,
                'shift_id' => $request->shift,
                'hari_id' => $request->hari
            ]);
            Alert::success('Success', 'Data Jadwal [' . $penjadwalan->pegawai->nama . '] berhasil diubah!');
            return redirect()->route('kepala-klinik.index-penjadwalan');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Jadwal [' . $penjadwalan->pegawai->nama . '] gagal diubah!');
            return redirect()->route('kepala-klinik.index-penjadwalan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjadwalan = Penjadwalan::find($id);
        Alert::success('Success', 'Data Jadwal [' . $penjadwalan->pegawai->nama . '] berhasil dihapus!');

        $penjadwalan->delete();
        return redirect()->route('kepala-klinik.index-penjadwalan');
    }
}
