<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Jumlah Customer per Dokter - {{ $monthName }} {{ $year }}</title>
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
    <h2 class="title">Laporan Jumlah Customer per Dokter</h2>
    <h3><strong>Pada {{ $monthName }} {{ $year }}</strong></h3>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-left">Nama Dokter</th>
                <th class="text-left">Nama Perawatan</th>
                <th class="text-center">Jumlah Customer</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            @foreach($results as $item)
            <?php $rowspan = count($item['perawatans']) ?>
            @foreach($item['perawatans'] as $index => $a)
            <tr>
                @if($index === 0)
                <td class="text-center" rowspan="{{ $rowspan }}">{{ ++$i }}</td>
                <td class="text-left" rowspan="{{ $rowspan }}">{{ $item['dokters'] }}</td>
                @endif
                <td class="text-left">{{ $a->perawatan_name }}</td>
                <td class="text-center">{{ $a->jumlah_customer }}</td>
                @if($index === 0)
                <td class="text-center" rowspan="{{ $rowspan }}">{{ $item['total'] }}</td>
                @endif
            </tr>
            @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr class="text-center font-bold text-[18px]">
                <td colspan="4" style="text-align: right; padding-right: 80px;">Total</td>
                <td class="text-center">{{ $totalJumlahCustomer }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak pada Tanggal {{ $currentDate }}
    </div>
</body>
</html>