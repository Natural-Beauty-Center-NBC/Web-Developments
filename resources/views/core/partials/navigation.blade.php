<!-- Navigation Bar -->
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 !font-poppins">
    <div class="flex justify-between px-4 py-3 lg:px-6 lg:pl-3">
        <div class="flex items-center">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="inline-flex items-center p-2 text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>

            <a href="/" class="flex ml-4 md:mr-24">
                <img class="w-12" src="{{ asset('assets/nbc-logo.PNG') }}" alt="Logo">
            </a>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 w-full">
                        <img class="w-12 h-10 object-cover object-center rounded-full border" src="{{ asset('assets/nbc-logo.PNG') }}" alt="user photo">
                        <div class="flex flex-col gap-2 justify-center items-start ml-4">
                            <p class="text-[16px] font-medium text-[#171717]">{{ Auth::guard('pegawai')->user()->nama }}</p>
                            <p class="text-[14px] font-medium text-gray-400 -mt-[5px]">{{ Auth::guard('pegawai')->user()->email }}</p>
                        </div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Logout Form for Pegawai -->
                    <form method="POST" action="{{ route('logout-staff') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout-staff')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="bi bi-door-open"></i> {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>