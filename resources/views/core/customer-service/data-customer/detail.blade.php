@extends('core.customer-service.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-4">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Detail Customer - {{ $user->nama }}</h1>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
        <div class="flex flex-col gap-4">
            <div class="flex flex-row gap-4">
                <img src="{{ asset('assets/nbc-logo.PNG') }}" alt="Customer Profile Picture" class="h-20 rounded-full border" />
                <div class="flex flex-col py-2">
                    <div class="text-[20px] font-extrabold">
                        {{ $user->nama }}
                    </div>
                    <div class="text-[14px]">
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            <div class="font-semibold mt-4">
                Detail Informasi
            </div>
            <div class="flex flex-row gap-16">
                <table>
                    <tbody class="border">
                        <tr>
                            <td class="border p-4">Tanggal Lahir</td>
                            <td class="border p-4">{{ $user->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td class="border p-4">Jenis Kelamin</td>
                            <td class="border p-4">{{ $user->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="border p-4">Nomor Telepon</td>
                            <td class="border p-4">{{ $user->no_telp }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex flex-col gap-4">
                    <div>
                        Alergi
                    </div>
                    <div class="border p-4">
                        {{ $user->alergi }}
                    </div>
                </div>
            </div>
            <div class="flex w-full justify-end mt-6">
                <a href="{{ route('customer-service.index-customer') }}" class="w-1/4 text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                <a href="{{ route('customer-service.edit-customer', ['id' => $user->id]) }}" class="w-1/4 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Shift akan dihapus secara permanen!",
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