@extends('core.admin.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('admin.update-perawatan', ['id' => $perawatan->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Data Perawatan</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Perawatan</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Apple Facial" value="{{ $perawatan->nama }}" required />
        </div>
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
            <textarea name="deskripsi" type="number" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder=" Apple Facial dapat digunakan untuk jenis kulit normal, dan jenis kulit berminyak." rows="5" required>{{ $perawatan->deskripsi}}</textarea>
        </div>
        <div class="flex w-full gap-4">
            <div class="w-full">
                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga Perawatan</label>
                <input name="harga" type="number" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="70000" value="{{ $perawatan->harga }}" required />
            </div>
            <div class="w-full">
                <label for="jumlah_potongan_poin" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Potongan Poin</label>
                <input name="jumlah_potongan_poin" type="number" id="jumlah_potongan_poin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="45" value="{{ $perawatan->jumlah_potongan_poin }}" required />
            </div>
            <div class="w-full">
                <label for="tipe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe Perawatan</label>
                <select name="tipe" id="tipe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Tipe Perawatan</option>
                    <option value="Konsultasi" <?= $perawatan->tipe === "Konsultasi" ? 'selected' : ''; ?>>Konsultasi</option>
                    <option value="Non-Konsultasi" <?= $perawatan->tipe === "Non-Konsultasi" ? 'selected' : ''; ?>>Non-Konsultasi</option>
                </select>
            </div>
        </div>
        <div class="flex w-full justify-end mt-4">
            <a href="{{ route('admin.index-perawatan') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="confirmUpdate()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Perawatan akan diubah!",
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