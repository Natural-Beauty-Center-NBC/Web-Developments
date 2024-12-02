@extends('core.kepala-klinik.layouts.main')
@section('content')
<form id="save-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('kepala-klinik.store-promo') }}" enctype="multipart/form-data">
    @csrf
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Tambah Promo</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex gap-4 w-2/3 mb-4">
            <div class="flex-1">
                <label for="kode" class="block mb-2 text-sm font-medium text-gray-900">Kode Promo</label>
                <input name="kode" type="text" id="kode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="BDAY" required />
            </div>
            <div class="flex-1">
                <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900">Jenis Promo</label>
                <input name="jenis" type="text" id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Ulang Tahun" required />
            </div>
        </div>
        <div class="w-2/3">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan Promo</label>
            <input name="keterangan" type="text" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder=" Bagi customer yang beruntungan akan mendapatkan diskon 10%" required />
        </div>
        <div class="flex w-full justify-end">
            <a href="{{ route('kepala-klinik.index-promo') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="confirmSave()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmSave() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Promo akan ditambahkan!",
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