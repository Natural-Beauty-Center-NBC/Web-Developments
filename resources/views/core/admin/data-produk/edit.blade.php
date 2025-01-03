@extends('core.admin.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('admin.update-produk', ['id' => $produk->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Data Produk</h3>
    <div class="w-full flex flex-col gap-4">
        <div>
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Green Tea Facial" value="{{ $produk->nama }}" required />
        </div>
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Produk</label>
            <textarea name="deskripsi" type="text" id="deskripsi" class="desc bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Deskripsi Produk" rows="5" required>{{ $produk->deskripsi }}</textarea>
        </div>
        <div>
            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga Produk</label>
            <input name="harga" type="number" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="75000" value="{{ number_format($produk->harga, 0, ',','.')}}" required />
        </div>
        <div>
            <label for="ukuran" class="block mb-2 text-sm font-medium text-gray-900">Ukuran Produk (ml)</label>
            <input name="ukuran" type="number" id="ukuran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="20" value="{{ $produk->ukuran }}" required />

        </div>
        <div>
            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900">Stok Produk</label>
            <input name="stok" type="number" id="stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="20" value="{{ $produk->stok }}" required />
        </div>
        <div class="flex w-full justify-end">
            <a href="{{ route('admin.index-produk') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
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