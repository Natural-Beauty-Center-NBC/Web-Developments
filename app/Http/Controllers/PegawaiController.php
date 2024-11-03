<?php

namespace App\Http\Controllers;

use App\Models\hari;
use App\Models\Pegawai;
use App\Models\Penjadwalan;
use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
{
    // ADMIN ROLE :
    public function index_admin()
    {
        $admin = Auth::guard('pegawai')->user();
        return view('core.admin.layouts.main', compact('admin'))->with([
            'title' => 'Admin | Home'
        ]);
    }

    public function index_data_pegawai(Request $request)
    {
        $query = $request->input('query', ''); // Retrieve the search query

        // Filter employees based on the search query
        $pegawais = Pegawai::where('role', '!=', 'Admin')
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('nama', 'LIKE', '%' . $query . '%');
            })
            ->get();

        return view('core.admin.data-pegawai.index', compact('pegawais'))->with([
            'title' => 'Admin | Pegawai'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_data_pegawai()
    {
        return view('core.admin.data-pegawai.create')->with([
            'title' => 'Admin | Create Pegawai'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_data_pegawai(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|min_digits:12',
            'role' => 'required',
            'status' => 'required',
            'password' => 'required'
        ]);

        try {
            Pegawai::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'role' => $request->role,
                'status' => $request->status,
                'password' => Hash::make($request->password)
            ]);
            Alert::success('Success', 'Data Pegawai berhasil ditambahkan!');
            return redirect()->route('admin.index-pegawai');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Pegawai gagal ditambahkan!');
            return redirect()->route('admin.index-pegawai');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_data_pegawai($id)
    {
        $pegawai = Pegawai::find($id);
        return view('core.admin.data-pegawai.edit', compact('pegawai'))->with([
            'title' => 'Admin | Update Pegawai'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_data_pegawai(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|min_digits:12',
            'role' => 'required',
            'status' => 'required',
            'password' => 'required'
        ]);

        try {
            $pegawai->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'role' => $request->role,
                'status' => $request->status,
                'password' => Hash::make($request->password)
            ]);
            Alert::success('Success', 'Data Pegawai berhasil diubah!');
            return redirect()->route('admin.index-pegawai');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Pegawai gagal diubah!');
            return redirect()->route('admin.index-pegawai');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_data_pegawai($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        Alert::success('Success', 'Data Pegawai berhasil dihapus!');
        return redirect()->route('admin.index-pegawai');
    }

    // DOKTER ROLE :
    public function index_dokter()
    {
        $dokter = Auth::guard('pegawai')->user();
        return view('core.admin.home', compact('dokter'))->with([
            'title' => 'Dokter'
        ]);
    }

    // KEPALA KLINIK ROLE :
    public function home_kepala_klinik()
    {
        $haris = hari::all();
        $shifts = Shift::all();
        $dokters = Penjadwalan::whereHas('pegawai', function ($query) {
            $query->where('role', 'Dokter');
        })
            ->select('shift_id', 'hari_id', 'pegawai_id') // Select fields for grouping
            ->groupBy('shift_id', 'hari_id', 'pegawai_id') // Group by shift_id and hari_id
            ->with('pegawai') // Load pegawai data
            ->get();
        $beauticians = Penjadwalan::whereHas('pegawai', function ($query) {
            $query->where('role', 'Beautician');
        })
            ->select('shift_id', 'hari_id', 'pegawai_id') // Select fields for grouping
            ->groupBy('shift_id', 'hari_id', 'pegawai_id') // Group by shift_id and hari_id
            ->with('pegawai') // Load pegawai data
            ->get();


        return view('core.kepala-klinik.home', compact('dokters', 'beauticians', 'haris', 'shifts'))->with([
            'title' => 'Kepala Klinik | Home'
        ]);
    }

    // CUSTOMER SERVICE ROLE :

    // KASIR ROLE :

    // DSB .....
}
