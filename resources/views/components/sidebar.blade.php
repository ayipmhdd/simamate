<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
    </svg>
</button>

<aside id="logo-sidebar" :class="isSidebarOpen ? 'w-64' : 'w-20'"
    class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">

    <!-- Toggle Button -->
    <button @click="isSidebarOpen = !isSidebarOpen"
        class="absolute -right-3.5 top-8 z-50 hidden sm:flex items-center justify-center w-7 h-7 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none">
        <svg :class="isSidebarOpen ? '' : 'rotate-180'" class="w-4 h-4 text-gray-500 transition-transform duration-300"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <div
        class="h-full px-3 py-4 overflow-y-auto overflow-x-hidden bg-white dark:bg-gray-800 border-e border-gray-100 dark:border-gray-700">
        <a href="https://flowbite.com/" :class="isSidebarOpen ? 'ps-2.5' : 'justify-center'"
            class="flex items-center mb-5">
            <img src="https://flowbite.com/docs/images/logo.svg" :class="isSidebarOpen ? 'me-3' : ''"
                class="h-6 shrink-0" alt="Flowbite Logo" />
            <span x-show="isSidebarOpen"
                class="self-center text-lg font-semibold whitespace-nowrap text-gray-900 dark:text-white">Simamate</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" :class="isSidebarOpen ? '' : 'justify-center'"
                    @class([
                        'flex items-center px-2 py-1.5 rounded-lg group border relative',
                        'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                            'dashboard'),
                        'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                            'dashboard'),
                    ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('dashboard'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'dashboard'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                    </svg>
                    <span x-show="isSidebarOpen" class="ms-3 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('dompet.index') }}" :class="isSidebarOpen ? '' : 'justify-center'" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border relative',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'dompet'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'dompet'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('dompet'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'dompet'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1 ms-3 whitespace-nowrap">Dompet</span>
                </a>
            </li> --}}
            <li x-data="{ isDompetOpen: {{ request()->routeIs('dompet.*') ? 'true' : 'false' }} }" x-effect="if (!isSidebarOpen) { isDompetOpen = false; }">
                <button type="button"
                    @click="if(isSidebarOpen) { isDompetOpen = !isDompetOpen; } else { isSidebarOpen = true; isDompetOpen = true; }"
                    @class([
                        'flex items-center w-full justify-between px-2 py-1.5 rounded-lg group border relative transition-colors',
                        'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                            'dompet.*'),
                        'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                            'dompet.*'),
                    ])>
                    <div class="flex items-center" :class="isSidebarOpen ? '' : 'w-full justify-center'">
                        <svg @class([
                            'shrink-0 w-5 h-5 transition duration-75',
                            'text-blue-600 dark:text-blue-400' => request()->routeIs('dompet.*'),
                            'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                                'dompet.*'),
                        ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1Z" />
                        </svg>
                        <span x-show="isSidebarOpen"
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Dompet</span>
                    </div>
                    <svg x-show="isSidebarOpen" :class="{ 'rotate-180': isDompetOpen }"
                        class="w-5 h-5 transition-transform duration-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="isDompetOpen && isSidebarOpen" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2" class="py-2 space-y-1">
                    <li>
                        <a href="{{ route('dompet.index') }}" @class([
                            'pl-11 flex items-center px-2 py-1.5 text-sm rounded-lg transition-colors group',
                            'text-blue-600 dark:text-blue-400 font-medium' => request()->routeIs(
                                'dompet.index'),
                            'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700' => !request()->routeIs(
                                'dompet.index'),
                        ])>Keuangan</a>
                    </li>
                    <li>
                        <a href="#"
                            class="pl-11 flex items-center px-2 py-1.5 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors group">Tabungan</a>
                    </li>
                    <li>
                        <a href="{{ route('dompet.riwayat') }}" @class([
                            'pl-11 flex items-center px-2 py-1.5 text-sm rounded-lg transition-colors group',
                            'text-blue-600 dark:text-blue-400 font-medium' => request()->routeIs(
                                'dompet.riwayat'),
                            'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700' => !request()->routeIs(
                                'dompet.riwayat'),
                        ])>Riwayat</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" :class="isSidebarOpen ? '' : 'justify-center'" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border relative',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'kanban'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'kanban'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('kanban'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'kanban'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v14M9 5v14M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                    <span x-show="isSidebarOpen"
                        class="px-2 py-0.5 ms-3 text-xs font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                </a>
            </li>
            <li>
                <a href="#" :class="isSidebarOpen ? '' : 'justify-center'" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border relative',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'inbox'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'inbox'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('inbox'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'inbox'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9M9 7h6m-7 3h8" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    <span x-show="isSidebarOpen"
                        class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">2</span>
                </a>
            </li>
            <li>
                <a href="#" :class="isSidebarOpen ? '' : 'justify-center'" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border relative',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'users'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'users'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('users'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'users'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1 ms-3 whitespace-nowrap">Users</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
