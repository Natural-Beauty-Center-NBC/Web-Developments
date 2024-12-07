<div class="shadow rounded-lg p-4 mb-4 border border-[#FF9EAA]">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">Transaction: {{ $transaksi->no_transaksi }}</h2>
            <p class="text-sm text-gray-600">Date: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</p>
            <p class="text-sm text-gray-600">Tipe: {{ $transaksi->jenis_transaksi }}</p>
            <p class="text-sm text-gray-600">Customer: {{ $transaksi->customer->nama }}</p>
        </div>
        @if ($transaksi->status_pembayaran == 'Pending')
        <div class="flex space-x-2">
            <a href="{{ route('dokter.riwayat-pemeriksaan', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600">
                Riwayat
            </a>
            @if ($transaksi->jenis_transaksi == 'Perawatan dengan Konsultasi')
                @if($transaksi->ruangan_id == null)
                    <a href="{{ route('dokter.create-input-perawatan', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-lime-500 text-white rounded-xl hover:bg-lime-600">
                        Input Pemeriksaan
                    </a>
                @else
                    <a href="{{ route('dokter.edit-perawatan', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600">
                        Edit Pemeriksaan
                    </a>
                @endif
            @else
                @if($transaksi->detailProduk->isNotEmpty())
                    <a href="{{ route('dokter.edit-produk', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600">
                        Edit Pemeriksaan
                    </a>
                @else
                    <a href="{{ route('dokter.create-input-produk', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-lime-500 text-white rounded-xl hover:bg-lime-600">
                        Input Pemeriksaan
                    </a>
                @endif
            @endif
            <a href="{{ route('dokter.mark-as-done', ['id' => $transaksi->id]) }}" class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600">
                Mark as Done
            </a>
        </div>
        @endif
    </div>
</div>