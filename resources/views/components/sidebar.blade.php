<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
        viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
    </svg>
</button>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div
        class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800 border-e border-gray-100 dark:border-gray-700">
        <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3" alt="Flowbite Logo" />
            <span
                class="self-center text-lg font-semibold whitespace-nowrap text-gray-900 dark:text-white">Flowbite</span>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'dashboard'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'dashboard'),
                ])>
                    <svg @class([
                        'w-5 h-5 transition duration-75',
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
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
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
                    <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
                    <span
                        class="px-2 py-0.5 ms-3 text-xs font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                </a>
            </li>
            <li>
                <a href="#" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
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
                    <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                    <span
                        class="inline-flex items-center justify-center px-2 py-0.5 ms-3 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">2</span>
                </a>
            </li>
            <li>
                <a href="#" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
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
                    <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                </a>
            </li>
            <li>
                <a href="#" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'products'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'products'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('products'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'products'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                </a>
            </li>
            <li>
                <a href="#" @class([
                    'flex items-center px-2 py-1.5 rounded-lg group border',
                    'border-blue-600 bg-blue-50 text-blue-600 dark:border-blue-500 dark:bg-blue-900/20 dark:text-blue-400' => request()->routeIs(
                        'signin'),
                    'border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' => !request()->routeIs(
                        'signin'),
                ])>
                    <svg @class([
                        'shrink-0 w-5 h-5 transition duration-75',
                        'text-blue-600 dark:text-blue-400' => request()->routeIs('signin'),
                        'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white' => !request()->routeIs(
                            'signin'),
                    ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Sign In</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
