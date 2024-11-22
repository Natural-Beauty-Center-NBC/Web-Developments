<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-24 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-normal">
            <li>
                <a href="{{ route('customer-service.home') }}"
                    class="{{ $title == 'Customer Service | Home' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-house"></i>
                    <span class="ms-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user-service.index') }}"
                    class="{{ $title == 'Customer Service | Pendaftaran User' || $title == 'Customer Service | Update Pendaftaran User' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-person-vcard"></i>
                    <span class="ms-3">Pendaftaran User</span>
                </a>
            </li>            
            <li>
                <a href="{{ route('customer-service.create-transaksi') }}"
                    class="{{ $title == 'Customer Service | Tambah Transaksi' || $title == 'Customer Service | Transaksi dengan Konsultasi' || $title == 'Customer Service | Transaksi tanpa Konsultasi' ? 'bg-[#FF9EAA] to-[#5038ED] text-white font-bold' : '' }} flex items-center text-[16px] hover:bg-[#FF9EAA] text-[#171717] hover:text-white hover:font-bold p-2 mb-4 rounded-lg">
                    <i class="bi bi-clipboard2-plus"></i>
                    <span class="ms-3">Pendaftaran Transaksi</span>
                </a>
            </li>
        </ul>
    </div>
</aside>