@extends('core.kepala-klinik.layouts.main')
@section('content')
<form class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('kepala-klinik.update-penjadwalan', ['id' => penjadwalan->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Update Penjadwalan</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex w-full gap-4">
            <div class="w-full">
                <label for="pegawai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pegawai (Dokter/ Beautician)</label>
                <select name="pegawai" id="pegawai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5" required>
                    <option value="" disabled selected>Pilih Pegawai</option>
                    @foreach($dokters as $item)
                        <option class="dokter-option" value="{{ $item->id }}" <?= $penjadwalan->pegawai_id == $item->id ? 'selected' : ''; ?>>
                            {{ $item->nama }} - {{ $item->role }}
                        </option>
                    @endforeach
                    @foreach($beauticians as $item)
                        <option class="beautician-option" style="display: none;" value="{{ $item->id }}" <?= $penjadwalan->pegawai_id == $item->id ? 'selected' : ''; ?>>
                            {{ $item->nama }} - {{ $item->role }}
                        </option>
                    @endforeach
                </select>
                <div class="flex items-center my-2">
                    <input type="checkbox" id="toggleRole" class="mr-2" {{ in_array($penjadwalan->pegawai->role, ['Beautician']) ? 'checked' : '' }}>
                    <label for="toggleRole" class="text-sm font-medium text-gray-900 dark:text-white">Input Jadwal Beautician?</label>
                </div>
            </div>
            <div class="w-full">
                <label for="shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shift</label>
                <select name="shift" id="shift" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" disabled selected>Pilih Shift</option>
                    @foreach($shifts as $item)
                        <option value="{{ $item->id }}" <?= $penjadwalan->shift_id == $item->id ? 'selected' : ''; ?>>{{ $item->nama }} -> {{ $item->start_at }} WIB - {{ $item->end_at }} WIB</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="w-1/2">
            <label for="hari" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hari Kerja</label>
            <select name="hari" id="hari" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="" disabled selected>Pilih Hari Kerja</option>
                @foreach($haris as $item)
                    <option value="{{ $item->id }}" <?= $penjadwalan->hari_id == $item->id ? 'selected' : ''; ?>>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex w-full justify-end">
            <button type="submit" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleRoleCheckbox = document.getElementById("toggleRole");
        const dokterOptions = document.querySelectorAll(".dokter-option");
        const beauticianOptions = document.querySelectorAll(".beautician-option");

        function toggleOptions() {
            if (toggleRoleCheckbox.checked) {
                dokterOptions.forEach(option => option.style.display = "none");
                beauticianOptions.forEach(option => option.style.display = "block");
            } else {
                dokterOptions.forEach(option => option.style.display = "block");
                beauticianOptions.forEach(option => option.style.display = "none");
            }
        }

        // Initialize display based on current selection
        toggleOptions();

        // Add event listener for checkbox
        toggleRoleCheckbox.addEventListener("change", toggleOptions);
    });
</script>
@endsection
