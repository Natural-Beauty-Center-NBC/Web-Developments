@extends('core.customer-service.layouts.main')

@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Daftar Data User</h1>
        </div>

        <div class="flex flex-row justify-between gap-4 text-right mb-4 mt-8">
            <form action="{{ route('user-service.search') }}" method="GET">
                <input
                    id="query"
                    type="text"
                    name="query"
                    placeholder="Cari user..."
                    value="{{ request('query') }}"
                    class="px-3 py-2 border rounded-lg text-sm focus:outline-none w-[350px]" />
                <button
                    type="submit"
                    class="px-3 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                    Search
                </button>
            </form>
            <div>
                <a href="{{ route('user-service.create') }}"
                    class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Data User
                </a>
            </div>
        </div>

        {{-- Menampilkan alert jika data tidak ditemukan --}}
        @if(isset($alert) && $alert)
            <div class="mb-4 p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                {{ $alert }}
            </div>
        @endif
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="dataTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No</th>
                    <th scope="col" class="px-6 py-3 text-left">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left">Tanggal Lahir</th>
                    <th scope="col" class="px-6 py-3 text-left">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3 text-left">Alamat</th>
                    <th scope="col" class="px-6 py-3 text-left">No Telepon</th>
                    <th scope="col" class="px-6 py-3 text-left">Email</th>
                    <th scope="col" class="px-6 py-3 text-left">Alergi Obat</th>
                    <th scope="col" class="px-6 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                @foreach($users as $user)
                <tr class="bg-white border-b">
                    <td class="text-center px-6 py-4">{{ ++$i }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->nama }}
                    </td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4">{{ $user->jenis_kelamin == 'Pria' ? 'Pria' : 'Wanita' }}</td> <!-- Diubah disini -->
                    <td class="px-6 py-4">{{ $user->alamat }}</td>
                    <td class="px-6 py-4">{{ $user->no_telp }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->alergi }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-4">
                            <a href="{{ route('user-service.edit', ['id' => $user->id]) }}"
                                class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Edit
                            </a>
                            <a href="{{ route('user-service.showCard', ['id' => $user->id]) }}"
                                class="inline-flex gap-2 justify-center items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Cetak Kartu
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
