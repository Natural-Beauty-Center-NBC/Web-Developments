@extends('core.kasir.layouts.main')
@section('content')
<div class="p-8 my-6 mx-4 bg-white rounded-lg shadow">
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Pembayaran Transaksi - {{ $transaksi->id_transaksi }} [{{ $transaksi->no_transaksi }}]</h3>
    <div class="w-full flex flex-col gap-4">
        <!-- Detail Transaction's Information -->
        <div class="flex gap-4">
            <div class="flex-1">
                <label for="no_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Transaksi</label>
                <input name="no_transaksi" type="text" id="no_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $transaksi->no_transaksi }}" disabled />
            </div>
            <div class="flex-1">
                <label for="customer_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Customer</label>
                <input name="customer_name" type="text" id="customer_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $transaksi->customer->nama }}" disabled />
            </div>
        </div>

        <div class="w-1/4">
            <label for="remaining_points" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Point</label>
            <input name="remaining_points" type="text" id="remaining_points" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $transaksi->customer->poin }}" disabled />
        </div>

        <!-- Transaction ID -->
        <input type="hidden" id="id_transaksi" name="id_transaksi" value="{{ $transaksi->id }}" />

        <!-- List of Detail Produk Table -->
        <h4 class="mt-5 mb-2 text-lg font-semibold text-gray-900">Detail Produk</h4>
        <table class="w-full text-sm text-left text-gray-500 bg-gray-100 border rounded-lg">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Produk</th>
                    <th scope="col" class="px-6 py-3">Jumlah</th>
                    <th scope="col" class="px-6 py-3">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detailProduks as $item)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4">{{ $item->produk->nama }}</td>
                    <td class="px-6 py-4">{{ $item->jumlah_pembelian }}</td>
                    <td class="px-6 py-4">Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Tidak ada Data Produk yang ditemukan!</td>
                </tr>
                @endforelse
                @if($detailProduks->isNotEmpty())
                <tr class="bg-gray-200 font-semibold">
                    <td class="px-6 py-4 text-right" colspan="2">Total</td>
                    <td class="px-6 py-4">Rp. {{ number_format($detailProduks->sum('sub_total'), 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- List of Detail Perawatan Table -->
        <h4 class="mt-5 mb-2 text-lg font-semibold text-gray-900">Detail Perawatan</h4>
        <form id="redeem-form" action="{{ route('kasir.redeem-point', ['id' => $transaksi->id]) }}" method="POST">
            @csrf
            <table class="w-full text-sm text-left text-gray-500 bg-gray-100 border rounded-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Perawatan</th>
                        <th scope="col" class="px-6 py-3">Jumlah Tukar Point</th>
                        <th scope="col" class="px-6 py-3">Jumlah</th>
                        <th scope="col" class="px-6 py-3">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($detailPerawatans as $item)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $item->perawatan->nama }}</td>
                        <td class="px-6 py-4">
                            <input
                                type="number"
                                name="tukar_point[{{ $item->id }}]"
                                class="tukar-point-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5"
                                max="{{ $transaksi->customer->poin }}"
                                value="{{ $item->jumlah_tukar_point }}"
                                {{ $item->jumlah_tukar_point != 0 ? 'disabled' : '' }} />
                        </td>
                        <td class="px-6 py-4">{{ $item->jumlah_pembelian }}</td>
                        <td class="px-6 py-4">Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada Data Perawatan yang ditemukan!</td>
                    </tr>
                    @endforelse
                    @if($detailPerawatans->isNotEmpty())
                    <tr class="bg-gray-200 font-semibold">
                        <td class="px-6 py-4 text-right" colspan="3">Total</td>
                        <td class="px-6 py-4">Rp. {{ number_format($detailPerawatans->sum('sub_total'), 0, ',', '.') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <button type="button" onclick="confirmRedeem()" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg">Redeem Points</button>
        </form>

        <div class="mt-6">
            <form method="GET" action="{{ route('kasir.detail-pembayaran', ['id' => $transaksi->id]) }}" id="promoForm">
                <label for="promo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Promo</label>
                <select name="promo"
                    class="block w-40 px-4 py-2 text-sm text-gray-700 bg-white border border-[#FF9EAA] rounded-lg shadow-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]" onchange="document.getElementById('promoForm').submit()">
                    @foreach($promos as $item)
                    <option value="{{ $item->id }}"
                        {{ request('promo') == $item->id ? 'selected' : ($item->kode == 'POIN' && !request('promo') ? 'selected' : '') }}>
                        {{ $item->kode }}
                    </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon</label>
                <input name="alergi" type="text" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="Rp. {{ number_format($transaksi->diskon, 0, ',', '.') }}" disabled />
            </div>
            <div class="flex-1">
                <label for="beautician" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Pembayaran</label>
                <input name="alergi" type="text" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}" disabled />
            </div>
        </div>

        <div class="flex gap-4 justify-end">
            <div class="w-1/3">
                <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Tambahan Point</label>
                <input name="alergi" type="text" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $transaksi->poin_earned }}" disabled />
            </div>
        </div>

        <div class="flex w-full justify-end mt-8">
            <a href="{{ route('kasir.daftar-pending') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="toggleModal()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Confirm</button>
        </div>
    </div>

    <!-- Modal for Input Payment Amount -->
    <div id="modal" class="fixed inset-0 hidden z-50 overflow-auto bg-gray-800 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto my-20">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="toggleModal()">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-8.707a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Pembayaran Transaksi</h3>
                    <div class="text-left mb-6">
                        <p class="font-bold">Total Pembayaran</p>
                        <p>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                    </div>
                    <form id="save-form" action="{{ route('kasir.pembayaran', ['id' => $transaksi->id]) }}" method="POST">
                        @csrf
                        <input
                            type="number"
                            name="nominal_pembayaran"
                            id="nominal_pembayaran"
                            placeholder="Masukkan Nominal Pembayaran"
                            class="px-3 py-2 mb-4 w-full border rounded-lg text-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                            required />
                        <button type="button" onclick="confirmSave()" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden');
    }

    function confirmSave() {
        Swal.fire({
            title: 'Apakah jumlah pembayaran sudah sesuai?',
            text: "Data Transaksi akan dibayar!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Bayar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`save-form`).submit();
            }
        });
    }

    function confirmRedeem() {
        Swal.fire({
            title: 'Apakah jumlah point sudah sesuai?',
            text: "Point akan ditukar!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Sesuai!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`redeem-form`).submit();
            }
        });
    }
</script>
@endsection