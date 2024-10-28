<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    // ADMIN ROLE :
    public function index_admin()
    {
        $admin = Auth::guard('pegawai')->user();
        return view('core.admin.home', compact('admin'))->with([
            'title' => 'Admin | Home'
        ]);
    }

    public function index_data_pegawai()
    {
        $pegawais = Pegawai::where('role', '!=', 'Admin')->get();
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
            "nama" => "required",
            "email" => "required|email",
            'alamat' => 'required',
            "no_telp" => "required|numeric|min_digits:12",
            "role" => "required",
            "status" => "required",
            "password" => "required"
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
            return redirect()->route('admin.index-pegawai');

        } catch (Exception $e) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    // CUSTOMER SERVICE ROLE :

    // KASIR ROLE :

    // DSB .....
}
