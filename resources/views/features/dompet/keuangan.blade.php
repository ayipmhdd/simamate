<x-app-layout>
    <x-slot name="header">
        {{ __('Dompet') }}
    </x-slot>

    <div x-data="{
        showModal: false,
        transactionType: 'pemasukan',
        amountFormatted: '',
        amount: '',
        category: '',
        accountType: '',
        transactionTime: '',
        openModal(type) {
            this.transactionType = type;
            this.showModal = true;
            this.amountFormatted = '';
            this.amount = '';
            this.category = '';
            this.accountType = '';
            this.transactionTime = '';
        },
        setTimeNow() {
            const now = new Date();
            this.transactionTime = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
        },
        formatRupiah(e) {
            let val = e.target.value.replace(/[^0-9]/g, '');
            this.amount = val;
            if (val) {
                this.amountFormatted = 'Rp ' + parseInt(val, 10).toLocaleString('id-ID');
            } else {
                this.amountFormatted = '';
            }
        }
    }" class="py-6 sm:py-12 relative">
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
                            <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Rp
                                {{ number_format($totalSaldo, 0, ',', '.') }}</h1>
                        </div>

                        <div class="flex flex-wrap gap-4 mt-4">
                            <button @click="openModal('pemasukan')"
                                class="bg-white text-blue-700 hover:bg-gray-50 focus:ring-4 focus:ring-white/50 font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-sm flex items-center gap-2">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Pemasukan
                            </button>
                            <button @click="openModal('pengeluaran')"
                                class="bg-blue-800/40 hover:bg-blue-800/60 backdrop-blur-sm border border-blue-400/30 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 focus:ring-4 focus:ring-blue-500/50 flex items-center gap-2">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Catat Pengeluaran
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
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($pemasukan, 0, ',', '.') }}</h4>
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
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($pengeluaran, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisa Saldo Per Akun (Middle Section - Horizontal Scroll Carousel) -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 overflow-hidden">
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Sisa Saldo Per Akun</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rincian dana di setiap dompet & rekening
                            bank Anda
                        </p>
                    </div>
                </div>

                <!-- Horizontal Scroll Container for Accounts -->
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

                    <!-- Total Saldo Card (Card Utama) -->
                    <div
                        class="min-w-[240px] bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-5 text-white relative flex flex-col justify-between shadow-sm snap-center shrink-0 border border-blue-400/30 overflow-hidden group">
                        <div
                            class="absolute -right-6 -top-6 w-24 h-24 bg-white/10 rounded-full blur-xl group-hover:bg-white/20 transition duration-500">
                        </div>
                        <div class="flex justify-between items-start z-10 mb-4">
                            <div
                                class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M6 14h2m3 0h5M3 7v10a1 1 0 001 1h16a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z">
                                    </path>
                                </svg>
                            </div>
                            <span
                                class="text-sm font-medium text-blue-100 bg-white/10 px-2 py-1 rounded-lg backdrop-blur-sm">Total
                                Keseluruhan</span>
                        </div>
                        <div class="z-10 mt-auto">
                            <p class="text-xs text-blue-200 uppercase tracking-widest mb-1">Gabungan Saldo</p>
                            <h4 class="text-2xl font-bold tracking-tight">Rp
                                {{ number_format($accounts->sum('balance'), 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <!-- Looping for Each Account -->
                    @foreach ($accounts as $acc)
                        @php
                            $accName = strtolower($acc->account_name);
                            $bgClass = 'bg-white dark:bg-gray-800';
                            $iconBg = 'bg-gray-100 dark:bg-gray-700';
                            $iconColor = 'text-gray-600 dark:text-gray-300';
                            $iconSvg = '';

                            if ($accName == 'cash' || $accName == 'tunai') {
                                $iconBg = 'bg-emerald-100 dark:bg-emerald-900/40';
                                $iconColor = 'text-emerald-600 dark:text-emerald-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>';
                            } elseif (str_contains($accName, 'dana')) {
                                $iconBg = 'bg-blue-100 dark:bg-blue-900/40';
                                $iconColor = 'text-blue-500 dark:text-blue-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                            } elseif (str_contains($accName, 'seabank')) {
                                $iconBg = 'bg-orange-100 dark:bg-orange-900/40';
                                $iconColor = 'text-orange-500 dark:text-orange-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                            } elseif (str_contains($accName, 'gopay')) {
                                $iconBg = 'bg-sky-100 dark:bg-sky-900/40';
                                $iconColor = 'text-sky-500 dark:text-sky-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>';
                            } else {
                                $iconBg = 'bg-gray-100 dark:bg-gray-700';
                                $iconColor = 'text-gray-600 dark:text-gray-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>';
                            }
                        @endphp
                        <div
                            class="min-w-[220px] {{ $bgClass }} border border-gray-200 dark:border-gray-700 rounded-2xl p-5 relative flex flex-col justify-between shadow-sm snap-center shrink-0 hover:-translate-y-1 transition duration-300 group">
                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="w-10 h-10 rounded-xl {{ $iconBg }} {{ $iconColor }} flex items-center justify-center group-hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $iconSvg !!}
                                    </svg>
                                </div>
                                <span
                                    class="bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $acc->account_name }}</span>
                            </div>
                            <div class="mt-auto">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Saldo
                                </p>
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Rp
                                    {{ number_format($acc->balance, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    @endforeach
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
                    <button type="button" @click="window.location.href = '{{ route('dompet.riwayat') }}'"
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
                    @forelse ($transactions as $transaction)
                        @php
                            $cat = strtolower($transaction->category);
                            $iconBg = 'bg-gray-100 dark:bg-gray-900/30';
                            $iconColor = 'text-gray-600 dark:text-gray-400';
                            $iconSvg = '';

                            if ($cat == 'gaji') {
                                $iconBg = 'bg-green-100 dark:bg-green-900/30';
                                $iconColor = 'text-green-600 dark:text-green-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                            } elseif ($cat == 'makan') {
                                $iconBg = 'bg-orange-100 dark:bg-orange-900/30';
                                $iconColor = 'text-orange-600 dark:text-orange-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>';
                            } elseif ($cat == 'jajan') {
                                $iconBg = 'bg-purple-100 dark:bg-purple-900/30';
                                $iconColor = 'text-purple-600 dark:text-purple-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>';
                            } elseif ($cat == 'tagihan') {
                                $iconBg = 'bg-blue-100 dark:bg-blue-900/30';
                                $iconColor = 'text-blue-600 dark:text-blue-400';
                                $iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                            } else {
                                if ($transaction->type === 'pemasukan') {
                                    $iconBg = 'bg-emerald-50 dark:bg-emerald-900/20';
                                    $iconColor = 'text-emerald-500 dark:text-emerald-400';
                                    $iconSvg =
                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>';
                                } else {
                                    $iconBg = 'bg-rose-50 dark:bg-rose-900/20';
                                    $iconColor = 'text-rose-500 dark:text-rose-400';
                                    $iconSvg =
                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12H4"></path>';
                                }
                            }
                        @endphp
                        <div
                            class="flex items-center justify-between p-3.5 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-full {{ $iconBg }} {{ $iconColor }} flex items-center justify-center group-hover:scale-105 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $iconSvg !!}
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm md:text-base font-bold text-gray-900 dark:text-white">
                                        {{ $transaction->category }}</h4>
                                    <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">
                                        {{ Str::limit($transaction->description ?? ucfirst($transaction->type), 40) }}
                                        <span class="mx-1">•</span>
                                        {{ $transaction->transaction_date->format('d M Y') }}
                                        <span class="mx-1">•</span>
                                        {{ $transaction->transaction_date->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if ($transaction->type === 'pemasukan')
                                    <p class="text-sm md:text-base font-bold text-green-600 dark:text-green-500">+ Rp
                                        {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                @else
                                    <p class="text-sm md:text-base font-bold text-red-600 dark:text-red-400">- Rp
                                        {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">Belum ada transaksi</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- Add Transaction Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-80 transition-opacity"
                    @click="showModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100 dark:border-gray-700">

                    <form method="POST" action="{{ route('dompet.store') }}">
                        @csrf
                        <input type="hidden" name="type" x-model="transactionType">

                        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-5"
                                id="modal-title"
                                x-text="transactionType === 'pemasukan' ? 'Tambah Pemasukan' : 'Catat Pengeluaran'">
                            </h3>

                            <div class="space-y-4">
                                <div>
                                    <label for="amount_display"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah
                                        (Rp)</label>
                                    <input type="text" id="amount_display" required x-model="amountFormatted"
                                        @input="formatRupiah" placeholder="Rp 0"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                    <input type="hidden" name="amount" x-model="amount">
                                </div>

                                <div>
                                    <label for="category"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                    <select name="category" id="category" x-model="category" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option x-show="transactionType === 'pemasukan'" value="Gaji">Gaji</option>
                                        <option x-show="transactionType === 'pengeluaran'" value="Makan">Makan
                                        </option>
                                        <option x-show="transactionType === 'pengeluaran'" value="Jajan">Jajan
                                        </option>
                                        <option x-show="transactionType === 'pengeluaran'" value="Tagihan">Tagihan
                                        </option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div x-show="category === 'Lainnya'" x-transition style="display: none;">
                                    <label for="other_category"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sebutkan
                                        Kategori Lainnya</label>
                                    <input type="text" name="other_category" id="other_category"
                                        placeholder="Contoh: Bonus, Hadiah, dll"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                </div>

                                <div>
                                    <label for="account_type"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                                        Dana</label>
                                    <select name="account_type" id="account_type" x-model="accountType" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                        <option value="" disabled selected>Pilih Sumber Dana</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Dana">Dana</option>
                                        <option value="SeaBank">SeaBank</option>
                                        <option value="GoPay">GoPay</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div x-show="accountType === 'Lainnya'" x-transition style="display: none;">
                                    <label for="other_account"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sebutkan
                                        Sumber Dana Lainnya</label>
                                    <input type="text" name="other_account" id="other_account"
                                        placeholder="Contoh: BCA, BNI, OVO, dll"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="transaction_date"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                                        <input type="date" name="transaction_date" id="transaction_date" required
                                            value="{{ date('Y-m-d') }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="transaction_time"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Waktu
                                            (Opsional)</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="time" name="transaction_time" id="transaction_time"
                                                x-model="transactionTime"
                                                class="flex-1 min-w-0 block w-full rounded-none rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white">
                                            <button type="button" @click="setTimeNow()"
                                                title="Gunakan waktu saat ini"
                                                class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-colors">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan
                                        Singkat (Opsional)</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white"></textarea>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700/50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-2xl border-t border-gray-200 dark:border-gray-600">
                            <button type="submit"
                                :class="transactionType === 'pemasukan' ?
                                    'bg-green-600 hover:bg-green-700 focus:ring-green-500' :
                                    'bg-red-600 hover:bg-red-700 focus:ring-red-500'"
                                class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                Simpan
                            </button>
                            <button type="button" @click="showModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Toast Notification Flash Message -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transform ease-out duration-300 transition"
                    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                    x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed bottom-4 right-4 sm:right-6 sm:bottom-6 z-[100] max-w-sm w-full bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border-l-4 border-green-500 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Berhasil!</p>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ session('success') }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button @click="show = false"
                                    class="bg-white dark:bg-gray-800 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    <span class="sr-only">Tutup</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
</x-app-layout>
