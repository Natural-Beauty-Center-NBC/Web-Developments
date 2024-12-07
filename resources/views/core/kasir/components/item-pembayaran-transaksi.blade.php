<div class="shadow rounded-lg p-6 mb-4 border border-[#FF9EAA]">
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Transaction: {{ $no_transaksi }}</h2>
                <p class="text-sm text-gray-600">Date: {{ \Carbon\Carbon::parse($tanggal_transaksi)->format('d M Y, H:i') }}</p>
            </div>

            <div class="flex flex-row gap-12">
                <div>
                    <p class="text-sm text-gray-600">Tipe: {{ $tipe_transaksi }}</p>
                    <p class="text-sm text-gray-600">Customer: {{ $customer_nama }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Total Harga: Rp. {{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="flex space-x-2">
            @if ($status_bayar == 'Pending')
            <a href="{{ route('kasir.detail-pembayaran', ['id' => $id_transaksi]) }}" class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600">
                Bayar
            </a>
            @else
            <a href="{{ route('kasir.generate-invoice', ['id' => $id_transaksi]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600">
                <i class="bi bi-file-earmark-pdf"></i> Cetak Nota
            </a>
            @endif
        </div>
    </div>
</div>