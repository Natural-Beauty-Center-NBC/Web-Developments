<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-normal">
            <li>
                <a href="{{ route('dokter.queue') }}"
                    class="{{ $title == 'Dokter | Home' || $title == 'Dokter | Riwayat Pemeriksaan' || $title == 'Dokter | Input Pemeriksaan Perawatan' || $title == 'Dokter | Input Pemeriksaan Produk' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-house"></i>
                    <span class="ms-3">Daftar Pemeriksaan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>