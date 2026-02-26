<x-app-layout>
    <x-slot name="header">
        {{ __('Tabungan & Wishlist') }}
    </x-slot>

    <div x-data="{
        showAddModal: false,
        showDepositModal: false,
        selectedSavingId: null,
        selectedSavingName: '',
        depositAmountFormatted: '',
        depositAmount: '',
        formatRupiah(e) {
            let val = e.target.value.replace(/[^0-9]/g, '');
            this.depositAmount = val;
            if (val) {
                this.depositAmountFormatted = 'Rp ' + parseInt(val, 10).toLocaleString('id-ID');
            } else {
                this.depositAmountFormatted = '';
            }
        },
        accountType: '',
        transactionTime: '',
        setTimeNow() {
            const now = new Date();
            this.transactionTime = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
        },
        openDepositModal(id, name) {
            this.selectedSavingId = id;
            this.selectedSavingName = name;
            this.depositAmountFormatted = '';
            this.depositAmount = '';
            this.accountType = '';
            this.transactionTime = '';
            this.showDepositModal = true;
        }
    }" class="py-6 sm:py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Header Section with Add Button -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Target Impian Anda</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Sisihkan dana untuk mewujudkan barang impian.</p>
                </div>
                <button @click="showAddModal = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold flex items-center gap-2 px-5 py-2.5 rounded-xl shadow-sm transition-colors focus:ring-4 focus:ring-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">Buat Target</span>
                </button>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($savings as $saving)
                    @php
                        $percentage =
                            $saving->target_amount > 0
                                ? min(100, ($saving->current_amount / $saving->target_amount) * 100)
                                : 0;
                        $remainingAmount = max(0, $saving->target_amount - $saving->current_amount);
                        $isCompleted = $saving->current_amount >= $saving->target_amount;

                        $timeDiff = 'Tanpa Target Waktu';
                        if ($saving->target_date) {
                            $target = \Carbon\Carbon::parse($saving->target_date);
                            $now = \Carbon\Carbon::now();
                            if ($target->isPast() && !$isCompleted) {
                                $timeDiff = 'Terlewat ' . $target->diffForHumans($now, true);
                            } else {
                                $months = $now->diffInMonths($target);
                                $days = $now->diffInDays($target) % 30; // Approximation
                                if ($months > 0) {
                                    $timeDiff = $months . ' bulan ' . ($days > 0 ? $days . ' hari ' : '') . 'lagi';
                                } else {
                                    $timeDiff = $days . ' hari lagi';
                                }
                            }
                        }
                    @endphp

                    <div
                        class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col group hover:shadow-md transition-shadow relative">
                        <!-- Image Section -->
                        <div
                            class="h-48 w-full bg-gray-100 dark:bg-gray-700 relative overflow-hidden flex items-center justify-center">
                            @if ($saving->image_path)
                                <img src="{{ asset('storage/' . $saving->image_path) }}" alt="{{ $saving->item_name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-xs font-medium">Tanpa Gambar</span>
                                </div>
                            @endif

                            @if ($isCompleted)
                                <div
                                    class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm flex items-center gap-1 backdrop-blur-md bg-opacity-90">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    TERCAPAI
                                </div>
                            @endif

                            <!-- Delete Button Hover -->
                            <div class="absolute top-3 left-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                <form action="{{ route('savings.destroy', $saving) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus wishlist ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-md transition-colors backdrop-blur-md bg-opacity-90">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-1"
                                title="{{ $saving->item_name }}">{{ $saving->item_name }}</h3>

                            <div class="flex items-end gap-2 mb-6">
                                <span
                                    class="text-2xl font-bold text-blue-600 dark:text-blue-400 leading-none shadow-sm">Rp
                                    {{ number_format($saving->target_amount, 0, ',', '.') }}</span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mt-auto mb-4">
                                <div class="flex justify-between text-xs font-semibold mb-2">
                                    <span class="text-gray-500 dark:text-gray-400">Terkumpul: <span
                                            class="text-gray-900 dark:text-white">Rp
                                            {{ number_format($saving->current_amount, 0, ',', '.') }}</span></span>
                                    <span
                                        class="{{ $isCompleted ? 'text-green-500' : 'text-blue-600 dark:text-blue-400' }}">{{ number_format($percentage, 1) }}%</span>
                                </div>
                                <div
                                    class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-3 mb-1 overflow-hidden shadow-inner">
                                    <div class="{{ $isCompleted ? 'bg-green-500' : 'bg-blue-500 dark:bg-blue-600' }} h-3 rounded-full transition-all duration-1000 ease-out relative"
                                        style="width: {{ $percentage }}%">
                                        <div class="absolute top-0 right-0 bottom-0 left-0 bg-white/20 overflow-hidden w-full h-full"
                                            style="background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent); background-size: 1rem 1rem;">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    <p
                                        class="text-[10px] md:text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $timeDiff }}
                                    </p>
                                    @if (!$isCompleted)
                                        <p class="text-[10px] md:text-xs text-orange-500 font-medium">Kurang Rp
                                            {{ number_format($remainingAmount, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Action -->
                            <button
                                @click="openDepositModal({{ $saving->id }}, '{{ addslashes($saving->item_name) }}')"
                                class="{{ $isCompleted ? 'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed' : 'bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800' }} w-full font-semibold py-2.5 rounded-xl transition-colors mt-2"
                                {{ $isCompleted ? 'disabled' : '' }}>
                                {{ $isCompleted ? 'Target Tercapai' : 'Tabung Sekarang' }}
                            </button>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white dark:bg-gray-800 rounded-3xl p-12 text-center border border-dashed border-gray-300 dark:border-gray-700 flex flex-col items-center justify-center min-h-[400px]">
                        <div
                            class="w-24 h-24 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mb-6">
                            <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Target Impian</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-sm mx-auto mb-8">Anda belum menetapkan barang
                            impian apapun. Buat target sekarang dan mulailah menyisihkan uang dari dompet utama Anda.
                        </p>
                        <button @click="showAddModal = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold flex items-center gap-2 px-6 py-3 rounded-xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-1">
                            Buat Wishlist Baru
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Add Wishlist Modal -->
        <div x-show="showAddModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showAddModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"
                    @click="showAddModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showAddModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100 dark:border-gray-700">
                    <form method="POST" action="{{ route('savings.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 pt-6 pb-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6" id="modal-title">Buat
                                Target Wishlist</h3>

                            <div class="space-y-5">
                                <div>
                                    <label for="item_name"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama
                                        Barang Impian</label>
                                    <input type="text" name="item_name" id="item_name" required
                                        placeholder="Contoh: Laptop MacBook Air"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                </div>

                                <div>
                                    <label for="target_amount"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Harga
                                        Target (Rp)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span
                                                class="text-gray-500 dark:text-gray-400 font-medium tracking-widest">Rp</span>
                                        </div>
                                        <input type="number" name="target_amount" id="target_amount" required
                                            min="1" placeholder="15000000"
                                            class="pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                    </div>
                                </div>

                                <div>
                                    <label for="target_date"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Target
                                        Tercapai Pada (Opsional)</label>
                                    <input type="date" name="target_date" id="target_date"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                </div>

                                <div>
                                    <label for="image"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Foto
                                        Ilustrasi Barang</label>
                                    <input type="file" name="image" id="image" accept="image/*"
                                        class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600 transition-all border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-900 focus:outline-none">
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Format: JPG, PNG. Maks:
                                        2MB.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-800/80 px-6 py-4 flex flex-row-reverse border-t border-gray-100 dark:border-gray-700 gap-3">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent px-6 py-2.5 bg-blue-600 text-base font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm transition-colors">Simpan
                                Target</button>
                            <button type="button" @click="showAddModal = false"
                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 px-6 py-2.5 bg-white dark:bg-gray-800 text-base font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm transition-colors">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Funds Modal -->
        <div x-show="showDepositModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDepositModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"
                    @click="showDepositModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showDepositModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-gray-100 dark:border-gray-700">
                    <!-- Form Action Dynamic via Alpine/Str Replace later or inline form action binding -->
                    <form method="POST" :action="`{{ url('/dompet/tabungan') }}/${selectedSavingId}/add-funds`">
                        @csrf
                        <div class="px-6 pt-6 pb-6">
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/40 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1" id="modal-title">Setor
                                Tabungan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Untuk <strong
                                    class="text-gray-700 dark:text-gray-300" x-text="selectedSavingName"></strong></p>

                            <div class="space-y-4">
                                <div>
                                    <label for="deposit_display"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Jumlah
                                        Setoran (Rp)</label>
                                    <input type="text" id="deposit_display" required
                                        x-model="depositAmountFormatted" @input="formatRupiah" placeholder="Rp 0"
                                        class="w-full text-lg font-bold rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors py-3">
                                    <input type="hidden" name="amount" x-model="depositAmount">
                                </div>
                                <!-- Sumber Dana -->
                                <div>
                                    <label for="account_type"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Sumber
                                        Dana</label>
                                    <select name="account_type" id="account_type" x-model="accountType" required
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors py-2.5">
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
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Sumber
                                        Dana Lainnya</label>
                                    <input type="text" name="other_account" id="other_account"
                                        placeholder="Contoh: BCA, BNI, OVO, dll"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="transaction_date"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Tanggal</label>
                                        <input type="date" name="transaction_date" id="transaction_date" required
                                            value="{{ date('Y-m-d') }}"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                    </div>
                                    <div>
                                        <label for="transaction_time"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Waktu
                                            (Opsional)</label>
                                        <div class="flex rounded-xl shadow-sm overflow-hidden">
                                            <input type="time" name="transaction_time" id="transaction_time"
                                                x-model="transactionTime"
                                                class="flex-1 min-w-0 block w-full rounded-none rounded-l-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                            <button type="button" @click="setTimeNow()"
                                                title="Gunakan waktu saat ini"
                                                class="inline-flex items-center px-4 border border-l-0 border-gray-300 bg-gray-100 dark:bg-gray-700 dark:border-gray-600 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none transition-colors">
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
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-800/80 px-6 py-4 flex flex-row-reverse border-t border-gray-100 dark:border-gray-700 gap-3">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent px-6 py-2.5 bg-blue-600 text-base font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm transition-colors">Tabung</button>
                            <button type="button" @click="showDepositModal = false"
                                class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 px-6 py-2.5 bg-white dark:bg-gray-800 text-base font-semibold text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm transition-colors">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                class="fixed bottom-4 right-4 sm:right-6 sm:bottom-6 z-[100] max-w-sm w-full bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border-l-4 border-green-500 overflow-hidden"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
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
                                class="bg-white dark:bg-gray-800 rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
