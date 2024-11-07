<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Perawatan;
use App\Models\Ruangan;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function create()
    {
        return view('core.customer-service.pendaftaran-transaksi.create')->with([
            'title' => 'Customer Service | Tambah Transaksi'
        ]);
    }

    public function transaksi_dengan_konsultasi(string $tipe)
    {
        $dokters = Pegawai::where('role', 'Dokter')->where('status', 'Available')->get();
        return view('core.customer-service.pendaftaran-transaksi.transaksi-dengan-konsultasi', compact('dokters', 'tipe'))->with([
            'title' => 'Customer Service | Transaksi dengan Konsultasi'
        ]);
    }

    public function transaksi_tanpa_konsultasi()
    {
        $perawatans = Perawatan::where('tipe', 'Non-Konsultasi')->get();
        $ruangans = Ruangan::where('status', 'Available')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->where('status', 'Available')->get();
        return view('core.customer-service.pendaftaran-transaksi.transaksi-tanpa-konsultasi', compact('perawatans', 'ruangans', 'beauticians'))->with([
            'title' => 'Customer Service | Transaksi tanpa Konsultasi'
        ]);
    }

    public function store_dengan_konsultasi(Request $request)
    {
        $request->validate([
            'id_customer' => 'required',
            'tipe_pendaftaran' => 'required',
            'dokter' => 'required',
            'cs' => 'required'
        ]);

        // Checking 'is the customer's data exist?' based on id_customer (Unique)
        $customer = User::where('id_customer', $request->id_customer)->first();
        if (!$customer) {
            Alert::warning('Warning', 'Customer dengan ID [' . $request->id_customer . '] tidak ditemukan!');
            return redirect()->back();
        }

        // Get current date details
        $date = Carbon::now();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('y');
        $time = $date->format('H:i');

        // Create the first part of Transaction Number with format d-m-y
        $dateSeries = $day . $month . $year;

        try {
            Transaksi::create([
                'no_transaksi' => '-', // Placeholder for now
                'jenis_transaksi' => $request->tipe_pendaftaran,
                'tanggal_transaksi' => $date,
                'customer_id' => $customer->id,
                'dokter_id' => $request->dokter,
                'customer_service_id' => $request->cs
            ]);

            // Update the no_transaksi with existing data's id -> Generate the no_transaksi based on format [ddMMyy-id]
            $transaksi = Transaksi::orderBy('created_at', 'desc')->first();
            $transaksi->no_transaksi = $dateSeries . '-' . $transaksi->id;
            $transaksi->save();

            // Update Dokter's status 
            $dokter = Pegawai::find($request->dokter);
            $dokter->status = 'Assigned';
            $dokter->save();

            Alert::success('Success', 'Data Transaksi Customer [' . $request->id_customer . '] berhasil ditambahkan!');
            return redirect()->route('customer-service.create-transaksi');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Transaksi Customer [' . $request->id_customer . '] gagal ditambahkan!');
            return redirect()->route('customer-service.create-transaksi');
        }
    }

    public function store_tanpa_konsultasi(Request $request)
    {
        $request->validate([
            'id_customer' => 'required',
            'perawatan' => 'required',
            'ruangan' => 'required',
            'beautician' => 'required',
            'cs' => 'required'
        ]);

        // Checking 'is the customer's data exist?' based on id_customer (Unique)
        $customer = User::where('id_customer', $request->id_customer)->first();
        if (!$customer) {
            Alert::warning('Warning', 'Customer dengan ID [' . $request->id_customer . '] tidak ditemukan!');
            return redirect()->back();
        }

        // Get current date details
        $date = Carbon::now();
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('y');
        $time = $date->format('H:i');

        // Create the first part of Transaction Number with format d-m-y
        $dateSeries = $day . $month . $year;

        try {
            // Create the transaction record
            Transaksi::create([
                'no_transaksi' => '-', // Placeholder for now
                'jenis_transaksi' => 'Perawatan tanpa Konsultasi',
                'tanggal_transaksi' => $date,
                'customer_id' => $customer->id,
                'beautician_id' => $request->beautician,
                'customer_service_id' => $request->cs, 
                'ruangan_id' => $request->ruangan
            ]);

            // Update the no_transaksi with existing data's id -> Generate the no_transaksi based on format [ddMMyy-id]
            $transaksi = Transaksi::orderBy('created_at', 'desc')->first();
            $transaksi->no_transaksi = $dateSeries . '-' . $transaksi->id;
            $transaksi->save();

            // Update ruangan's status and assign to
            $ruangan = Ruangan::find($request->ruangan);
            $ruangan->assign_to = $request->beautician;
            $ruangan->status = 'Assigned';
            $ruangan->save();

            // Update beautician's status 
            $beautician = Pegawai::find($request->beautician);
            $beautician->status = 'Assigned';
            $beautician->save();

            Alert::success('Success', 'Data Transaksi Customer [' . $request->id_customer . '] berhasil ditambahkan!');
            return redirect()->route('customer-service.create-transaksi');

        } catch (Exception $e) {
            Alert::error('Error', 'Data Transaksi Customer [' . $request->id_customer . '] gagal ditambahkan!');
            return redirect()->route('customer-service.create-transaksi');
        }
    }
}