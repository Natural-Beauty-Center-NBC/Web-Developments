@extends('core.kasir.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Daftar Pembayaran Transaksi Lunas</h1>
        </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        @foreach($transaksis as $item)
            @include('core.kasir.components.item-pembayaran-transaksi', [
                'no_transaksi' => $item->no_transaksi,
                'tanggal_transaksi' => $item->tanggal_transaksi,
                'tipe_transaksi' => $item->jenis_transaksi,
                'customer_nama' => $item->customer->nama,
                'id_transaksi' => $item->id,
                'total' => $item->total_harga,
                'status_bayar' => $item->status_pembayaran
            ])
        @endforeach
    </div>
</div>
@endsection