<x-app-layout>
    <x-slot name="header">
        {{ __('Riwayat Aktivitas') }}
    </x-slot>

    <div class="py-6 sm:py-12 relative">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6 lg:space-y-8">

            @forelse ($historyData as $group)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden relative">

                    <!-- Sticky Header Bulan -->
                    <!-- Gunakan bg-opacity/backdrop-blur untuk Breeze style glass-effect yang solid -->
                    <div
                        class="sticky top-0 z-20 bg-gray-50/90 dark:bg-gray-800/90 backdrop-blur-md px-5 sm:px-7 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center shadow-sm">
                        <div class="flex flex-col">
                            <h3
                                class="text-base sm:text-lg font-bold text-gray-900 dark:text-white uppercase tracking-wider">
                                {{ $group['month'] }}</h3>
                            <div class="flex gap-2 sm:gap-3 text-[10px] sm:text-xs font-medium mt-1">
                                <span class="text-green-600 dark:text-green-400">Pemasukan: Rp
                                    {{ number_format($group['pemasukan'], 0, ',', '.') }}</span>
                                <span class="text-gray-300 dark:text-gray-600">|</span>
                                <span class="text-red-600 dark:text-red-400">Pengeluaran: Rp
                                    {{ number_format($group['pengeluaran'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p
                                class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold mb-0.5">
                                Selisih Bulanan</p>
                            @if ($group['selisih'] >= 0)
                                <h4
                                    class="text-lg sm:text-xl font-bold tracking-tight text-blue-600 dark:text-blue-400">
                                    + Rp {{ number_format($group['selisih'], 0, ',', '.') }}</h4>
                            @else
                                <h4 class="text-lg sm:text-xl font-bold tracking-tight text-red-600 dark:text-red-400">-
                                    Rp {{ number_format(abs($group['selisih']), 0, ',', '.') }}</h4>
                            @endif
                        </div>
                    </div>

                    <!-- List Transaksi -->
                    <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                        @foreach ($group['transactions'] as $transaction)
                            @php
                                $cat = strtolower($transaction->category);
                                $iconBg = 'bg-gray-100 dark:bg-gray-700/50';
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

                            <!-- Single Transaction Row -->
                            <div
                                class="flex items-center justify-between p-3 sm:p-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-all duration-200 cursor-pointer border border-transparent hover:border-gray-100 dark:hover:border-gray-600 group">
                                <div class="flex items-center gap-3 sm:gap-4 flex-1 min-w-0 pr-4">
                                    <div
                                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full {{ $iconBg }} {{ $iconColor }} flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            {!! $iconSvg !!}
                                        </svg>
                                    </div>
                                    <div class="min-w-0 overflow-hidden">
                                        <h4
                                            class="text-sm md:text-base font-bold text-gray-900 dark:text-white truncate">
                                            {{ $transaction->category }}
                                        </h4>
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 gap-1 sm:gap-2 mt-0.5 sm:mt-1">
                                            <span class="truncate block w-full max-w-[120px] sm:max-w-[200px]"
                                                title="{{ $transaction->description ?? ucfirst($transaction->type) }}">
                                                {{ $transaction->description ?? ucfirst($transaction->type) }}
                                            </span>
                                            <span
                                                class="hidden sm:inline-block text-gray-300 dark:text-gray-600">•</span>
                                            <span
                                                class="flex items-center gap-1 font-medium bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded text-gray-600 dark:text-gray-300 w-max shrink-0">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg>
                                                {{ $transaction->account_type }}
                                            </span>
                                            <span
                                                class="hidden sm:inline-block text-gray-300 dark:text-gray-600">•</span>
                                            <span
                                                class="shrink-0">{{ $transaction->transaction_date->format('d M Y') }}
                                                <span class="mx-1">•</span>
                                                {{ $transaction->transaction_date->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    @if ($transaction->type === 'pemasukan')
                                        <p
                                            class="text-xs sm:text-sm md:text-base font-bold text-green-600 dark:text-green-500">
                                            + Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                    @else
                                        <p
                                            class="text-xs sm:text-sm md:text-base font-bold text-red-600 dark:text-red-400">
                                            - Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-12 text-center h-96 flex flex-col justify-center items-center">
                    <div
                        class="w-20 h-20 bg-gray-50 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-10 w-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Riwayat</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-sm mx-auto text-sm">Anda belum memiliki catatan
                        transaksi apapun. Mulailah mencatat pemasukan dan pengeluaran terlebih dahulu.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
