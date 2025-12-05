<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('LogoProjectKiloMeter.svg') }}" class="h-10 w-auto" alt="Logo">

                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-black hover:text-gray-700">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center space-x-6">

                <!-- Search with Dropdown -->
                <div x-data="{ openSearch: false }" class="relative">
                    <button @click="openSearch = !openSearch"
                        class="text-black hover:text-gray-700 p-2 rounded-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                        </svg>
                    </button>

                    <!-- Dropdown Search Box -->
                    <div x-show="openSearch" @click.outside="openSearch = false"
                        x-transition
                        class="absolute right-0 mt-2 w-64 bg-white border border-gray-300 shadow-lg rounded-md p-3 z-50">

                        <form method="GET" action="{{ route('products.search') }}">
                            <input type="text" name="q"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-black"
                                placeholder="Cari produk...">

                            <button type="submit"
                                class="mt-2 w-full bg-black text-white py-2 text-sm rounded-md hover:bg-gray-800">
                                Cari
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Avatar Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="border border-gray-300 rounded-full w-9 h-9 flex items-center justify-center overflow-hidden bg-gray-200 text-black">
                            @if (Auth::user()->profile_photo_url ?? false)
                            <img src="{{ Auth::user()->profile_photo_url }}" class="object-cover w-full h-full">
                            @else
                            <span class="font-semibold text-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Search Icon -->
            <div class="sm:hidden flex items-center space-x-2">
                <button class="text-black hover:text-gray-700 p-2 rounded-full transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                    </svg>
                </button>

                <!-- Hamburger for Avatar Menu -->
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-black hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="px-4 pt-4 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive User Menu -->
        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4 flex items-center space-x-3">

                <!-- Avatar -->
                <div class="border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center bg-gray-200 text-black overflow-hidden">
                    @if (Auth::user()->profile_photo_url ?? false)
                    <img src="{{ Auth::user()->profile_photo_url }}" class="object-cover w-full h-full">
                    @else
                    <span class="font-semibold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    @endif
                </div>

                <div>
                    <div class="font-medium text-base text-black">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>