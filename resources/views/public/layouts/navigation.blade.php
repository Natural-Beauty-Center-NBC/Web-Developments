<nav x-data="{ open: false }" class="bg-[#FF9EAA] border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-10">
                    <a href=" ">
                        <img src="{{ asset('assets/nbc-logo.PNG') }}" class="h-10 border border-[#FF9EAA] rounded-xl" alt="NBC Logo" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-24 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('public.home')" :active="request()->routeIs('dashboard')" class="text-white">
                        {{ __('Tentang') }}
                    </x-nav-link>
                    <x-nav-link :href="route('public.home')" :active="request()->routeIs('dashboard')" class="text-white">
                        {{ __('Catalog Produk') }}
                    </x-nav-link>
                    <x-nav-link :href="route('public.home')" :active="request()->routeIs('dashboard')" class="text-white">
                        {{ __('Layanan Perawatan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end gap-6">
                @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->nama }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @else
                <a
                    href="{{ route('login') }}"
                    class="bg-[#FF9EAA] font-bold text-white rounded-lg px-6 py-2 border border-[#f5f4f1] block duration-300 hover:bg-white hover:text-[#FF9EAA]">
                    Log in
                </a>

                @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="bg-[#FF9EAA] font-bold text-white rounded-lg px-6 py-2 border border-[#f5f4f1] block duration-300 hover:bg-white hover:text-[#FF9EAA]">
                    Register
                </a>
                @endif
                @endauth
            </nav>
            @endif

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>