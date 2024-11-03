<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-normal">
            <li>
                <a href="{{ route('kepala-klinik.home') }}"
                    class="{{ $title == 'Kepala Klinik | Home' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-house"></i>
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kepala-klinik.index-shift') }}"
                    class="{{ $title == 'Kepala Klinik | Shift' || $title == 'Kepala Klinik | Tambah Shift' || $title == 'Kepala Klinik | Update Shift' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-clipboard-check"></i>
                    <span class="ms-3">Shift</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kepala-klinik.index-penjadwalan') }}"
                    class="{{ $title == 'Kepala Klinik | Penjadwalan' || $title == 'Kepala Klinik | Create Penjadwalan' || $title == 'Kepala Klinik | Update Penjadwalan' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-calendar2-check"></i>
                    <span class="ms-3">Penjadwalan</span>
                </a>
            </li>
            <li>
                <a href=" "
                    class="{{ $title == 'Admin | Pegawai' || $title == 'Admin | Create Pegawai' || $title == 'Admin | Update Pegawai' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-tags"></i>
                    <span class="ms-3">Data Promo</span>
                </a>
            </li>
        </ul>
    </div>
</aside>