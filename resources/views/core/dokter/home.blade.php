@extends('core.dokter.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Antiran Pemeriksaan</h1>
        </div>

        <div class="relative overflow-x-auto shadow-md rounded-lg p-4 max-h-[360px] overflow-y-auto">
            @foreach($transaksis as $item)
                @include('core.dokter.components.item-antrian-dokter', [
                    'transaksi' => $item
                ])
            @endforeach
        </div>
    </div>
    @endsection