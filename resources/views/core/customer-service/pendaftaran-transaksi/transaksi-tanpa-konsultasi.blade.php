@extends('core.customer-service.layouts.main')
@section('content')
<form class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('customer-service.store-tanpa-konsultasi') }}" enctype="multipart/form-data">
    @csrf
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Pendaftaran Perawatan tanpa Konsultasi</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="id_customer" class="block mb-2 text-sm font-medium text-gray-900">ID Customer</label>
            <input name="id_customer" type="text" id="id_customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="0816 1603 1982 1" required />
        </div>
        <div>
            <label for="perawatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Layanan Perawatan (Non-Konsultasi)</label>
            <select name="perawatan" id="perawatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Layanan Perawatan</option>
                @foreach($perawatans as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="ruangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ruangan Perawatan</label>
            <select name="ruangan" id="ruangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Ruangan Perawatan</option>
                @foreach($ruangans as $item)
                    <option value="{{ $item->id }}">{{ $item->no_ruangan }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="beautician" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beautician</label>
            <select name="beautician" id="beautician" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Beautician yang bertugas</option>
                @foreach($beauticians as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="cs" value="{{ Auth::guard('pegawai')->user()->id }}" />

        <div class="flex w-full justify-end">
            <button type="submit" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>
@endsection
