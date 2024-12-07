<?php

namespace App\Http\Controllers;

use App\Models\DetailPerawatan;
use App\Models\DetailProduk;
use App\Models\Pegawai;
use App\Models\Perawatan;
use App\Models\Produk;
use App\Models\Ruangan;
use App\Models\Transaksi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PemeriksaanController extends Controller
{
    /**
     * Display Pemeriksaan Queue -> 
     * Criteria : It should be 'with consultation' type with ruangan_id get filled (Perawatan) or has detailProduk min 1 (Produk)
     */
    public function index()
    {
        $transaksis = Transaksi::where('dokter_id', Auth::guard('pegawai')->user()->id)
            ->whereIn('jenis_transaksi', [
                'Perawatan dengan Konsultasi',
                'Produk dengan Konsultasi'
            ])
            ->where('status_pembayaran', 'Pending')
            ->where('status_pemeriksaan', 'Pending')
            ->orderBy('tanggal_transaksi', 'asc')
            ->with(['customer', 'detailProduk'])
            ->get();

        return view('core.dokter.home', compact('transaksis'))->with([
            'title' => 'Dokter | Home'
        ]);
    }

    /**
     * Display Riwayat Customer -> params : id transaksi
     */
    public function getRiwayatPemeriksaan($id)
    {
        $transaksi = Transaksi::find($id);
        $customer = User::find($transaksi->customer_id);

        $riwayats = Transaksi::where('status_pembayaran', 'Paid')
            ->where('customer_id', $customer->id)
            ->get();

        return view('core.dokter.riwayat-pemeriksaan', compact('customer', 'riwayats'))->with([
            'title' => 'Dokter | Riwayat Pemeriksaan'
        ]);
    }

    /**
     * Mark as Done Pemeriksaan -> params : id transaksi, 'Pending' -> 'Checked'
     */
    public function markAsDone($id)
    {
        $transaksi = Transaksi::find($id);

        $totalDetailProduk = DetailProduk::where('transaksi_id', $transaksi->id)->sum('sub_total');
        $totalDetailPerawatan = DetailPerawatan::where('transaksi_id', $transaksi->id)->sum('sub_total');

        $transaksi->status_pemeriksaan = 'Checked';
        $transaksi->total_harga = $totalDetailProduk + $totalDetailPerawatan;
        $transaksi->save();

        Alert::success('Success', 'Data Pemeriksaan berhasil diselesaikan!');
        return redirect()->route('dokter.queue');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_input_perawatan($id)
    {
        $transaksi = Transaksi::with('customer')->find($id);
        $perawatans = Perawatan::where('tipe', 'Konsultasi')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->where('status', 'Available')->get();
        $ruangans = Ruangan::where('status', 'Available')->get();

        return view('core.dokter.pemeriksaan-perawatan.create', compact('perawatans', 'beauticians', 'ruangans', 'transaksi'))->with([
            'title' => 'Dokter | Input Pemeriksaan Perawatan'
        ]);
    }

    public function create_input_produk($id)
    {
        $transaksi = Transaksi::with('customer')->find($id);
        $produks = Produk::all();

        return view('core.dokter.pemeriksaan-produk.create', compact('produks', 'transaksi'))->with([
            'title' => 'Dokter | Input Pemeriksaan Produk'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_input_perawatan(Request $request)
    {
        $request->validate([
            'perawatan' => 'required',
            'ruangan' => 'required',
            'beautician' => 'required',
            'id_transaksi' => 'required'
        ]);

        $transaksi = Transaksi::find($request->id_transaksi);
        $ruangan = Ruangan::find($request->ruangan);
        $beautician = Pegawai::find($request->beautician);
        $perawatan = Perawatan::find($request->perawatan);

        try {
            $transaksi->ruangan_id = $request->ruangan;
            $transaksi->beautician_id = $request->beautician;
            $transaksi->save();

            $ruangan->status = 'Assigned';
            $ruangan->assign_to = $request->beautician;
            $ruangan->save();

            $beautician->status = 'Assigned';
            $beautician->save();

            DetailPerawatan::create([
                'jumlah_pembelian' => 1,
                'jumlah_tukar_point' => 0,
                'sub_total' => $perawatan->harga,
                'perawatan_id' => $perawatan->id,
                'transaksi_id' => $transaksi->id
            ]);
            Alert::success('Success', 'Data Pemeriksaan berhasil ditambahkan!');
            return redirect()->route('dokter.queue');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Pemeriksaan gagal ditambahkan!');
            return redirect()->route('dokter.queue');
        }
    }

    public function store_input_produk(Request $request)
    {
        $request->validate([
            'produk' => 'required',
            'jumlah' => 'required',
            'id_transaksi' => 'required'
        ]);

        $produk = Produk::find($request->produk);
        $transaksi = Transaksi::find($request->id_transaksi);

        try {
            DetailProduk::create([
                'jumlah_pembelian' => $request->jumlah,
                'sub_total' => $request->jumlah * $produk->harga,
                'produk_id' => $produk->id,
                'transaksi_id' => $transaksi->id
            ]);
            Alert::success('Success', 'Data Pemeriksaan berhasil ditambahkan!');
            return redirect()->route('dokter.queue');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Pemeriksaan gagal ditambahkan!');
            return redirect()->route('dokter.queue');
        }
    }

    public function edit_pemeriksaan_perawatan($id)
    {
        $detailPerawatan = DetailPerawatan::with('perawatan')->with('transaksi')->where('transaksi_id', $id)->first();
        $perawatans = Perawatan::where('tipe', 'Konsultasi')->get();
        $beauticians = Pegawai::where('role', 'Beautician')->get();
        $ruangans = Ruangan::all();

        return view('core.dokter.pemeriksaan-perawatan.edit', compact('detailPerawatan', 'perawatans', 'ruangans', 'beauticians'))->with([
            'title' => 'Dokter | Update Pemeriksaan Perawatan'
        ]);
    }

    public function update_pemeriksaan_perawatan(Request $request, $id)
    {
        $request->validate([
            'perawatan' => 'required',
            'ruangan' => 'required',
            'beautician' => 'required'
        ]);

        $detailPerawatan = DetailPerawatan::find($id);
        $transaksi = Transaksi::find($detailPerawatan->transaksi_id);
        $oldRuangan = Ruangan::find($transaksi->ruangan_id);
        $oldBeautician = Pegawai::find($transaksi->beautician_id);

        $newRuangan = Ruangan::find($request->ruangan);
        $newBeautician = Pegawai::find($request->beautician);
        $perawatan = Perawatan::find($request->perawatan);

        try {
            // Reset old Ruangan and Beautician status
            if ($oldRuangan) {
                $oldRuangan->status = 'Available';
                $oldRuangan->assign_to = null;
                $oldRuangan->save();
            }

            if ($oldBeautician) {
                $oldBeautician->status = 'Available';
                $oldBeautician->save();
            }

            // Update transaksi with new Ruangan and Beautician
            $transaksi->ruangan_id = $request->ruangan;
            $transaksi->beautician_id = $request->beautician;
            $transaksi->save();

            // Update new Ruangan and Beautician status
            $newRuangan->status = 'Assigned';
            $newRuangan->assign_to = $request->beautician;
            $newRuangan->save();

            $newBeautician->status = 'Assigned';
            $newBeautician->save();

            // Update detail perawatan
            $detailPerawatan->jumlah_pembelian = 1;
            $detailPerawatan->sub_total = $perawatan->harga;
            $detailPerawatan->perawatan_id = $perawatan->id;
            $detailPerawatan->save();

            Alert::success('Success', 'Data Pemeriksaan berhasil diperbarui!');
            return redirect()->route('dokter.queue');
        } catch (Exception $e) {
            Alert::error('Error', 'Data Pemeriksaan gagal diperbarui!');
            return redirect()->route('dokter.queue');
        }
    }


    public function edit_pemeriksaan_produk($id)
    {
        $transaksi = Transaksi::with('customer')->find($id);
        $detailProduks = DetailProduk::with('produk')->with('transaksi')->where('transaksi_id', $id)->get();
        $produks = Produk::all();
        return view('core.dokter.pemeriksaan-produk.edit', compact('detailProduks', 'produks', 'transaksi'))->with([
            'title' => 'Dokter | Update Pemeriksaan Produk'
        ]);
    }

    public function update_jumlah_produk(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Find the specific detailProduk by its ID
        $detailProduk = DetailProduk::findOrFail($id);

        // Check if jumlah is zero; if yes, delete the record
        if ((int)$validated['jumlah'] === 0) {
            $detailProduk->delete();

            Alert::success('Success', 'Data Detail Produk berhasil diubah!');
            return redirect()->back();
        }

        // Otherwise, update the jumlah_pembelian
        $detailProduk->jumlah_pembelian = $validated['jumlah'];
        $detailProduk->save();

        Alert::success('Success', 'Data Detail Produk berhasil diubah!');
        return redirect()->back();
    }

    public function delete_produk($id)
    {
        // Find the specific detailProduk by its ID
        $detailProduk = DetailProduk::findOrFail($id);

        // Delete the record
        $detailProduk->delete();

        Alert::success('Success', 'Data Detail Produk berhasil dihaous!');
        return redirect()->back();
    }
}
