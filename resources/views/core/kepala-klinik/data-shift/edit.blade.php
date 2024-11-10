@extends('core.kepala-klinik.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('kepala-klinik.update-shift', ['id' => $shift->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class=" mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Shift</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="w-2/3">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Shift</label>
            <input name="nama" type="text" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" placeholder="Shift 1" value="{{ $shift->nama }}" required />
        </div>
        <div class="flex gap-4 w-2/3 mb-4">
            <div class="flex-1">
                <label for="start_at" class="block mb-2 text-sm font-medium text-gray-900">Jam Mulai</label>
                <input name="start_at" type="time" id="start_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $shift->start_at }}" required />
            </div>
            <div class="flex-1">
                <label for="end_at" class="block mb-2 text-sm font-medium text-gray-900">Jam Selesai</label>
                <input name="end_at" type="time" id="end_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" value="{{ $shift->end_at }}" required />
            </div>
        </div>
        <div class="flex w-full justify-end">
            <button type="button" onclick="confirmUpdate()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Shift akan diubah!",
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