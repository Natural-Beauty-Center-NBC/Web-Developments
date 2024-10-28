<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 !font-poppins">
    <div class="flex justify-between px-4 py-3 lg:px-6 lg:pl-3">
        <!-- Left section with Sidebar Toggle and Logo -->
        <div class="flex items-center">
            <!-- Sidebar Toggle Button -->
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center p-2 text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>

            <!-- Logo -->
            <a href="/" class="flex ml-4 md:mr-24">
                <img class="w-12" src="{{ asset('assets/nbc-logo.PNG') }}" alt="Logo">
            </a>
        </div>

        <!-- Right section with User Menu -->
        <div class="flex items-center">
            <button type="button"
                class="flex items-center text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-10 h-10 rounded-full" src="{{ asset('assets/nbc-logo.PNG') }}" alt="User photo">
            </button>
            <div class="hidden ml-3 text-left lg:block">
                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ Auth::guard('pegawai')->user()->name }}</p>
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ Auth::guard('pegawai')->user()->email }}</p>
            </div>

            <!-- Dropdown User Menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="dropdown-user">
                <div class="px-4 py-3">
                    <p class="text-sm text-gray-900 dark:text-white">{{ Auth::guard('pegawai')->user()->name }}</p>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ Auth::guard('pegawai')->user()->email }}</p>
                </div>
                <ul class="py-1">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                            Settings
                        </a>
                    </li>
                    <li>
                        <a data-modal-target="logout-modal" data-modal-toggle="logout-modal"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white">
                            Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>