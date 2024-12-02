@extends('core.customer-service.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('customer-service.update-customer', ['id' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Customer</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="JohnDoe" value="{{ $user->nama }}" required />
            </div>
            <div class="flex-1">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Pribadi</label>
                <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="johndoe@gmail.com" value="{{ $user->email }}" required />
            </div>
        </div>
        <div class="flex gap-4 mb-4">
            <div class="flex-1">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $user->tanggal_lahir }}" required />
            </div>
            <div class="flex-1">
                <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                <select name="gender" id="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Pria" <?= $user->jenis_kelamin === "Pria" ? 'selected' : ''; ?>>Pria</option>
                    <option value="Wanita" <?= $user->jenis_kelamin === "Wanita" ? 'selected' : ''; ?>>Wanita</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="081122334455" value="{{ $user->no_telp }}" required />
            </div>
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
            <input name="alamat" type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Jl. Babarsari No. 43, Yogyakarta" value="{{ $user->alamat }}" required />
        </div>
        <div>
            <label for="alergi" class="block mb-2 text-sm font-medium text-gray-900">Alergi (Optional)</label>
            <input name="alergi" type="text" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Alergi Seafood" value="{{ $user->alergi }}" />
        </div>
        <div class="flex w-full justify-end">
            <a href="{{ route('customer-service.index-customer') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="confirmUpdate()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("togglePassword").addEventListener("change", function() {
        const passwordInput = document.getElementById("password");
        const passwordConfirmInput = document.getElementById("password_confirmation");
        if (this.checked) {
            passwordInput.type = "text";
            passwordConfirmInput.type = "text";
        } else {
            passwordInput.type = "password";
            passwordConfirmInput.type = "password"
        }
    });

    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Customer akan diubah!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`update-form`).submit();
            }
        });
    }
</script>
@endsection