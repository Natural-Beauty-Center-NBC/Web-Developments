@extends('core.kepala-klinik.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Laporan Pendapatan</h1>
        </div>

        <div class="flex flex-row justify-start gap-8 mb-4 mt-8">
            <div>
                <form method="GET" action="{{ route('kepala-klinik.laporan-pendapatan') }}" id="yearForm">
                    <select name="year"
                        class="block w-40 px-4 py-2 text-sm text-gray-700 bg-white border border-[#FF9EAA] rounded-lg shadow-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                        onchange="document.getElementById('yearForm').submit()">
                        @for ($i = now()->year; $i >= now()->year - 4; $i--)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                        @endfor
                    </select>
                </form>
            </div>
            <div>
                <a href="{{ route('kepala-klinik.download-laporan-pendapatan') }}"
                    class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border" id="dataTable">
            <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="border">
                    <th scope="col" class="px-6 py-3 text-center border">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-start border">
                        Bulan
                    </th>
                    <th scope="col" class="px-6 py-3 border">
                        Perawatan
                    </th>
                    <th scope="col" class="px-6 py-3 border">
                        Produk
                    </th>
                    <th scope="col" class="px-6 py-3 border">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @foreach($results as $item)
                <tr class="bg-white border">
                    <td class="text-center border">
                        {{ ++$i }}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-start border">
                        {{ $item['bulan_nama'] }}
                    </td>
                    <td class="px-6 py-4 border">
                        Rp. {{ number_format($item['total_perawatan'], 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 border">
                        Rp. {{ number_format($item['total_produk'], 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 border">
                        Rp. {{ number_format($item['total'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="text-center font-bold text-[18px] border">
                    <td colspan="4" class="px-16 py-4 text-right border">Total Pendapatan</td>
                    <td class="px-6 py-4">
                        Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection