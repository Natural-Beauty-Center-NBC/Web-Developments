@extends('core.customer-service.layouts.main')
@section('content')
<form class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('user-service.store') }}" enctype="multipart/form-data">
    @csrf
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Formulir Pendaftaran User</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="John Doe" required />
        </div>
        <div>
            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required />
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="text-sm font-medium text-gray-900">
                    <input name="jenis_kelamin" type="radio" value="Pria" required /> Pria
                </label>
                <label class="text-sm font-medium text-gray-900">
                    <input name="jenis_kelamin" type="radio" value="Wanita" required /> Wanita
                </label>
            </div>
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Jl. Babarsari No.39" required></textarea>
        </div>
        <div>
            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="08xxxxxxxxxx" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Alamat E-Mail</label>
            <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="john.doe@gmail.com" required />
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="******" required />
        </div>
        <div>
            <label for="alergi" class="block mb-2 text-sm font-medium text-gray-900">Alergi Obat</label>
            <textarea name="alergi" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Tulis jika ada"></textarea>
        </div>
        <div class="flex w-full justify-end">
            <a href="{{ route('user-service.index') }}" class="w-1/4 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Cancel</a>
            <button type="submit" class="w-1/4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 text-center ml-4">Submit</button>
        </div>
    </div>
</form>
@endsection
