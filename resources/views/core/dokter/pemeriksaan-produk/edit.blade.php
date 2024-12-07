@extends('core.dokter.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">
                Edit Pemeriksaan - {{ $transaksi->customer->nama }} [{{ $transaksi->no_transaksi }}]
            </h3>
        </div>

        <div class="justify-end w-full flex mb-6 gap-2">
            <a href="{{ route('dokter.queue') }}" class="text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            <button type="button" onclick="toggleModalAdd()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Tambah Produk</button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="dataTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Pembelian
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @foreach($detailProduks as $item)
                <tr class="bg-white border-b">
                    <td>
                        <p class="text-center">
                            {{ ++$i }}
                        </p>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->produk->nama }}
                    </td>
                    <td class="px-6 py-4 ">
                        {{ $item->jumlah_pembelian }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button type="button" onclick="toggleModalUpdate({{ $item->id }})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Update</button>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('dokter.delete-produk', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $item->id }})" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Data Detail Produk -->
    <div id="modal-add" class="fixed inset-0 hidden z-50 overflow-auto bg-gray-800 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto my-20">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="toggleModalAdd()">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-8.707a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Tambah Produk</h3>
                    <form id="save-form" action="{{ route('dokter.input-produk') }}" method="POST">
                        @csrf
                        <div>
                            <label for="produk" class="block mb-2 text-sm text-left font-medium text-gray-900 dark:text-white">Produk</label>
                            <select name="produk" id="produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                                <option value="" disabled selected>Pilih Produk</option>
                                @foreach($produks as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-4">
                            <label for="jumlah" class="block mb-2 text-sm text-left font-medium text-gray-900 dark:text-white">Jumlah Pembelian</label>
                            <input name="jumlah" type="number" id="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="10" required />
                        </div>

                        <input type="hidden" id="id_transaksi" name="id_transaksi" value="{{ $transaksi->id }}" />

                        <button type="button" onclick="confirmSave()" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Jumlah Pembelian -->
    <div id="modal-update" class="fixed inset-0 hidden z-50 overflow-auto bg-gray-800 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto my-20">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="toggleModalUpdate()">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-8.707a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Update Jumlah Pembelian</h3>
                    <form id="update-form" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input
                            type="number"
                            name="jumlah"
                            id="jumlah"
                            placeholder="Masukkan Jumlah Pembelian"
                            class="px-3 py-2 mb-4 w-full border rounded-lg text-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                            required />
                        <button type="button" onclick="confirmUpdate()" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleModalAdd() {
        document.getElementById('modal-add').classList.toggle('hidden');
    }

    function toggleModalUpdate(id) {
        const form = document.getElementById('update-form');
        form.action = `/dokter/update-pemeriksaan-produk/${id}`;
        document.getElementById('modal-update').classList.toggle('hidden');
    }

    function confirmSave() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Produk akan ditambahkan!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tambah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`save-form`).submit();
            }
        });
    }

    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Produk akan diubah!",
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

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Detail Produk akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endsection