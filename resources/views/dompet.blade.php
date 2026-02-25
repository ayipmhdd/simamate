<x-app-layout>
    <x-slot name="header">
        {{ __('Dompet') }}
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Saldo (Top Section) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Saldo Utama -->
                <div
                    class="md:col-span-2 bg-gradient-to-br from-blue-600 to-indigo-700 dark:from-blue-700 dark:to-indigo-900 rounded-2xl p-6 md:p-8 shadow-lg text-white relative overflow-hidden">
                    <!-- Decorative Circle Abstract -->
                    <div
                        class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full bg-white opacity-10 blur-2xl">
                    </div>
                    <div class="absolute bottom-0 right-10 -mb-10 w-32 h-32 rounded-full bg-white opacity-10 blur-xl">
                    </div>

                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <p class="text-blue-100 font-medium mb-1 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z">
                                    </path>
                                </svg>
                                Total Saldo
                            </p>
                            <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Rp 24.500.000</h1>
                        </div>

                        <div class="flex flex-wrap gap-4 mt-4">
                            <button
                                class="bg-white text-blue-700 hover:bg-gray-50 focus:ring-4 focus:ring-white/50 font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-sm flex items-center gap-2">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Top Up
                            </button>
                            <button
                                class="bg-blue-800/40 hover:bg-blue-800/60 backdrop-blur-sm border border-blue-400/30 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 focus:ring-4 focus:ring-blue-500/50 flex items-center gap-2">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Tarik Saldo
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pemasukan / Pengeluaran -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-center space-y-6">
                    <!-- Pemasukan -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pemasukan</p>
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">Rp 8.200.000</h4>
                        </div>
                    </div>

                    <div class="h-px bg-gray-100 dark:bg-gray-700 w-full"></div>

                    <!-- Pengeluaran -->
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pengeluaran</p>
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">Rp 3.150.000</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Kartu (Middle Section - Horizontal Scroll Carousel) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 overflow-hidden">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Kartu Anda</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola kartu debit/kredit virtual & fisik
                        </p>
                    </div>
                    <button class="text-sm text-blue-600 dark:text-blue-400 font-medium hover:underline">Tambah</button>
                </div>

                <!-- Horizontal Scroll Container -->
                <div class="flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory hide-scroll">
                    <!-- Set manual style for hiding scrollbar as fallback -->
                    <style>
                        .hide-scroll::-webkit-scrollbar {
                            display: none;
                        }

                        .hide-scroll {
                            -ms-overflow-style: none;
                            scrollbar-width: none;
                        }
                    </style>

                    <!-- Kartu 1: Dark Mode / VISA -->
                    <div
                        class="min-w-[300px] sm:min-w-[340px] h-48 bg-gradient-to-tr from-gray-900 to-gray-700 rounded-2xl p-6 text-white relative flex flex-col justify-between shadow-md snap-center shrink-0 overflow-hidden group hover:-translate-y-1 transition duration-300">
                        <div
                            class="absolute inset-0 bg-white opacity-[0.02] bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none">
                        </div>
                        <div
                            class="absolute -right-10 -top-10 w-32 h-32 bg-white/5 rounded-full blur-2xl group-hover:bg-white/10 transition duration-500">
                        </div>

                        <div class="flex justify-between items-start z-10">
                            <!-- SVG Chip -->
                            <svg class="w-10 h-8 text-yellow-500/90 drop-shadow-sm" viewBox="0 0 48 36"
                                fill="currentColor">
                                <path
                                    d="M40 0H8C3.6 0 0 3.6 0 8v20c0 4.4 3.6 8 8 8h32c4.4 0 8-3.6 8-8V8c0-4.4-3.6-8-8-8zm4 28c0 2.2-1.8 4-4 4H8c-2.2 0-4-1.8-4-4V8c0-2.2 1.8-4 4-4h32c2.2 0 4 1.8 4 4v20z" />
                                <path
                                    d="M12 10a2 2 0 100 4 2 2 0 000-4zm0 12a2 2 0 100 4 2 2 0 000-4zm24-12a2 2 0 100 4 2 2 0 000-4zm0 12a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <span class="font-bold italic text-xl tracking-wider text-gray-200">VISA</span>
                        </div>
                        <div class="z-10 mt-auto">
                            <p class="font-mono text-lg tracking-widest mb-2 text-gray-200">**** **** **** 4829</p>
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-0.5">Pemegang Kartu
                                    </p>
                                    <p class="font-medium text-sm tracking-wide">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-0.5">Valid</p>
                                    <p class="font-medium text-sm">12/28</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu 2: Mastercard / Emerald -->
                    <div
                        class="min-w-[300px] sm:min-w-[340px] h-48 bg-gradient-to-br from-emerald-500 to-teal-700 dark:from-emerald-600 dark:to-teal-800 rounded-2xl p-6 text-white relative flex flex-col justify-between shadow-md snap-center shrink-0 overflow-hidden group hover:-translate-y-1 transition duration-300">
                        <div
                            class="absolute -right-20 -bottom-20 w-48 h-48 bg-emerald-300/20 rounded-full blur-3xl group-hover:bg-emerald-300/30 transition duration-500">
                        </div>

                        <div class="flex justify-between items-start z-10">
                            <svg class="w-10 h-8 text-yellow-300/90 drop-shadow-sm" viewBox="0 0 48 36"
                                fill="currentColor">
                                <path
                                    d="M40 0H8C3.6 0 0 3.6 0 8v20c0 4.4 3.6 8 8 8h32c4.4 0 8-3.6 8-8V8c0-4.4-3.6-8-8-8zm4 28c0 2.2-1.8 4-4 4H8c-2.2 0-4-1.8-4-4V8c0-2.2 1.8-4 4-4h32c2.2 0 4 1.8 4 4v20z" />
                                <path
                                    d="M12 10a2 2 0 100 4 2 2 0 000-4zm0 12a2 2 0 100 4 2 2 0 000-4zm24-12a2 2 0 100 4 2 2 0 000-4zm0 12a2 2 0 100 4 2 2 0 000-4z" />
                            </svg>
                            <!-- Fake Mastercard Logo -->
                            <div class="flex items-center -space-x-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-red-500/80 mix-blend-multiply border-2 border-transparent">
                                </div>
                                <div
                                    class="w-8 h-8 rounded-full bg-yellow-500/80 mix-blend-multiply border-2 border-transparent">
                                </div>
                            </div>
                        </div>
                        <div class="z-10 mt-auto">
                            <p class="font-mono text-lg tracking-widest mb-2 text-teal-50">**** **** **** 9104</p>
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] text-teal-200/80 uppercase tracking-widest mb-0.5">Pemegang
                                        Kartu</p>
                                    <p class="font-medium text-sm tracking-wide">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-teal-200/80 uppercase tracking-widest mb-0.5">Valid</p>
                                    <p class="font-medium text-sm">05/26</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tambah Kartu Baru Button -->
                    <button
                        class="min-w-[300px] sm:min-w-[340px] h-48 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl p-6 text-gray-500 dark:text-gray-400 hover:text-blue-600 hover:border-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-500 hover:bg-blue-50/50 dark:hover:bg-gray-700/30 transition-all duration-300 flex flex-col justify-center items-center cursor-pointer snap-center shrink-0 group focus:outline-none focus:ring-4 focus:ring-blue-500/20">
                        <div
                            class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-gray-600 flex items-center justify-center mb-3 transition-colors">
                            <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <p class="font-medium">Tambah Kartu Baru</p>
                    </button>
                </div>
            </div>

            <!-- Riwayat Transaksi (Bottom Section) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Riwayat Transaksi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Daftar transaksi minggu ini</p>
                    </div>
                    <button
                        class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:underline flex items-center gap-1 transition-colors">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Transaction List -->
                <div class="space-y-4">

                    <!-- Transaksi 1 (Keluar - Makanan) -->
                    <div
                        class="flex items-center justify-between p-3.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">Ayam Geprek
                                    Mas Joss</h4>
                                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">Makanan & Minuman <span
                                        class="mx-1">•</span> Hari ini, 12:30</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm md:text-base font-bold text-red-600 dark:text-red-400">- Rp 45.000</p>
                        </div>
                    </div>

                    <!-- Transaksi 2 (Masuk - Transfer) -->
                    <div
                        class="flex items-center justify-between p-3.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">Transfer dari
                                    Budi</h4>
                                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">Pendapatan <span
                                        class="mx-1">•</span> Kemarin, 09:15</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm md:text-base font-bold text-green-600 dark:text-green-500">+ Rp 2.500.000
                            </p>
                        </div>
                    </div>

                    <!-- Transaksi 3 (Keluar - Belanja) -->
                    <div
                        class="flex items-center justify-between p-3.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">Tokopedia</h4>
                                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">Belanja <span
                                        class="mx-1">•</span> 23 Feb 2026, 14:20</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm md:text-base font-bold text-red-600 dark:text-red-400">- Rp 340.000</p>
                        </div>
                    </div>

                    <!-- Transaksi 4 (Keluar - Langganan) -->
                    <div
                        class="flex items-center justify-between p-3.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">Netflix
                                    Premium</h4>
                                <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">Hiburan <span
                                        class="mx-1">•</span> 21 Feb 2026, 08:00</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm md:text-base font-bold text-red-600 dark:text-red-400">- Rp 186.000</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
