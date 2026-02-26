<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perjalanan (Journey)') }}
        </h2>
    </x-slot>

    <!-- Mapbox GL JS -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>

    <style>
        .mapboxgl-popup-content {
            background-color: transparent !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip {
            border-top-color: rgb(31 41 55) !important;
            /* Tailwind dark:gray-800 */
        }

        html:not(.dark) .mapboxgl-popup-anchor-bottom .mapboxgl-popup-tip {
            border-top-color: white !important;
        }

        .mapboxgl-ctrl-bottom-right,
        .mapboxgl-ctrl-bottom-left {
            display: none !important;
        }
    </style>

    <div class="py-6 sm:py-8 w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div x-data="journeyMap()" x-init="initMap()"
            class="relative w-full h-[calc(100vh-200px)] min-h-[500px] rounded-2xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800">

            <!-- Map Container -->
            <div id="map" class="w-full h-full transition-all" :class="{ 'cursor-crosshair': isPinningMode }"></div>

            <!-- Floating Action Button -->
            <button x-show="!isPinningMode" @click="togglePinningMode"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg shadow-blue-500/30 flex items-center gap-2 transition-transform transform hover:-translate-y-1 z-10">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tinggalkan Jejak
            </button>

            <!-- Status Pinning Bar -->
            <div x-show="isPinningMode" x-transition.opacity
                class="absolute top-6 left-1/2 transform -translate-x-1/2 bg-blue-600/90 backdrop-blur text-white px-6 py-3 rounded-full shadow-lg shadow-blue-500/20 font-semibold flex items-center gap-3 z-10 border border-blue-400">
                <span class="animate-pulse h-3 w-3 bg-white rounded-full"></span>
                Pilih area di peta untuk memberikan pin lokasi
                <button @click="cancelPinningMode" class="ml-4 hover:bg-blue-800 p-1.5 rounded-full transition-colors"
                    title="Batal">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Footprint Overlay Stats -->
            <div x-show="!isPinningMode" x-transition.opacity
                class="absolute top-6 left-6 z-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-5 min-w-[220px]">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4 text-xs tracking-widest uppercase opacity-70">
                    Footprint Saya</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 dark:bg-blue-900/50 p-2.5 rounded-xl text-blue-600 dark:text-blue-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="text-[10px] text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider mb-0.5">
                                Total Kota Kunjungan</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white leading-none"><span
                                    x-text="totalKota"></span> <span
                                    class="text-sm font-semibold opacity-50">Tempat</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="bg-emerald-100 dark:bg-emerald-900/50 p-2.5 rounded-xl text-emerald-600 dark:text-emerald-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p
                                class="text-[10px] text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider mb-0.5">
                                Jarak Jelajah</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white leading-none"><span
                                    x-text="totalDistance"></span> <span
                                    class="text-sm font-semibold opacity-50">km</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toast Success -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition.opacity
                    class="absolute bottom-6 left-6 z-[100] max-w-sm w-full bg-white dark:bg-gray-800 shadow-2xl rounded-2xl border-l-4 border-green-500 p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Berhasil!</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modal Insert Form -->
            <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="showModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"
                        @click="showModal = false" aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="showModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full border border-gray-100 dark:border-gray-700">

                        <form method="POST" action="{{ route('journey.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="latitude" x-model="lat">
                            <input type="hidden" name="longitude" x-model="lng">

                            <div class="px-6 pt-6 pb-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6" id="modal-title">
                                    Catat
                                    Perjalanan</h3>

                                <div class="space-y-4">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Nama
                                            Tempat</label>
                                        <input type="text" name="location_name" required
                                            placeholder="Contoh: Kawah Putih / Monas"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Tanggal
                                            Kunjungan</label>
                                        <input type="date" name="log_date" required x-model="logDate"
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Catatan</label>
                                        <textarea name="note" rows="3" placeholder="Ceritakan momen seru di sini..."
                                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white transition-colors"></textarea>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1">Foto
                                            Kenangan (Opsional)</label>
                                        <input type="file" name="image" accept="image/*"
                                            class="w-full block text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600 cursor-pointer transition-colors">
                                    </div>

                                    <div class="pt-2 text-xs text-gray-500 dark:text-gray-400">
                                        Koordinat: <span x-text="lat + ', ' + lng"></span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-gray-800/80 px-6 py-4 flex flex-row-reverse border-t border-gray-100 dark:border-gray-700 gap-3">
                                <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-transparent px-6 py-2.5 bg-blue-600 text-base font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm transition-colors">Simpan</button>
                                <button type="button" @click="showModal = false"
                                    class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 px-6 py-2.5 bg-white dark:bg-gray-800 text-base font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm transition-colors">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function journeyMap() {
            return {
                showModal: false,
                isPinningMode: false,
                lat: '',
                lng: '',
                logDate: '{{ date('Y-m-d') }}',
                map: null,
                journeys: @json($journeys),
                isDarkMode: document.documentElement.classList.contains('dark'),

                get totalKota() {
                    const cities = new Set(this.journeys.map(j => j.location_name.toLowerCase().trim()));
                    return cities.size;
                },

                get totalDistance() {
                    if (this.journeys.length < 2) return 0;
                    let total = 0;
                    const sorted = [...this.journeys].sort((a, b) => new Date(a.log_date) - new Date(b.log_date));
                    for (let i = 1; i < sorted.length; i++) {
                        total += this.calculateDistance(sorted[i - 1].latitude, sorted[i - 1].longitude, sorted[i]
                            .latitude, sorted[i].longitude);
                    }
                    return Math.round(total);
                },

                calculateDistance(lat1, lon1, lat2, lon2) {
                    const R = 6371; // Radius earth km
                    const dLat = this.deg2rad(lat2 - lat1);
                    const dLon = this.deg2rad(lon2 - lon1);
                    const a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    return R * c;
                },

                deg2rad(deg) {
                    return deg * (Math.PI / 180);
                },

                initMap() {
                    mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN', '') }}';

                    if (!mapboxgl.accessToken) {
                        alert('Oops! Token Mapbox (MAPBOX_ACCESS_TOKEN) belum ditambahkan di file .env');
                        return;
                    }

                    this.map = new mapboxgl.Map({
                        container: 'map',
                        style: this.isDarkMode ? 'mapbox://styles/mapbox/dark-v11' :
                            'mapbox://styles/mapbox/light-v11',
                        center: [106.827153, -6.175392], // Default Jakarta
                        zoom: 5
                    });

                    this.loadMarkers();

                    // Map Click Event logic for pinning
                    this.map.on('click', (e) => {
                        if (this.isPinningMode) {
                            this.lat = e.lngLat.lat.toFixed(8);
                            this.lng = e.lngLat.lng.toFixed(8);
                            this.showModal = true;
                            // Reset so it doesn't stay pinning
                            this.isPinningMode = false;
                        }
                    });

                    this.map.on('mouseenter', () => {
                        if (this.isPinningMode) this.map.getCanvas().style.cursor = 'crosshair';
                    });
                    this.map.on('mouseleave', () => {
                        this.map.getCanvas().style.cursor = '';
                    });

                    // Watch for theme changes (Laravel Breeze switch to dark/light)
                    const observer = new MutationObserver((mutations) => {
                        mutations.forEach((mutation) => {
                            if (mutation.attributeName === 'class') {
                                const dark = document.documentElement.classList.contains('dark');
                                if (dark !== this.isDarkMode) {
                                    this.isDarkMode = dark;
                                    this.map.setStyle(dark ? 'mapbox://styles/mapbox/dark-v11' :
                                        'mapbox://styles/mapbox/light-v11');
                                }
                            }
                        });
                    });
                    observer.observe(document.documentElement, {
                        attributes: true
                    });
                },

                loadMarkers() {
                    this.journeys.forEach(journey => {
                        // Create custom tailwind marker (Blue drop icon)
                        const el = document.createElement('div');
                        el.className = 'cursor-pointer transform hover:scale-110 transition-transform duration-200';
                        el.innerHTML =
                            `<svg class="w-8 h-8 text-blue-600 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 010-5 2.5 2.5 0 010 5z"/></svg>`;

                        let photoHtml = '';
                        if (journey.photo_path) {
                            photoHtml = `<div class="h-32 w-full overflow-hidden bg-gray-100 dark:bg-gray-800 rounded-t-xl">
                                <img src="/storage/${journey.photo_path}" class="w-full h-full object-cover">
                            </div>`;
                        } else {
                            photoHtml =
                                `<div class="h-10 w-full bg-blue-600 rounded-t-xl"></div>`; // fallback header
                        }

                        const popupHtml = `
                            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl w-64 text-left border border-gray-100 dark:border-gray-700">
                                ${photoHtml}
                                <div class="px-5 py-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white text-[16px] mb-1 leading-tight">${journey.location_name}</h3>
                                    <span class="inline-block text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 mb-3">${journey.log_date}</span>
                                    <p class="text-[13px] text-gray-600 dark:text-gray-300 leading-snug line-clamp-3">${journey.note || 'Tidak ada catatan disertakan.'}</p>
                                    
                                    <a href="/dompet/keuangan?location=${encodeURIComponent(journey.location_name)}" class="mt-4 block w-full text-center hover:bg-emerald-50 text-emerald-600 border border-emerald-100 dark:border-emerald-900/50 dark:hover:bg-emerald-900/30 dark:text-emerald-400 text-xs font-bold py-2 px-3 rounded-lg transition-colors flex items-center justify-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        Catat Pengeluaran Lokasi Ini
                                    </a>
                                </div>
                            </div>
                        `;

                        // Add offset to pop-up so it doesn't cover marker tip
                        const popup = new mapboxgl.Popup({
                            offset: 25,
                            closeButton: false
                        }).setHTML(popupHtml);

                        new mapboxgl.Marker(el)
                            .setLngLat([journey.longitude, journey.latitude])
                            .setPopup(popup)
                            .addTo(this.map);
                    });
                },

                togglePinningMode() {
                    this.isPinningMode = true;
                },
                cancelPinningMode() {
                    this.isPinningMode = false;
                }
            }
        }
    </script>
</x-app-layout>
