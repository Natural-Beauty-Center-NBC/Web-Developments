@extends('core.admin.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('admin.update-pegawai', ['id' => $pegawai->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Data Pegawai</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Pegawai</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="John Doe" value="{{ $pegawai->nama }}" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input name="email" type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="john.doe@gmail.com" value="{{ $pegawai->email }}" required />
        </div>
        <div>
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat Pegawai</label>
            <input name="alamat" type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Jl. Babarsari No.39" value="{{ $pegawai->alamat}}" required />
        </div>
        <div>
            <label for="no_telp" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
            <input name="no_telp" type="tel" id="no_telp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="08xxxxxxxxxx" value="{{ $pegawai->no_telp }}" required />
        </div>
        <div class="flex w-full gap-4">
            <div class="w-full">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Pegawai</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                    <option value="" disabled selected>Pilih Role Pegawai</option>
                    <option value="Kepala Klinik" <?= $pegawai->role === "Kepala Klinik" ? 'selected' : ''; ?>>Kepala Klinik</option>
                    <option value="Customer Service" <?= $pegawai->role === "Customer Service" ? 'selected' : ''; ?>>Customer Service</option>
                    <option value="Kasir" <?= $pegawai->role === "Kasir" ? 'selected' : ''; ?>>Kasir</option>
                    <option value="Dokter" <?= $pegawai->role === "Dokter" ? 'selected' : ''; ?>>Dokter</option>
                    <option value="Beautician" <?= $pegawai->role === "Beautician" ? 'selected' : ''; ?>>Beautician</option>
                </select>
            </div>
            <div class="w-full">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Pegawai</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Status Pegawai</option>
                    <option value="Available" <?= $pegawai->status === "Available" ? 'selected' : ''; ?>>Available</option>
                    <option value="Busy" <?= $pegawai->role === "Available" ? 'selected' : ''; ?>>Busy</option>
                </select>
            </div>
        </div>
        <div class="w-1/3">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Account</label>
            <input name="password" type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full" value="{{ $pegawai->password }}" required>
            <div class="mt-2">
                <input type="checkbox" id="togglePassword" class="mr-1">
                <label for="togglePassword" class="text-sm text-gray-900 dark:text-white">Show Password</label>
            </div>
        </div>
        <div class="flex w-full justify-end">
            <a href="{{ route('admin.index-pegawai') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="confirmUpdate()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
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

    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Pegawai akan diubah!",
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