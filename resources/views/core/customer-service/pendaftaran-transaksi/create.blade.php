@extends('core.customer-service.layouts.main')
@section('content')
<div id="transaksi-type" class="fixed pl-48 inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Jenis Transaksi</h3>
        <div class="flex flex-col gap-4">
            <a href=" " onclick="toggle(event)">
                <button class="w-full text-[#FF9EAA] text-md p-4 bg-white font-semibold border-2 border-[#FF9EAA] hover:text-white hover:bg-[#FF9EAA] rounded-xl">
                    Transaksi dengan Konsultasi
                </button>
            </a>
            <a href="{{ route('customer-service.tanpa-konsultasi') }}">
                <button class="w-full text-[#FF9EAA] text-md p-4 bg-white font-semibold border-2 border-[#FF9EAA] hover:text-white hover:bg-[#FF9EAA] rounded-xl">
                    Transaksi tanpa Konsultasi
                </button>
            </a>
        </div>
    </div>
</div>

<div id="dengan-konsultasi" class="fixed pl-48 inset-0 z-10 items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <div class="flex mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Pilih Layanan</h3>
            <button id="close-button" type="button" class="top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="toggleClose()">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-8.707a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
        <div class="flex flex-col gap-4">
            <a href="{{ route('customer-service.dengan-konsultasi', ['tipe' => 'Perawatan dengan Konsultasi']) }}">
                <button class="w-full text-[#FF9EAA] text-md p-4 bg-white font-semibold border-2 border-[#FF9EAA] hover:text-white hover:bg-[#FF9EAA] rounded-xl">
                    Daftar Perawatan dengan Konsultasi
                </button>
            </a>
            <a href="{{ route('customer-service.dengan-konsultasi', ['tipe' => 'Produk dengan Konsultasi']) }}">
                <button class="w-full text-[#FF9EAA] text-md p-4 bg-white font-semibold border-2 border-[#FF9EAA] hover:text-white hover:bg-[#FF9EAA] rounded-xl">
                    Pembelian Produk dengan Konsultasi
                </button>
            </a>
        </div>
    </div>
</div>

<script>
    function toggle(event) {
        event.preventDefault();
        document.getElementById('transaksi-type').classList.add('hidden');
        document.getElementById('dengan-konsultasi').classList.remove('hidden');
        document.getElementById('dengan-konsultasi').classList.add('flex');
    }

    document.getElementById('close-button').addEventListener("click", function() {
        document.getElementById('transaksi-type').classList.remove('hidden');
        document.getElementById('dengan-konsultasi').classList.add('hidden');
        document.getElementById('dengan-konsultasi').classList.remove('flex');
    });
</script>
@endsection