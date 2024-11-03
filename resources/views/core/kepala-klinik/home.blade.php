@extends('core.kepala-klinik.layouts.main')
@section('content')
<div class="p-4 my-6 mx-4 bg-white rounded-lg shadow md:flex flex-col md:p-6 xl:p-8 dark:bg-gray-800">
    <div class="w-full flex justify-end mt-4 mb-6">
        <button id="toggleSchedule" class="px-4 py-2 text-white font-semibold bg-[#FF9EAA] rounded-xl focus:outline-none hover:bg-[#eb8995]">
            Tampil Jadwal Beautician
        </button>
    </div>

    <!-- Doctor Schedule Table -->
    <div id="doctorSchedule" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h2 class="text-lg font-medium text-gray-900 sm:text-xl mb-4">Jadwal Dokter NBC</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="dataTableDoctor">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3 border">
                        Shift
                    </th>
                    @foreach($haris as $hari)
                    <th scope="col" class="px-6 py-3 border">
                        {{ $hari->nama }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($shifts as $shift)
                <tr class="bg-white border">
                    <td>
                        <p class="my-1 flex pl-10">{{ $shift->nama }}</p>
                        <p class="mb-2">[{{ $shift->start_at }} WIB - {{ $shift->end_at }} WIB]</p>
                    </td>
                    @foreach($haris as $hari)
                    <td class="border">
                        @foreach($dokters as $dokter)
                        @if($dokter->hari_id == $hari->id && $dokter->shift_id == $shift->id)
                        <div class="my-3">
                            {{ $dokter->pegawai->nama }}
                        </div>
                        @endif
                        @endforeach
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Beautician Schedule Table (Initially Hidden) -->
    <div id="beauticianSchedule" class="relative overflow-x-auto shadow-md sm:rounded-lg hidden">
        <h2 class="text-lg font-medium text-gray-900 sm:text-xl mb-4">Jadwal Beautician NBC</h2>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="dataTableBeautician">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3 border">
                        Shift
                    </th>
                    @foreach($haris as $hari)
                    <th scope="col" class="px-6 py-3 border">
                        {{ $hari->nama }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($shifts as $shift)
                <tr class="bg-white border">
                    <td>
                        <p class="my-1 flex pl-10">{{ $shift->nama }}</p>
                        <p class="mb-2">[{{ $shift->start_at }} WIB - {{ $shift->end_at }} WIB]</p>
                    </td>
                    @foreach($haris as $hari)
                    <td class="border">
                        @foreach($beauticians as $beautician)
                        @if($beautician->hari_id == $hari->id && $beautician->shift_id == $shift->id)
                        <div class="my-3">
                            {{ $beautician->pegawai->nama }}
                        </div>
                        @endif
                        @endforeach
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('toggleSchedule').addEventListener('click', function() {
        const doctorSchedule = document.getElementById('doctorSchedule');
        const beauticianSchedule = document.getElementById('beauticianSchedule');
        const toggleButton = document.getElementById('toggleSchedule');

        if (doctorSchedule.classList.contains('hidden')) {
            doctorSchedule.classList.remove('hidden');
            beauticianSchedule.classList.add('hidden');
            toggleButton.textContent = 'Tampil Jadwal Beautician';
        } else {
            doctorSchedule.classList.add('hidden');
            beauticianSchedule.classList.remove('hidden');
            toggleButton.textContent = 'Tampil Jadwal Dokter';
        }
    });
</script>
@endsection