<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
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
                <a href="{{ route('kepala-klinik.index-promo') }}"
                    class="{{ $title == 'Admin | Pegawai' || $title == 'Admin | Create Pegawai' || $title == 'Admin | Update Pegawai' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-tags"></i>
                    <span class="ms-3">Data Promo</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold w-full p-2 mb-4 rounded-lg"
                    aria-controls="dropdown-batch" data-collapse-toggle="dropdown-batch">
                    <i class="bi bi-graph-up"></i>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Laporan</span>
                    <i class="bi bi-caret-down"></i>
                </button>
                <ul id="dropdown-batch" class="space-y-2 py-2 hidden">
                    <li>
                        <a href="{{ route('kepala-klinik.laporan-customer-baru') }}" class="text-base rounded-lg flex items-center p-2 group !text-[14px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold transition duration-75 pl-8">
                            <i class="bi bi-person-check"></i> &nbsp; Customer Baru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kepala-klinik.laporan-pendapatan') }}" class="text-base rounded-lg flex items-center p-2 group !text-[14px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold transition duration-75 pl-8">
                            <i class="bi bi-cash-coin"></i> &nbsp; Pendapatan
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-base rounded-lg flex items-center p-2 group !text-[14px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold transition duration-75 pl-8">
                            <i class="bi bi-basket"></i> &nbsp; Produk Terlaris
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-base rounded-lg flex items-center p-2 group !text-[14px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold transition duration-75 pl-8">
                            <i class="bi bi-hand-thumbs-up"></i> &nbsp; Perawatan Terlaris
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kepala-klinik.laporan-jumlah-customer') }}" class="text-base rounded-lg flex items-center p-2 group !text-[14px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold transition duration-75 pl-8">
                            <i class="bi bi-people-fill"></i> &nbsp; Jumlah Customer
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>