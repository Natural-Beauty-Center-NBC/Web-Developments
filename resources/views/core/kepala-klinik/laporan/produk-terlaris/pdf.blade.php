<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Produk Terlaris {{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f4f4f4;
        }

        table td.text-center {
            text-align: center;
        }

        table td.text-left,
        th.text-left {
            text-align: left;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header img {
            max-height: 60px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        div {
            margin-top: auto;
            text-align: right;
            padding: 10px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/nbc_logo_full.png') }}" alt="Natural Beauty Center Logo" />
        <p>
            Jalan Babarsari No. 43, Yogyakarta 55281<br>
            Telp. (0274) 487711
        </p>
    </div>
    <h2 class="title">Laporan Produk Terlaris</h2>
    <h3><strong>Pada {{ $monthName }} {{ $year }}</strong></h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th class="text-left">Nama Perawatan</th>
                <th>Harga</th>
                <th>Ukuran</th>
                <th>Jumlah Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perawatans as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td class="text-center">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->ukuran }} mL</td>
                <td class="text-center">{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data untuk ditampilkan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">
        Dicetak pada Tanggal {{ $currentDate }}
    </div>
</body>

</html>