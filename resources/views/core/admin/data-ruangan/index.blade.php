@extends('core.admin.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Daftar Data Ruangan</h1>
        </div>

        <div class="flex flex-row justify-between gap-4 text-right mb-4 mt-8">
            <form action="{{ route('admin.index-ruangan') }}" method="GET">
                <input
                    id="query"
                    type="text"
                    name="query"
                    placeholder="Cari Nomor Ruangan... (mis. 101)"
                    value="{{ request('query') }}"
                    class="px-3 py-2 border rounded-lg text-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA] w-[350px]" />
                <button
                    type="submit"
                    class="px-3 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                    Search
                </button>
            </form>
            <div>
                <button onclick="toggleModal()"
                    class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Data Ruangan
                </button>
            </div>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="dataTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nomor Ruangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status Ruangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assign to
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @foreach($ruangans as $item)
                <tr class="bg-white border-b" data-id="{{ $item->id }}">
                    <td>
                        <p class="text-center">
                            {{ ++$i }}
                        </p>
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->no_ruangan }}
                    </td>
                    <td class="px-6 py-4 ">
                        {{ $item->status }}
                    </td>
                    <td class="px-6 py-4">
                        <select name="assign_to" id="assign_to_{{ $item->id }}" class="px-8 py-2 border rounded-lg text-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]">
                            <option value="" <?= $item->assign_to === null ? 'selected' : ''; ?>>Tidak ada</option>
                            @foreach($beauticians as $staff)
                                @if($item->assign_to === $staff->id || $staff->status === 'Available')
                                    <option value="{{ $staff->id }}" <?= $item->assign_to === $staff->id ? 'selected' : ''; ?>>{{ $staff->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>

                    <td class="px-6 py-4">
                        <form action="{{ route('admin.destroy-ruangan', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Hapus
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Structure -->
    <div id="modal" class="fixed inset-0 hidden z-50 overflow-auto bg-gray-800 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto my-20">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" onclick="toggleModal()">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-3.707-8.707a1 1 0 011.414 0L10 10.586l2.293-2.293a1 1 0 111.414 1.414L11.414 12l2.293 2.293a1 1 0 01-1.414 1.414L10 13.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 12l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Tambah Data Ruangan</h3>
                    <form action="{{ route('admin.store-ruangan') }}" method="POST">
                        @csrf
                        <input
                            type="number"
                            name="no_ruangan"
                            placeholder="Nomor Ruangan"
                            class="px-3 py-2 mb-4 w-full border rounded-lg text-sm focus:ring-[#FF9EAA] focus:border-[#FF9EAA]"
                            required />
                        <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    function toggleModal() {
        document.getElementById('modal').classList.toggle('hidden');
    }

    $(document).ready(function() {
        $('select[name="assign_to"]').on('change', function() {
            var beauticianId = $(this).val();
            var ruanganId = $(this).attr('id').split('_')[2];

            $.ajax({
                url: '/admin/ruangan/' + ruanganId,
                method: 'PUT',
                data: {
                    assign_to: beauticianId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Success",
                            text: "Data Ruangan berhasil diubah!",
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Data Ruangan gagal diubah!",
                            icon: "error"
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.error || xhr.responseText || 'An unexpected error occurred';
                    alert('Error: ' + errorMessage);
                }
            });
        });
    });

    // TODO -> auto loader
</script>
@endsection