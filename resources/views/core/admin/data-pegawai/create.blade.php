@extends('core.admin.layouts.main')
@section('content')
<form id="save-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('admin.store-pegawai') }}" enctype="multipart/form-data">
    @csrf
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Tambah Data Pegawai</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Pegawai</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="John Doe" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="john.doe@gmail.com" required />
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Pegawai</label>
            <input name="alamat" type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Jl. Babarsari No.39" required />
        </div>
        <div>
            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="08xxxxxxxxxx" required />
        </div>
        <div class="w-1/3">
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Pegawai</label>
            <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                <option value="" disabled selected>Pilih Role Pegawai</option>
                <option value="Kepala Klinik">Kepala Klinik</option>
                <option value="Customer Service">Customer Service</option>
                <option value="Kasir">Kasir</option>
                <option value="Dokter">Dokter</option>
                <option value="Beautician">Beautician</option>
            </select>
        </div>
        <div class="w-1/3">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Account</label>
            <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full">
            <div class="mt-2">
                <input type="checkbox" id="togglePassword" class="mr-1">
                <label for="togglePassword" class="text-sm text-gray-900 dark:text-white">Show Password</label>
            </div>
        </div>
        <div class="flex w-full justify-end">
            <button type="button" onclick="confirmSave()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("togglePassword").addEventListener("change", function() {
        const passwordInput = document.getElementById("password");
        if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });

    function confirmSave() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Pegawai akan ditambahkan!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`save-form`).submit();
            }
        });
    }
</script>
@endsection