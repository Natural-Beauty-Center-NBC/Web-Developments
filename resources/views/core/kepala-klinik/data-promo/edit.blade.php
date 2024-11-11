@extends('core.kepala-klinik.layouts.main')
@section('content')
<form id="update-form" class="p-8 my-6 mx-4 bg-white rounded-lg shadow" method="POST" action="{{ route('kepala-klinik.update-promo', $promos->id) }}">
    @csrf
    @method('PUT')
    <h3 class="mt-5 flex items-center mb-4 text-lg font-semibold text-gray-900">Edit Data Promo</h3>
    <div class="w-full flex flex-col gap-4">
        <div class="flex gap-4">
            <div class="w-1/2">
                <label for="kode" class="block mb-2 text-sm font-medium text-gray-900">Kode Promo</label>
                <input name="kode" type="text" id="kode" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5 @error('kode') border-red-500 @enderror" placeholder="BDAY" value="{{ old('kode', $promos->kode) }}" required />
                @error('kode')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/2">
                <label for="jenis" class="block mb-2 text-sm font-medium text-gray-900">Jenis</label>
                <input name="jenis" type="text" id="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5 @error('jenis') border-red-500 @enderror" placeholder="Ulang Tahun" value="{{ old('jenis', $promos->jenis) }}" required />
                @error('jenis')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5 @error('keterangan') border-red-500 @enderror" placeholder="Bagi customer yang berulangtahun mendapat diskon sebesar 20%" rows="5" required>{{ old('keterangan', $promos->keterangan) }}</textarea>
            @error('keterangan')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-4">
            <div class="w-1/2">
                <label for="nilai_potongan" class="block mb-2 text-sm font-medium text-gray-900">Nilai Potongan</label>
                <input name="nilai_potongan" type="number" id="nilai_potongan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5 @error('nilai_potongan') border-red-500 @enderror" placeholder="Contoh: 20 untuk persen atau 50000 untuk nominal" value="{{ old('nilai_potongan', $promos->nilai_potongan) }}" required />
                @error('nilai_potongan')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/2">
                <label for="jenis_potongan" class="block mb-2 text-sm font-medium text-gray-900">Jenis Potongan</label>
                <select name="jenis_potongan" id="jenis_potongan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('jenis_potongan') border-red-500 @enderror" required>
                <option value="" disabled>Pilih Jenis Potongan</option>
                <option value="Persen" {{ $promos->jenis_potongan == 'Persen' ? 'selected' : '' }}>Persen</option>
                <option value="Nominal" {{ $promos->jenis_potongan == 'Nominal' ? 'selected' : '' }}>Nominal</option>
                </select>
            @error('jenis_potongan')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-1/2">
            <label for="periode" class="block mb-2 text-sm font-medium text-gray-900">Periode</label>
                <input name="periode" type="text" id="periode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF9EAA] focus:border-[#FF9EAA] block w-full p-2.5 @error('periode') border-red-500 @enderror" placeholder="misalnya: 21 April atau - untuk semua tanggal" value="{{ old('periode', $promos->periode) }}" required />
                @error('periode')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/2">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('status') border-red-500 @enderror" onchange="updateStatusColor()" required>
                <option value="Aktif" {{ $promos->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Non-Aktif" {{ $promos->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            @error('status')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
            </div>
        </div>
        <div class="flex w-full justify-end mt-4">
            <button type="button" onclick="confirmSave()" class="w-1/4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmSave() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Promo akan diperbarui!",
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('update-form').submit();
            }
        });
    }

    function updateStatusColor() {
        const statusSelect = document.getElementById('status');
        
        // Menghapus kelas warna sebelumnya
        statusSelect.classList.remove('bg-green-100', 'bg-red-100', 'text-green-700', 'text-red-700');

        // Menambahkan kelas warna berdasarkan pilihan
        if (statusSelect.value === 'Aktif') {
            statusSelect.classList.add('bg-green-300', 'text-green-700');
        } else if (statusSelect.value === 'Non-Aktif') {
            statusSelect.classList.add('bg-red-300', 'text-red-700');
        }
    }

    // Memastikan warna yang benar tampil ketika halaman pertama kali dimuat
    document.addEventListener('DOMContentLoaded', updateStatusColor);
</script>

@endsection
