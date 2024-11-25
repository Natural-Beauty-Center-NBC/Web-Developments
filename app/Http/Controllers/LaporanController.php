<?php

namespace App\Http\Controllers;

use App\Models\DetailPerawatan;
use App\Models\DetailProduk;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Handle Laporan Customer Baru
     */
    public function get_laporan_customer_baru(Request $request)
    {
        // Get the requested year, default to the current year if not provided
        $year = $request->input('year', now()->year);

        // Query to fetch the data grouped by month
        $data = User::selectRaw('
            MONTH(created_at) as bulan,
            SUM(CASE WHEN jenis_kelamin = "Pria" THEN 1 ELSE 0 END) as pria,
            SUM(CASE WHEN jenis_kelamin = "Wanita" THEN 1 ELSE 0 END) as wanita,
            COUNT(*) as jumlah
        ')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // Fill missing months with zero data
        $results = collect(range(1, 12))->map(function ($month) use ($data) {
            $record = $data->firstWhere('bulan', $month);

            return [
                'bulan' => $month,
                'bulan_nama' => Carbon::createFromDate(null, $month, 1)->translatedFormat('F'),
                'pria' => $record->pria ?? 0,
                'wanita' => $record->wanita ?? 0,
                'jumlah' => $record->jumlah ?? 0,
            ];
        });

        // Calculate the total for the year
        $total = [
            'pria' => $results->sum('pria'),
            'wanita' => $results->sum('wanita'),
            'jumlah' => $results->sum('jumlah'),
        ];

        return view('core.kepala-klinik.laporan.customer-baru.index', compact('results', 'total', 'year'))->with([
            'title' => 'Kepala Klinik | Laporan Customer Baru'
        ]);
    }

    public function generate_pdf_laporan_customer_baru(Request $request)
    {
        // Get the requested year, default to the current year
        $year = $request->input('year', now()->year);
        $currentDate = now()->translatedFormat('d F Y');

        // Fetch the data (same as in get_laporan_customer_baru)
        $data = User::selectRaw('
            MONTH(created_at) as bulan,
            SUM(CASE WHEN jenis_kelamin = "Pria" THEN 1 ELSE 0 END) as pria,
            SUM(CASE WHEN jenis_kelamin = "Wanita" THEN 1 ELSE 0 END) as wanita,
            COUNT(*) as jumlah
        ')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $results = collect(range(1, 12))->map(function ($month) use ($data) {
            $record = $data->firstWhere('bulan', $month);

            return [
                'bulan' => $month,
                'bulan_nama' => Carbon::createFromDate(null, $month, 1)->translatedFormat('F'),
                'pria' => $record->pria ?? 0,
                'wanita' => $record->wanita ?? 0,
                'jumlah' => $record->jumlah ?? 0,
            ];
        });

        $total = [
            'pria' => $results->sum('pria'),
            'wanita' => $results->sum('wanita'),
            'jumlah' => $results->sum('jumlah'),
        ];

        // Load the view into the PDF
        $pdf = Pdf::loadView('core.kepala-klinik.laporan.customer-baru.pdf', compact('results', 'total', 'year', 'currentDate'))
            ->setPaper('a4', 'portrait');

        // Return the PDF for download
        return $pdf->download("Laporan_Customer_Baru_$year.pdf");
    }

    /**
     * Handle Laporan Pendapatan
     */
    public function get_laporan_pendapatan(Request $request)
    {
        // Get the requested year, default to the current year
        $year = $request->input('year', now()->year);

        // Query to fetch the data grouped by month
        $data = Transaksi::selectRaw('
            MONTH(transaksis.created_at) as bulan,
            COALESCE(SUM(detail_perawatans.sub_total), 0) as total_perawatan,
            COALESCE(SUM(detail_produks.sub_total), 0) as total_produk,
            (COALESCE(SUM(detail_perawatans.sub_total), 0) + COALESCE(SUM(detail_produks.sub_total), 0)) as total
        ')
            ->leftJoin('detail_perawatans', 'transaksis.id', '=', 'detail_perawatans.transaksi_id')
            ->leftJoin('detail_produks', 'transaksis.id', '=', 'detail_produks.transaksi_id')
            ->whereYear('transaksis.created_at', $year)
            ->where('transaksis.status_pembayaran', 'paid')
            ->groupByRaw('MONTH(transaksis.created_at)')
            ->orderByRaw('MONTH(transaksis.created_at)')
            ->get();

        // Fill missing months with zero data
        $results = collect(range(1, 12))->map(function ($month) use ($data) {
            $record = $data->firstWhere('bulan', $month);

            return [
                'bulan' => $month,
                'bulan_nama' => Carbon::createFromDate(null, $month, 1)->translatedFormat('F'),
                'total_perawatan' => $record->total_perawatan ?? 0,
                'total_produk' => $record->total_produk ?? 0,
                'total' => $record->total ?? 0,
            ];
        });

        // Calculate the yearly total
        $totalPendapatan = $results->sum('total');

        return view('core.kepala-klinik.laporan.pendapatan.index', compact('results', 'totalPendapatan', 'year'))->with([
            'title' => 'Kepala Klinik | Laporan Pendapatan'
        ]);
    }

    public function generate_pdf_laporan_pendapatan(Request $request)
    {
        // Get the requested year, default to the current year
        $year = $request->input('year', now()->year);
        $currentDate = now()->translatedFormat('d F Y');

        // Query to fetch the data grouped by month
        $data = Transaksi::selectRaw('
            MONTH(transaksis.created_at) as bulan,
            COALESCE(SUM(detail_perawatans.sub_total), 0) as total_perawatan,
            COALESCE(SUM(detail_produks.sub_total), 0) as total_produk,
            (COALESCE(SUM(detail_perawatans.sub_total), 0) + COALESCE(SUM(detail_produks.sub_total), 0)) as total
        ')
            ->leftJoin('detail_perawatans', 'transaksis.id', '=', 'detail_perawatans.transaksi_id')
            ->leftJoin('detail_produks', 'transaksis.id', '=', 'detail_produks.transaksi_id')
            ->whereYear('transaksis.created_at', $year)
            ->where('transaksis.status_pembayaran', 'paid')
            ->groupByRaw('MONTH(transaksis.created_at)')
            ->orderByRaw('MONTH(transaksis.created_at)')
            ->get();

        // Fill missing months with zero data
        $results = collect(range(1, 12))->map(function ($month) use ($data) {
            $record = $data->firstWhere('bulan', $month);

            return [
                'bulan' => $month,
                'bulan_nama' => Carbon::createFromDate(null, $month, 1)->translatedFormat('F'),
                'total_perawatan' => $record->total_perawatan ?? 0,
                'total_produk' => $record->total_produk ?? 0,
                'total' => $record->total ?? 0,
            ];
        });

        // Calculate the yearly total
        $totalPendapatan = $results->sum('total');

        // Load the view into the PDF
        $pdf = Pdf::loadView('core.kepala-klinik.laporan.pendapatan.pdf', compact('results', 'totalPendapatan', 'year', 'currentDate'))
            ->setPaper('a4', 'portrait');

        // Return the PDF for download
        return $pdf->download("Laporan_Pendapatan_$year.pdf");
    }

    /**
     * Handle Laporan Jumlah Customer
     */
    public function get_laporan_jumlah_customer(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        // Query to fetch the report
        $results = Transaksi::join('pegawais as dokters', 'transaksis.dokter_id', '=', 'dokters.id')
            ->join('detail_perawatans', 'transaksis.id', '=', 'detail_perawatans.transaksi_id')
            ->join('perawatans', 'detail_perawatans.perawatan_id', '=', 'perawatans.id')
            ->select(
                'dokters.nama as dokter_name',
                'perawatans.nama as perawatan_name',
                DB::raw('COUNT(transaksis.id) as jumlah_customer')
            )
            ->where('transaksis.status_pembayaran', 'Paid')
            ->whereYear('transaksis.tanggal_transaksi', $year)
            ->whereMonth('transaksis.tanggal_transaksi', $month)
            ->groupBy('dokters.id', 'dokters.nama', 'perawatans.id', 'perawatans.nama')
            ->get()
            ->groupBy('dokter_name')
            ->map(function ($items, $dokterName) {
                return [
                    'dokters' => $dokterName,
                    'perawatans' => $items,
                    'total' => $items->sum('jumlah_customer')
                ];
            });

        $totalJumlahCustomer = $results->sum('total');

        return view('core.kepala-klinik.laporan.jumlah-customer.index', compact('results', 'totalJumlahCustomer', 'year'))->with([
            'title' => 'Kepala Klinik | Laporan Jumlah Customer'
        ]);
    }

    public function generate_pdf_laporan_jumlah_customer(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);
        $currentDate = now()->translatedFormat('d F Y');

        // Query to fetch the report
        $results = Transaksi::join('pegawais as dokters', 'transaksis.dokter_id', '=', 'dokters.id')
            ->join('detail_perawatans', 'transaksis.id', '=', 'detail_perawatans.transaksi_id')
            ->join('perawatans', 'detail_perawatans.perawatan_id', '=', 'perawatans.id')
            ->select(
                'dokters.nama as dokter_name',
                'perawatans.nama as perawatan_name',
                DB::raw('COUNT(transaksis.id) as jumlah_customer')
            )
            ->where('transaksis.status_pembayaran', 'Paid')
            ->whereYear('transaksis.tanggal_transaksi', $year)
            ->whereMonth('transaksis.tanggal_transaksi', $month)
            ->groupBy('dokters.id', 'dokters.nama', 'perawatans.id', 'perawatans.nama')
            ->get()
            ->groupBy('dokter_name')
            ->map(function ($items, $dokterName) {
                return [
                    'dokters' => $dokterName,
                    'perawatans' => $items,
                    'total' => $items->sum('jumlah_customer')
                ];
            });

        $totalJumlahCustomer = $results->sum('total');
        $monthName = Carbon::createFromDate(null, $month, 1)->translatedFormat('F');

        // Load the view into the PDF
        $pdf = Pdf::loadView('core.kepala-klinik.laporan.jumlah-customer.pdf', compact('results', 'totalJumlahCustomer', 'year', 'monthName', 'currentDate'))
            ->setPaper('a4', 'portrait');

        // Return the PDF for download
        return $pdf->download("Laporan_Jumlah_Customer_per_Dokter_" . $monthName . "_" . $year . ".pdf");
    }
}
