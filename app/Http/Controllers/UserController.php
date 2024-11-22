<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk menggunakan Hash

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        $alert = null;  // Default $alert jika tidak ada alert

        return view('core.customer-service.pendaftaran-user.index', compact('users', 'alert'))->with([
            'title' => 'Daftar User'
        ]);
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('core.customer-service.pendaftaran-user.create')->with([
            'title' => 'Tambah Data User'
        ]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Pria,Wanita', // Mengubah validasi menjadi 'Pria' dan 'Wanita'
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'alergi' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mendapatkan tanggal pendaftaran
        $tanggalPendaftaran = Carbon::now();
        $bulanPendaftaran = $tanggalPendaftaran->format('m');
        $tahunPendaftaran = $tanggalPendaftaran->format('y');

        // Mendapatkan tanggal lahir dari input
        $tanggalLahir = Carbon::parse($request->tanggal_lahir);
        $tglLahir = $tanggalLahir->format('d');
        $blnLahir = $tanggalLahir->format('m');
        $thnLahir = $tanggalLahir->format('Y');

        // Menghitung nomor urut berdasarkan pendaftaran di bulan dan tahun yang sama
        $lastUser = User::whereYear('created_at', $tanggalPendaftaran->year)
                        ->whereMonth('created_at', $tanggalPendaftaran->month)
                        ->orderBy('created_at', 'desc')
                        ->first();

        $nomorUrut = $lastUser ? ((int)substr($lastUser->id_customer, -1) + 1) : 1;

        // Format ID Customer
        $idCustomer = "{$bulanPendaftaran}{$tahunPendaftaran}{$tglLahir}{$blnLahir}{$thnLahir}{$nomorUrut}";

        try {
            // Simpan data user
            User::create([
                'nama' => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin, // Menyimpan "Pria" atau "Wanita"
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'alergi' => $request->alergi,
                'id_customer' => $idCustomer,
                'password' => Hash::make($request->password), // Menggunakan Hash::make
            ]);

            Alert::success('Success', 'User berhasil ditambahkan!');
            return redirect()->route('user-service.index'); // Disesuaikan dengan nama route
        } catch (Exception $e) {
            Alert::error('Error', 'Gagal menambahkan user! Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Menampilkan kartu user
    public function showCard($id)
    {
        $user = User::findOrFail($id);
        return view('core.customer-service.pendaftaran-user.card', compact('user'))->with([
            'title' => 'Customer Service | User Card'
        ]);
    }

    // Menampilkan form untuk mengedit data user
    public function edit($id)
    {
        $user = User::find($id);
        return view('core.customer-service.pendaftaran-user.edit', compact('user'))->with([
            'title' => 'Customer Service | Update User'
        ]);
    }

    // Menyimpan perubahan data user
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Wanita', // Mengubah validasi menjadi 'Pria' dan 'Wanita'
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'alergi' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $data = $request->all();
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password); // Menggunakan Hash::make
            } else {
                unset($data['password']);
            }

            $user->update($data);

            Alert::success('Success', 'Data User berhasil diubah!');
            return redirect()->route('user-service.index'); // Disesuaikan dengan nama route
        } catch (Exception $e) {
            Alert::error('Error', 'Gagal mengubah data user! Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Mencari data user berdasarkan kriteria tertentu
    public function search(Request $request)
    {
        $query = $request->get('query');
        $users = User::where('nama', 'LIKE', "%{$query}%")
                    ->orWhere('no_telp', 'LIKE', "%{$query}%")
                    ->get();

        $alert = $users->isEmpty() ? "Data user dengan kata kunci '{$query}' tidak ditemukan." : null;

        return view('core.customer-service.pendaftaran-user.index', compact('users', 'query', 'alert'))->with([
            'title' => 'Cari User',
        ]);
    }
}
