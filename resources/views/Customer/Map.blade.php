<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .unbounded { font-family: 'Unbounded', sans-serif; }
        #map { height: calc(100vh - 110px); }
		#panelKiri {
			transition: width 0.3s ease;
		}
		#toggleBtn {
			transition: left 0.3s ease;
		}
		#arrowIcon {
			transition: transform 0.3s ease;
		}
    </style>
    <title>Map - EatTrack</title>
</head>
<body class="m-0 p-0">

    <x-navbar></x-navbar>

    <div class="flex" style="height: calc(100vh - 110px);">

        {{-- ===== PANEL KIRI ===== --}}
        <div id="panelKiri" class="w-[25%] bg-[#B92C10] flex flex-col overflow-hidden transition-all duration-300">

            {{-- Search --}}
            <div class="px-6 pt-6 pb-4">
                <div class="bg-[#F1F1F1] rounded-[14px] flex items-center px-4 h-[52px] gap-3">
                    <svg class="w-4 h-4 text-[#696969] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Cari Makanan kamu sukai" class="bg-transparent flex-1 text-[14px] text-[#737373] outline-none placeholder:text-[#a0a0a0]">
                </div>
            </div>

            {{-- Info --}}
            <div class="px-4 py-2 flex justify-between items-center">
                <span class="text-[#F1F1F1] text-[13px] font-medium">
                    Ditemukan <span id="jumlahResto">{{ count($restaurants) }}</span> Restoran
                </span>
                <span class="text-[#F1F1F1] text-[13px] font-medium">Mataram</span>
            </div>

            {{-- List Restoran --}}
            <div class="flex-1 overflow-y-auto px-6 pb-6" id="listResto">
                <div class="bg-[#F1F1F1] rounded-[21px] p-3 flex flex-col gap-3">

                    @forelse($restaurants as $restaurant)
                    @php
                        // 1. Real-time Status Buka/Tutup
                        $isOpen = false;
                        $now = now('Asia/Makassar');
                        $timeNow = $now->format('H:i:s');
                        $open = $restaurant->open_time;
                        $close = $restaurant->close_time;
                        if ($open && $close) {
                            if ($close >= $open) {
                                $isOpen = ($timeNow >= $open && $timeNow <= $close);
                            } else {
                                $isOpen = ($timeNow >= $open || $timeNow <= $close);
                            }
                        }

                        // 2. Jarak default dari pusat kota Mataram (-8.583333, 116.116667)
                        $lat = $restaurant->latitude ?? -8.583333;
                        $lng = $restaurant->longitude ?? 116.116667;
                        $distance = sqrt(pow(($lat - (-8.583333)) * 111, 2) + pow(($lng - 116.116667) * 111, 2));
                        $distanceStr = number_format($distance, 1, ',', '.') . ' Km';

                        // 3. Rating
                        $ratingStr = $restaurant->reviews->count() > 0 
                            ? number_format($restaurant->reviews->avg('rating'), 1) 
                            : '-';
                    @endphp
                    <div
                        class="resto-card bg-[#F1F1F1] border border-[#737373] rounded-[21px] flex items-center gap-3 p-3 cursor-pointer hover:bg-gray-200 transition"
                        data-lat="{{ $restaurant->latitude ?? '' }}"
                        data-lng="{{ $restaurant->longitude ?? '' }}"
                        data-id="{{ $restaurant->id }}"
                        onclick="focusMarker({{ $restaurant->latitude ?? 'null' }}, {{ $restaurant->longitude ?? 'null' }}, '{{ addslashes($restaurant->name) }}', {{ $restaurant->id }})"
                    >
                        {{-- Foto --}}
                        <div class="w-[72px] h-[72px] rounded-[10px] overflow-hidden flex-shrink-0 bg-gray-300">
                            @if($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-400 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1">
                            <h3 class="unbounded font-medium text-[13px] text-[#272727] leading-tight">{{ $restaurant->name }}</h3>
                            <p class="text-[11px] text-[#737373] mt-1 line-clamp-2">{{ $restaurant->description ?? 'Tidak ada deskripsi' }}</p>
                            <div class="flex items-center gap-3 mt-2 flex-wrap">
                                {{-- Status --}}
                                @if($isOpen)
                                    <span class="bg-[#47DC42] rounded-[9.5px] px-3 py-[2px] text-[12px] font-medium text-[#272727]">Buka</span>
                                @else
                                    <span class="bg-[#B92C10] rounded-[9.5px] px-3 py-[2px] text-[12px] font-medium text-[#F1F1F1]">Tutup</span>
                                @endif
                                {{-- Jarak --}}
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-[#737373]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                    </svg>
                                    <span class="text-[12px] text-[#737373] distance-val">{{ $distanceStr }}</span>
                                </div>
                                {{-- Rating --}}
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-[#F3D042]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                    <span class="text-[12px] text-[#272727]">{{ $ratingStr }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-[#737373]">
						<svg class="w-8 h-8 mx-auto mb-2 text-[#b0b0b0]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9"/>
						</svg>
						<p class="text-[13px]">Belum ada restoran tersedia.</p>
					</div>
                    @endforelse

                </div>
            </div>
        </div>

		{{-- Tombol Toggle --}}
		<button id="toggleBtn" onclick="togglePanel()" class="absolute left-[25%] top-1/2 -translate-y-1/2 z-50 bg-[#B92C10] text-white w-6 h-16 flex items-center justify-center rounded-r-lg shadow-lg hover:bg-[#9a2209] transition-all duration-300" style="z-index:999;">
			<svg id="arrowIcon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
			</svg>
		</button>

        {{-- ===== PANEL KANAN: PETA ===== --}}
        <div class="flex-1 relative">
            <div id="map" class="w-full h-full"></div>
        </div>

    </div>

    <script>
        const map = L.map('map').setView([-8.583333, 116.116667], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Data restoran dari Laravel
        const restaurants = @json($restaurants);

        // Custom marker merah
        const redIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
        });

        // Fallback koordinat acak halus di sekitar Mataram berdasarkan ID
        function getFallbackCoords(id) {
            const seed = id * 9301 + 49297;
            const offsetLat = ((seed % 1000) / 1000 - 0.5) * 0.04;
            const offsetLng = (((seed * 7) % 1000) / 1000 - 0.5) * 0.04;
            return {
                lat: -8.583333 + offsetLat,
                lng: 116.116667 + offsetLng
            };
        }

        // Simpan semua marker agar bisa disaring
        const markerMap = {};

        function isRestoOpen(resto) {
            if (!resto.open_time || !resto.close_time) return false;
            
            // Dapatkan waktu saat ini di Asia/Makassar (UTC+8)
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const makassarTime = new Date(utc + (3600000 * 8));
            
            const hours = String(makassarTime.getHours()).padStart(2, '0');
            const minutes = String(makassarTime.getMinutes()).padStart(2, '0');
            const seconds = String(makassarTime.getSeconds()).padStart(2, '0');
            const timeNow = `${hours}:${minutes}:${seconds}`;
            
            const open = resto.open_time;
            const close = resto.close_time;
            
            if (close >= open) {
                return (timeNow >= open && timeNow <= close);
            } else {
                // Kasus buka melewati tengah malam
                return (timeNow >= open || timeNow <= close);
            }
        }

        restaurants.forEach(function(resto) {
            let lat = parseFloat(resto.latitude);
            let lng = parseFloat(resto.longitude);

            if (!lat || !lng || isNaN(lat) || isNaN(lng)) {
                const fallback = getFallbackCoords(resto.id);
                lat = fallback.lat;
                lng = fallback.lng;
            }

            const marker = L.marker([lat, lng], { icon: redIcon })
                .addTo(map)
                .bindPopup(`
                    <div style="min-width:200px">
                        <b style="font-size:14px">${resto.name}</b><br>
                        <span style="font-size:12px;color:#737373">${resto.address ?? ''}</span><br>
                        <span style="font-size:12px">${isRestoOpen(resto) ? '🟢 Buka' : '🔴 Tutup'}</span>
                        <br><br>
                        <a href="/katalog/${resto.id}" style="background:#B92C10;color:white;padding:6px 12px;border-radius:8px;text-decoration:none;font-size:13px">
                            Lihat Menu & Booking
                        </a>
                    </div>
                `);

            markerMap[resto.id] = { marker, lat, lng, data: resto };
        });

        // Fokus ke marker saat klik list
        function focusMarker(lat, lng, name, id) {
            const entry = markerMap[id];
            if (entry) {
                map.setView([entry.lat, entry.lng], 17);
                entry.marker.openPopup();
            }
        }

        // Pencarian cerdas: prioritas lokal dulu, fallback ke Nominatim
        let geocodeTimer = null;

        document.getElementById('searchInput').addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.resto-card');
            let matched = [];
            let count = 0;

            // Filter list & marker berdasarkan nama, kategori, alamat, kota
            cards.forEach(function(card) {
                const id = parseInt(card.dataset.id);
                const entry = markerMap[id];
                if (!entry) return;

                const r = entry.data;
                const searchable = [
                    r.name, r.category, r.address, r.city, r.description
                ].join(' ').toLowerCase();

                if (!keyword || searchable.includes(keyword)) {
                    card.style.display = 'flex';
                    entry.marker.addTo(map);
                    count++;
                    matched.push(entry);
                } else {
                    card.style.display = 'none';
                    map.removeLayer(entry.marker);
                }
            });

            document.getElementById('jumlahResto').textContent = count;

            // Auto-focus ke restoran pertama yang cocok
            if (keyword && matched.length > 0) {
                map.setView([matched[0].lat, matched[0].lng], 16);
                matched[0].marker.openPopup();
                return; // tidak perlu geocode eksternal
            }

            // Kalau tidak ada match lokal, cari via Nominatim
            if (keyword && matched.length === 0 && keyword.length >= 3) {
                clearTimeout(geocodeTimer);
                geocodeTimer = setTimeout(() => {
                    fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(keyword)}&format=json&limit=1`)
                        .then(res => res.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                const place = data[0];
                                const bbox = place.boundingbox;
                                map.fitBounds([
                                    [parseFloat(bbox[0]), parseFloat(bbox[2])],
                                    [parseFloat(bbox[1]), parseFloat(bbox[3])]
                                ]);
                            }
                        })
                        .catch(err => console.error('Geocode error:', err));
                }, 600);
            }

            // Reset view kalau search dikosongkan
            if (!keyword) {
                map.setView([-8.583333, 116.116667], 14);
            }
        });

        // Toggle panel kiri
        let panelOpen = true;

        function togglePanel() {
            const panel = document.getElementById('panelKiri');
            const btn = document.getElementById('toggleBtn');
            const arrow = document.getElementById('arrowIcon');

            if (panelOpen) {
                panel.style.width = '0';
                panel.style.overflow = 'hidden';
                btn.style.left = '0';
                arrow.style.transform = 'rotate(180deg)';
            } else {
                panel.style.width = '25%';
                panel.style.overflow = '';
                btn.style.left = '25%';
                arrow.style.transform = 'rotate(0deg)';
            }

            panelOpen = !panelOpen;
            setTimeout(() => { map.invalidateSize(); }, 310);
        }

        // Kalkulasi jarak dinamis berdasarkan lokasi user
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon/2) * Math.sin(dLon/2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
            return R * c;
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Tambahkan marker posisi user dengan pin biru
                L.marker([userLat, userLng], {
                    icon: L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41]
                    })
                }).addTo(map).bindPopup('Lokasi Anda');

                // Update jarak di panel sidebar secara real-time
                restaurants.forEach(resto => {
                    let lat = parseFloat(resto.latitude);
                    let lng = parseFloat(resto.longitude);
                    if (!lat || !lng || isNaN(lat) || isNaN(lng)) {
                        const fallback = getFallbackCoords(resto.id);
                        lat = fallback.lat;
                        lng = fallback.lng;
                    }
                    const distance = calculateDistance(userLat, userLng, lat, lng);
                    const distEl = document.querySelector(`.resto-card[data-id="${resto.id}"] .distance-val`);
                    if (distEl) {
                        distEl.textContent = distance.toFixed(1).replace('.', ',') + ' Km';
                    }
                });
            }, error => {
                console.warn("Geolocation tidak diijinkan / error:", error);
            });
        }
    </script>

</body>
</html>