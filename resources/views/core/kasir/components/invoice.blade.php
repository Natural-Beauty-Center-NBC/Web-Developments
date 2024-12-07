<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            margin: 5px 0;
        }

        .info,
        .footer {
            margin: 12px 0;
        }

        .info div,
        .footer div {
            display: inline-block;
            width: 48%;
            vertical-align: top;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .total {
            margin-top: 10px;
            text-align: right;
        }

        .num_transaction {
            margin-top: 16px;
            font-size: medium;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/nbc_logo_full.png') }}" alt="Logo" height="70">
        <h1>Natural Beauty Center</h1>
        <p>Jl. Babarsari No. 43 Yogyakarta 55281<br>Telp. (0274) 487711</p>
    </div>

    <div class="num_transaction">
        <strong>Nomor Transaksi :</strong> {{ $transaksi->no_transaksi }}
    </div>

    <div class="info">
        <div>
            <p><strong>Customer :</strong> {{ $transaksi->customer->nama }}</p>
            <p><strong>Dokter :</strong> {{ $transaksi->dokter->nama ?? 'N/A' }}</p>
            <p><strong>Beautician :</strong> {{ $transaksi->beautician->nama ?? 'N/A' }}</p>
        </div>
        <div>
            <p><strong>Date :</strong> {{ $transaksi->created_at->format('d-m-Y, H:i') }}</p>
            <p><strong>CS :</strong> {{ $transaksi->cs->nama }}</p>
            <p><strong>PRO :</strong> {{ $transaksi->promo->kode }}</p>
        </div>
    </div>

    <!-- Detail Perawatan -->
    @if ($detailPerawatans->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th colspan="4">NOTA PERAWATAN NBC</th>
            </tr>
            <tr>
                <th>Nama Perawatan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Point</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailPerawatans as $item)
            <tr>
                <td>{{ $item->perawatan->nama }}</td>
                <td>Rp. {{ number_format($item->perawatan->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah_pembelian }}</td>
                <td>{{ $item->jumlah_tukar_point }}</td>
                <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total Perawatan</strong></td>
                <td>Rp. {{ number_format($subtotalPerawatan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    @endif

    <!-- Detail Produk -->
    @if ($detailProduks->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th colspan="4">NOTA PRODUK NBC</th>
            </tr>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailProduks as $item)
            <tr>
                <td>{{ $item->produk->nama }}</td>
                <td>Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah_pembelian }}</td>
                <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total Produk</strong></td>
                <td>Rp. {{ number_format($subtotalProduk, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    @endif

    <div class="total">
        <p><strong>Diskon :</strong> Rp. {{ number_format($transaksi->diskon, 0, ',', '.') }}</p>
        <p><strong>Total :</strong> Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        <p><strong>Tambah Point :</strong> {{ $tambahPoint }} pt</p>
    </div>

    <div class="footer">
        <div>
            <p><strong>Kasir</strong></p>
            <p>({{ $transaksi->kasir->nama }})</p>
        </div>
        <div>
            <p><strong>Customer</strong></p>
            <p>({{ $transaksi->customer->nama }})</p>
        </div>
    </div>
</body>

</html>