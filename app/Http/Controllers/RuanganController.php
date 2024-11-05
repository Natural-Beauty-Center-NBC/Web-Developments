<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Ruangan;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query', ''); // Retrieve the search query

        // Filter employees based on the search query
        $ruangans = Ruangan::where('no_ruangan', 'LIKE', '%' . $query . '%')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->get();
        return view('core.admin.data-ruangan.index', compact('ruangans', 'beauticians'))->with([
            'title' => 'Admin | Ruangan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ruangan' => 'required',
        ]);

        $duplicateRuangan = Ruangan::where('no_ruangan', $request->no_ruangan)->exists();
        if ($duplicateRuangan) {
            Alert::warning('Warning', 'Nomor Ruangan tidak bisa diduplikat!');
            return redirect()->back();
        }

        try {
            Ruangan::create([
                'no_ruangan' => $request->no_ruangan,
                'status' => 'Available'
            ]);
            Alert::success('Success', 'Data Ruangan berhasil ditambahkan!');
            return redirect()->route('admin.index-ruangan');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Ruangan gagal ditambahkan!');
            return redirect()->route('admin.index-ruangan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'assign_to' => 'nullable',
        ]);

        try {
            $ruangan = Ruangan::findOrFail($id);

            if ($request->assign_to) {
                // Update the newly assigned Pegawai's status to 'Assigned'
                $pegawai = Pegawai::find($request->assign_to);
                if ($pegawai) {
                    $pegawai->status = 'Assigned';
                    $pegawai->save();
                }

                // Set previous Pegawai's status to 'Available' if it exists
                if ($ruangan->assign_to) {
                    $previous = Pegawai::find($ruangan->assign_to);
                    if ($previous) {
                        $previous->status = 'Available';
                        $previous->save();
                    }
                }
            } else {
                // If no new assignment, only update previous Pegawai if assigned
                if ($ruangan->assign_to) {
                    $previous = Pegawai::find($ruangan->assign_to);
                    if ($previous) {
                        $previous->status = 'Available';
                        $previous->save();
                    }
                }
            }

            $ruangan->assign_to = $request->assign_to;
            $ruangan->status = $request->assign_to ? 'Assigned' : 'Available';
            $ruangan->save();
            return response()->json(['success' => true]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        $pegawai = Pegawai::find($ruangan->assign_to);
        if ($pegawai) {
            $pegawai->status = 'Available';
            $pegawai->save();
        }
        $ruangan->delete();

        Alert::success('Success', 'Data Ruangan berhasil dihapus!');
        return redirect()->route('admin.index-ruangan');
    }
}
