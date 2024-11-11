@extends('core.kepala-klinik.layouts.main')
@section('content')
<div class="p-8 my-6 mx-4 bg-white rounded-lg shadow">
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Detail Data Promo</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Kode Promo</label>
                <p class="text-gray-700">{{ $promos->kode }}</p>
            </div>
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Jenis</label>
                <p class="text-gray-700">{{ $promos->jenis }}</p>
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
            <p class="text-gray-700">{{ $promos->keterangan }}</p>
        </div>

        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Nilai Potongan</label>
                <p class="text-gray-700">{{ $promos->nilai_potongan }}</p>
            </div>
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Potongan</label>
                <p class="text-gray-700">{{ $promos->jenis_potongan }}</p>
            </div>
        </div>

        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Periode</label>
                <p class="text-gray-700">{{ $promos->periode }}</p>
            </div>
            <div class="w-1/2">
                <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                <p class="inline-block px-3 py-1 rounded-full text-sm font-medium 
                    {{ $promos->status == 'Aktif' ? 'bg-green-300 text-green-700' : 'bg-red-300 text-red-700' }}">
                    {{ $promos->status }}
                </p>
            </div>
        </div>
        <div class="flex w-full justify-end mt-4">
            <a href="{{ route('kepala-klinik.index-promo') }}" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
        </div>
    </div>
</div>
@endsection
