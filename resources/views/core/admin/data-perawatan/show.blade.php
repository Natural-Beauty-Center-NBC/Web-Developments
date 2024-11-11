@extends('core.admin.layouts.main')
@section('content')

<div class="p-8 my-6 mx-4 bg-white rounded-lg shadow">
    <div class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">
        <h3 class="flex-grow">Detail Perawatan</h3>
        <div class="flex justify-end">
            <a href="{{ route('admin.index-perawatan') }}"
                class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Back
            </a>
        </div>
    </div> 
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Perawatan</label>
            <span id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 inline-block">
                {{ $perawatan->nama }}
            </span>
        </div>
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
            <span id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 inline-block">
                {{ $perawatan->deskripsi }}
            </span>
        </div>
        <div>
            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga Perawatan</label>
            <span id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 inline-block">
                Rp {{ number_format($perawatan->harga, 0, ',', '.') }}
            </span>
        </div>
        <div>
            <label for="jumlah_potongan_poin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Potongan Poin</label>
            <span id="jumlah_potongan_poin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 inline-block">
                {{ $perawatan->jumlah_potongan_poin }}
            </span>
        </div>
        <div>
            <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900">Tipe Perawatan</label>
            <span id="tipe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 inline-block">
                {{ $perawatan->tipe === "Konsultasi" ? "Konsultasi" : "Non-Konsultasi" }}
            </span>
        </div>
    </div>
</div>
@endsection