@extends('core.kepala-klinik.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Laporan Top 10 Produk Terlaris</h1>
        </div>

        <div class="flex flex-row justify-start gap-8 mb-4 mt-8">
            <div>
                <form method="GET" action="{{ route('kepala-klinik.laporan-produk-terlaris') }}" id="inputForm" class="flex gap-3">
                    <select name="year"
                        class="block w-40 px-4 py-2 text-sm text-gray-700 bg-white border border-[#FF9EAA] rounded-lg shadow-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                        onchange="document.getElementById('inputForm').submit()">
                        @for ($i = now()->year; $i >= now()->year - 4; $i--)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                        @endfor
                    </select>
                    <select name="month"
                        class="block w-40 px-4 py-2 text-sm text-gray-700 bg-white border border-[#FF9EAA] rounded-lg shadow-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                        onchange="document.getElementById('inputForm').submit()">
                        @for ($i = 0; $i < 12; $i++)
                            @php
                            $month=now()->subMonths($i);
                            @endphp
                            <option value="{{ $month->format('m') }}" {{ request('month') == $month->format('m') ? 'selected' : '' }}>
                                {{ $month->format('F') }}
                            </option>
                            @endfor
                    </select>
                </form>
            </div>
            <div>
                <a href="{{ route('kepala-klinik.download-laporan-produk-terlaris', ['year' => request('year', now()->year), 'month' => request('month', now()->month)]) }}"
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
                        Nama Produk
                    </th>
                    <th scope="col" class="px-6 py-3 border">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3 text-center border">
                        Ukuran
                    </th>
                    <th scope="col" class="px-6 py-3 text-center border">
                        Jumlah Pembelian
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @forelse($produks as $item)
                <tr>
                    <td class="text-center border">
                        {{ ++$i }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-start border">
                        {{ $item->nama }}
                    </td>
                    <td class="px-6 py-4 border">
                        Rp. {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 border text-center">
                        {{ $item->ukuran }} mL
                    </td>
                    <td class="px-6 py-4 border text-center">
                        {{ $item->jumlah }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="font-semibold text-center p-6">Tidak ada data untuk ditampilkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection