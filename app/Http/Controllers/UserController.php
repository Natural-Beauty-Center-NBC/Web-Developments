<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rules;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $users = User::where('nama', 'LIKE', '%' . $query . '%')->get();

        return view('core.customer-service.data-customer.index', compact('users'))->with([
            'title' => 'Customer Service | Customer'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('core.customer-service.data-customer.detail', compact('user'))->with([
            'title' => 'Customer Service | Detail Customer'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core.customer-service.data-customer.create')->with([
            'title' => 'Customer Service | Tambah Customer'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:' . User::class],
            'tanggal_lahir' => ['required'],
            'gender' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'min_digits:12'],
            'alergi' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = User::create([
                'id_customer' => '-',
                'nama' => $request->nama,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->gender,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'alergi' => $request->alergi ?? 'Tidal Ada',
                'password' => Hash::make($request->password)
            ]);
            $birthDate = Carbon::parse($request->tanggal_lahir);
            $currentMonth = Carbon::now()->format('m'); // Registration month
            $currentYear = Carbon::now()->format('y'); // Registration year

            $idCustomer = $currentMonth . $currentYear . $birthDate->format('dmy') . $user->id;
            $user->update(['id_customer' => $idCustomer]);


            Alert::success('Success', 'Data Customer berhasil ditambahkan!');
            return redirect()->route('customer-service.index-customer');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Customer gagal ditambahkan!');
            return redirect()->route('customer-service.index-customer');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('core.customer-service.data-customer.edit', compact('user'))->with([
            'title' => 'Customer Service | Update Customer'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:' . User::class],
            'tanggal_lahir' => ['required'],
            'gender' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'numeric', 'min_digits:12'],
            'alergi' => ['nullable', 'string']
        ]);

        try {
            $user->update([
                'id_customer' => $user->id_customer,
                'nama' => $request->nama,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->gender,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'alergi' => $request->alergi ?? 'Tidak Ada',
                'password' => $user->password
            ]);
            Alert::success('Success', 'Data Customer berhasil diubah!');
            return redirect()->route('customer-service.index-customer');
        } catch (Exception $e) {
            Alert::success('Success', 'Data Customer gagal diubah!');
            return redirect()->route('customer-service.index-customer');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Alert::success('Success', 'Data Customer berhasil dihapus!');
        return redirect()->route('customer-service.index-customer');
    }

    /**
     * Generate Customer's Card.
     */
    public function generateCustomerCard($id)
    {
        $user = User::find($id);
        // Load the view into the PDF
        $pdf = Pdf::loadView('components.customer-card', compact('user'))->setPaper('a4', 'portrait');

        // Return the PDF for download
        return $pdf->download($user->nama . "_nbc_membership_card.pdf");
    }
}
