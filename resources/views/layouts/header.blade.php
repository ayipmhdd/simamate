<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20 ? true : false)"
    :class="scrolled ?
        'bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-700 shadow-sm' :
        'bg-transparent border-transparent'"
    class="sticky top-0 z-30 transition-all duration-300">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 w-full">
            <div class="flex items-center">
                <!-- Dynamic Page Title (Replacing old links) -->
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    @isset($header)
                        {{ $header }}
                    @else
                        {{ __('Dashboard') }}
                    @endisset
                </h2>
            </div>

            <!-- Right Side Tools Area -->
            <div class="flex items-center space-x-4">

                <!-- Search Bar -->
                <div class="hidden sm:block relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <!-- Minimalist search input -->
                    <input type="text"
                        class="block w-full max-w-xs p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-colors"
                        placeholder="Search...">
                </div>

                <!-- Settings Icon -->
                <button type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2 transition-colors">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.535.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.707.536.535a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg>
                </button>

                <!-- Notification Icon -->
                <button type="button"
                    class="relative text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2 transition-colors">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.163 4.413.7.7 0 0 0 .372.64c1.664.898 2.465 1.9 2.465 2.828 0 1.25-1.493 2.75-3 2.75H7c-1.507 0-3-1.5-3-2.75 0-.928.801-1.93 2.465-2.828a.7.7 0 0 0 .372-.64A5.338 5.338 0 0 1 12 5.365ZM15 16s-.463 3-3 3-3-3-3-3h6Z" />
                    </svg>
                    <!-- Simple Notification Dot -->
                    <div
                        class="absolute inline-flex items-center justify-center w-2 h-2 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-2 right-2 dark:border-gray-900">
                    </div>
                </button>

                <!-- Settings Dropdown Profile (Avatar) -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center focus:outline-none transition ease-in-out duration-150 rounded-full ring-2 ring-transparent hover:ring-blue-500 focus:ring-blue-500 border-none outline-none">
                                <!-- Circle Avatar -->
                                <div
                                    class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm uppercase shadow-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Dropdown Header for User Information -->
                            <div class="block px-4 py-3 border-b border-gray-100 dark:border-gray-700 text-left">
                                <span
                                    class="block text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                                <span
                                    class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                            </div>

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
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu Dropdown (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-md">
        <!-- Dashboard/Page Title Link (optional for mobile) -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
