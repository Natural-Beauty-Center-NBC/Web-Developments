@extends('core.kepala-klinik.layouts.main')
@section('content')
<form id="save-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('kepala-klinik.store-penjadwalan') }}" enctype="multipart/form-data">
    @csrf
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Tambah Penjadwalan</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex w-full gap-4">
            <div class="w-full">
                <label for="pegawai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pegawai (Dokter/ Beautician)</label>
                <select name="pegawai" id="pegawai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                    <option value="" disabled selected>Pilih Pegawai</option>
                    @foreach($dokters as $item)
                        <option class="dokter-option" value="{{ $item->id }}">{{ $item->nama }} - {{ $item->role }}</option>
                    @endforeach
                    @foreach($beauticians as $item)
                        <option class="beautician-option" style="display: none;" value="{{ $item->id }}">{{ $item->nama }} - {{ $item->role }}</option>
                    @endforeach
                </select>
                <div class="flex items-center my-2">
                    <input type="checkbox" id="toggleRole" class="mr-2">
                    <label for="toggleRole" class="text-sm font-medium text-gray-900 dark:text-white">Input Jadwal Beautician?</label>
                </div>
            </div>
            <div class="w-full">
                <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                <select name="shift" id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Shift</option>
                    @foreach($shifts as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }} -> {{ $item->start_at }} WIB - {{ $item->end_at }} WIB</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="w-1/2">
            <label for="hari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari Kerja</label>
            <select name="hari" id="hari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="" disabled selected>Pilih Hari Kerja</option>
                @foreach($haris as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex w-full justify-end">
            <a href="{{ route('kepala-klinik.index-penjadwalan') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cancel</a>
            <button type="button" onclick="confirmSave()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("toggleRole").addEventListener("change", function() {
        const isCheckboxChecked = this.checked;
        const dokterOptions = document.querySelectorAll(".dokter-option");
        const beauticianOptions = document.querySelectorAll(".beautician-option");

        if (isCheckboxChecked) {
            dokterOptions.forEach(option => option.style.display = "none");
            beauticianOptions.forEach(option => option.style.display = "block");
        } else {
            dokterOptions.forEach(option => option.style.display = "block");
            beauticianOptions.forEach(option => option.style.display = "none");
        }
    });

    function confirmSave() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Penjadwalan akan ditambahkan!",
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