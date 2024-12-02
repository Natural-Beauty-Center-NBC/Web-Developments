<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan {{ $year }}</title>
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
    <h2 class="title">Laporan Pendapatan</h2>
    <h3><strong>Tahun {{ $year }}</strong></h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th class="text-left">Bulan</th>
                <th class="text-left">Perawatan</th>
                <th class="text-left">Produk</th>
                <th class="text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item['bulan_nama'] }}</td>
                <td>Rp. {{ number_format($item['total_perawatan'], 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item['total_produk'], 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right; padding-right: 20px">Total Pendapatan</td>
                <td>Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <div class="footer">
        Dicetak pada Tanggal {{ $currentDate }}
    </div>
</body>

</html>