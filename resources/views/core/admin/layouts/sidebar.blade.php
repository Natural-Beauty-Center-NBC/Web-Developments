<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-normal">
            <li>
                <a href="{{ route('admin.home') }}"
                    class="{{ $title == 'Admin | Home' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-house"></i>
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.index-pegawai') }}"
                    class="{{ $title == 'Admin | Pegawai' || $title == 'Admin | Create Pegawai' || $title == 'Admin | Update Pegawai' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-person-fill-check"></i>
                    <span class="ms-3">Data Pegawai</span>
                </a>
            </li>
            <li>
                <a href=" "
                    class="{{ $title == 'Admin' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-capsule-pill"></i>
                    <span class="ms-3">Data Produk</span>
                </a>
            </li>
            <li>
                <a href=" "
                    class="{{ $title == 'Admin' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-stars"></i>
                    <span class="ms-3">Data Perawatan</span>
                </a>
            </li>
            <li>
                <a href=" "
                    class="{{ $title == 'Admin' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-building-check"></i>
                    <span class="ms-3">Data Ruangan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>