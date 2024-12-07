<?php

namespace App\Http\Controllers;

use App\Models\DetailPerawatan;
use App\Models\DetailProduk;
use App\Models\Promo;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    /**
     * Display a list of Transactiopn with status 'Pending'
     */
    public function index()
    {
        $transaksis = Transaksi::where('status_pembayaran', 'Pending')
            ->where('status_pemeriksaan', 'Checked')
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        return view('core.kasir.home', compact('transaksis'))->with([
            'title' => 'Kasir | Daftar Pembayaran Transaksi'
        ]);
    }

    /**
     * Display a list of Transactiopn with status 'Paid'
     */
    public function index_paid()
    {
        $transaksis = Transaksi::where('status_pembayaran', 'Paid')
            ->where('status_pemeriksaan', 'Checked')
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();

        return view('core.kasir.home-paid', compact('transaksis'))->with([
            'title' => 'Kasir | Daftar Transaksi Lunas'
        ]);
    }

    /**
     * Display Pembayaran Screen
     */
    public function create(Request $request, $id)
    {
        $transaksi = Transaksi::with('customer')->find($id);
        $detailProduks = DetailProduk::with('produk')->where('transaksi_id', $transaksi->id)->get();
        $detailPerawatans = DetailPerawatan::with('perawatan')->where('transaksi_id', $transaksi->id)->get();
        $promos = Promo::all();

        $selectedPromoId = $request->input('promo', 5);
        $selectedPromo = $promos->find($selectedPromoId);
        $promoResult = $this->calculateDiscount($transaksi, $selectedPromo);

        if ($selectedPromo && $selectedPromo->kode === 'POIN') {
            $transaksi->poin_earned = $promoResult;
            $transaksi->diskon = 0; // Ensure diskon is 0 for POIN

        } else {
            $originalTotal = $transaksi->total_harga + $transaksi->diskon;
            if ($promoResult == 0) {
                $transaksi->diskon = $promoResult;
                $transaksi->total_harga = $originalTotal;
                $transaksi->poin_earned = 0; // Ensure poin_earned is 0 for other promos;
            } else {
                $transaksi->diskon = $promoResult;
                $transaksi->total_harga =  $originalTotal - $promoResult;
                $transaksi->poin_earned = 0; // Ensure poin_earned is 0 for other promos;
            }
        }
        $transaksi->promo_id = $selectedPromoId;
        $transaksi->save();

        return view('core.kasir.pembayaran-transaksi', compact('transaksi', 'detailProduks', 'detailPerawatans', 'promos', 'promoResult', 'selectedPromo'))->with([
            'title' => 'Kasir | Pembayaran'
        ]);
    }

    /**
     * Private Function -> To calculate Discount and Point Earned based on Promo that currently get selected
     */
    private function calculateDiscount($transaksi, $promo)
    {
        if (!$promo) {
            return 0;
        }

        if ($promo->kode == 'POIN') {
            $transaksi->total_harga += $transaksi->diskon; // Revert to previous 'total_harga' when customer reselect 'POIN' promo
            $transaksi->save();
            return intval($transaksi->total_harga / 50000); // Convert float to integer
        }

        $discount = 0;
        $totalHarga = $transaksi->total_harga;
        $birthdate = $transaksi->customer->tanggal_lahir;

        switch ($promo->kode) {
            case 'BDAY':
                if (now()->format('m-d') == \Carbon\Carbon::parse($birthdate)->format('m-d')) {
                    $discount = 0.2 * $totalHarga;
                }
                break;

            case 'MHS':
                $age = now()->diffInYears(\Carbon\Carbon::parse($birthdate));
                if ($age < 22) {
                    $discount = 0.1 * $totalHarga;
                }
                break;

            case 'KART':
                if (now()->format('m-d') == '04-21') {
                    $discount = 0.1 * $totalHarga;
                }
                break;

            case '17AN':
                if (now()->format('m-d') == '08-17') {
                    $discount = 0.17 * $totalHarga;
                }
                break;

            default:
                $discount = 0;
        }

        return intval($discount); // Convert float to integer
    }

    /**
     * Handle Payment -> Not Valid when amount is less than total payment and give change when amout equal or more than total payment
     */
    public function payment(Request $request, $id)
    {
        $request->validate([
            'nominal_pembayaran' => 'required'
        ]);
        $transaksi = Transaksi::find($id);
        $customer = User::find($transaksi->customer_id);

        if ($request->nominal_pembayaran < $transaksi->total_harga) {
            Alert::warning('Warning', 'Nominal Pembayaran tidak cukup!');
            return redirect()->back();
        }

        if ($request->nominal_pembayaran >= $transaksi->total_harga) {
            // Update Customer's personal point
            $customer->poin += $transaksi->poin_earned;
            $customer->save();

            // Update Transaction's payment status and kasir_id
            $change = $request->nominal_pembayaran - $transaksi->total_harga;
            $transaksi->status_pembayaran = 'Paid';
            $transaksi->kasir_id = Auth::guard('pegawai')->user()->id;
            $transaksi->save();

            Alert::success('Success', 'Kembalian : Rp. ' . $change . ', Terima Kasih atas Pembayarannya!');
            return redirect()->route('kasir.daftar-pending');
        }
    }

    /**
     * Generate Invoice of Transaction with status 'Paid'
     */
    public function generateInvoice($id)
    {
        $transaksi = Transaksi::with(['customer', 'dokter', 'cs', 'beautician', 'kasir'])->find($id);

        $detailPerawatans = DetailPerawatan::with('perawatan')
            ->where('transaksi_id', $transaksi->id)
            ->get();

        $detailProduks = DetailProduk::with('produk')
            ->where('transaksi_id', $transaksi->id)
            ->get();

        // Calculate totals
        $subtotalPerawatan = $detailPerawatans->sum('sub_total');
        $subtotalProduk = $detailProduks->sum('sub_total');
        $diskon = $transaksi->diskon ?? 0;
        $total = $subtotalPerawatan + $subtotalProduk - $diskon;
        $tambahPoint = floor($total / 50000); // Assuming point calculation logic

        $data = [
            'transaksi' => $transaksi,
            'detailPerawatans' => $detailPerawatans,
            'detailProduks' => $detailProduks,
            'subtotalPerawatan' => $subtotalPerawatan,
            'subtotalProduk' => $subtotalProduk,
            'diskon' => $diskon,
            'total' => $total,
            'tambahPoint' => $tambahPoint,
        ];

        // Load the view into the PDF
        $pdf = Pdf::loadView('core.kasir.components.invoice', $data)->setPaper('a4', 'portrait');

        // Return the PDF for download
        return $pdf->download("Invoice - " . $transaksi->customer->nama . " " .  $transaksi->no_transaksi . ".pdf");
    }

    public function redeemPoints(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $customer = $transaksi->customer;

        $redeemedPoints = $request->input('tukar_point', []);

        $totalRedeemedPoints = collect($redeemedPoints)->filter(function ($points) {
            return is_numeric($points) && $points > 0;
        })->sum();

        if ($totalRedeemedPoints > $customer->poin) {
            Alert::warning('Warning', 'Total point yang ditukar melebihi point tersedia!');
            return back();
        }

        $hasInvalidPoints = false; // Flag to track invalid points

        foreach ($redeemedPoints as $detailId => $points) {
            $detailPerawatan = DetailPerawatan::findOrFail($detailId);
            $requiredPoints = $detailPerawatan->perawatan->jumlah_potongan_poin;

            // Validate redeemed points
            if ((int)$points != (int)$requiredPoints) {
                $hasInvalidPoints = true; // Set flag for invalid points
                continue; // Skip this iteration
            }

            // Update valid points
            $detailPerawatan->sub_total = 0;
            $detailPerawatan->jumlah_tukar_point = $points;
            $detailPerawatan->save();
        }

        // Update transaction total and deduct redeemed points for valid entries
        $totalHarga = DetailPerawatan::where('transaksi_id', $transaksi->id)->sum('sub_total') +
            DetailProduk::where('transaksi_id', $transaksi->id)->sum('sub_total');
        $transaksi->total_harga = $totalHarga;
        $transaksi->save();

        // Deduct redeemed points for valid entries
        $totalRedeemedPoints = collect($redeemedPoints)->filter(function ($points, $detailId) use ($transaksi) {
            $detailPerawatan = DetailPerawatan::find($detailId);
            $requiredPoints = $detailPerawatan ? $detailPerawatan->perawatan->jumlah_potongan_poin : 0;
            return $points >= $requiredPoints;
        })->sum();

        $customer->poin -= $totalRedeemedPoints;
        $customer->save();

        // If there are invalid points, show the alert
        if ($hasInvalidPoints) {
            Alert::warning('Warning', 'Some points do not meet the redemption requirements, but other is applied (non 0 pt entries)!');
            return redirect()->route('kasir.detail-pembayaran', ['id' => $transaksi->id]);
        }

        Alert::success('Success', 'Points redeemed successfully for valid entries!');
        return redirect()->route('kasir.detail-pembayaran', ['id' => $transaksi->id]);
    }
}
