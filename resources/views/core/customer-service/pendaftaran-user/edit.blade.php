@extends('core.customer-service.layouts.main')
@section('content')
<form class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('user-service.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Edit Data User</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Nama User" value="{{ $user->nama }}" required />
        </div>
        <div>
            <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $user->tanggal_lahir }}" required />
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">Jenis Kelamin</label>
            <div class="flex gap-4">
                <label class="text-sm font-medium text-gray-900">
                    <input name="jenis_kelamin" type="radio" value="Pria" {{ $user->jenis_kelamin == 'Pria' ? 'checked' : '' }} required /> Pria
                </label>
                <label class="text-sm font-medium text-gray-900">
                    <input name="jenis_kelamin" type="radio" value="Wanita" {{ $user->jenis_kelamin == 'Wanita' ? 'checked' : '' }} required /> Wanita
                </label>
            </div>
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Alamat User" rows="3" required>{{ $user->alamat }}</textarea>
        </div>
        <div>
            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Nomor Telepon User" value="{{ $user->no_telp }}" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Alamat E-Mail</label>
            <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Email User" value="{{ $user->email }}" required />
        </div>
        <div>
            <label for="alergi" class="block mb-2 text-sm font-medium text-gray-900">Alergi Obat</label>
            <textarea name="alergi" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Alergi Obat User" rows="3">{{ $user->alergi }}</textarea>
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="******" />
            <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah password</small>
        </div>
        <div class="flex w-full justify-end mt-4">
            <a href="{{ route('user-service.index') }}" class="w-1/4 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Cancel</a>
            <button type="submit" class="w-1/4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 text-center ml-4">Submit</button>
        </div>
    </div>
</form>
@endsection
