<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .unbounded { font-family: 'Unbounded', sans-serif; }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .card-gradient {
            background: linear-gradient(6.04deg, #000000 5.19%, rgba(102,102,102,0) 95.64%);
        }

        .filter-pill { transition: all 0.2s ease; }

        .resto-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .resto-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="m-0 p-0 bg-[#B92C10]">

    <x-navbar></x-navbar>

    {{-- ===== HERO ===== --}}
    <div class="px-8 pt-10 pb-14">
        <div class="relative z-10 max-w-[1400px] mx-auto">

            {{-- Greeting --}}
            <div class="flex items-center gap-5 mb-10">
                {{-- Avatar --}}
                <div class="w-[80px] h-[80px] rounded-full overflow-hidden flex-shrink-0 bg-[#D9D9D9]">
                    @if(auth()->user()?->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                    @else
                        <div class="w-full h-full bg-[#D9D9D9] flex items-center justify-center">
                            <svg class="w-9 h-9 text-[#999]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Text --}}
                <div>
                    <h1 class="unbounded text-[42px] font-normal text-[#D9D9D9] leading-tight underline decoration-2 underline-offset-4">
                        Halo, {{ auth()->user()?->name ?? 'User' }}
                    </h1>
                    <p class="text-[#D9D9D9] text-[20px] mt-1 font-normal">Temukan rasa yang paling kamu sukai</p>
                </div>
            </div>

            {{-- Search Bar --}}
            <div class="flex items-center gap-3">
                <div class="flex-1 bg-[#D9D9D9] rounded-[21px] flex items-center px-5 h-[72px] gap-3">
                    <svg class="w-5 h-5 text-[#696969] flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Cari resto yang paling kamu sukai"
                        class="bg-transparent flex-1 text-[20px] text-[#737373] outline-none placeholder:text-[#737373]"
                    >
                </div>
                {{-- Filter Button --}}
                <button onclick="openFilter()" class="w-[72px] h-[72px] bg-[#F3D042] rounded-[21px] flex items-center justify-center flex-shrink-0 hover:bg-[#e0bc30] transition-colors">
                    <svg class="w-6 h-6 text-[#272727]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <line x1="4" y1="6" x2="20" y2="6"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                        <line x1="11" y1="18" x2="13" y2="18"/>
                    </svg>
                </button>
            </div>

            {{-- Filter Pills --}}
            <div class="flex items-center gap-3 mt-5 flex-wrap">
                <button class="filter-pill active-pill bg-[#F3D042] text-[#474747] font-bold text-[18px] px-6 py-3 rounded-full cursor-pointer" data-filter="semua">Semua</button>
                <button class="filter-pill border-2 border-[#D9D9D9] text-white text-[18px] font-medium px-6 py-3 rounded-full cursor-pointer hover:bg-white/10 transition-colors" data-filter="terlaris">Terlaris</button>
                <button class="filter-pill border-2 border-[#D9D9D9] text-white text-[18px] font-medium px-6 py-3 rounded-full cursor-pointer hover:bg-white/10 transition-colors" data-filter="buka">Buka Sekarang</button>
                <button class="filter-pill border-2 border-[#D9D9D9] text-white text-[18px] font-medium px-6 py-3 rounded-full cursor-pointer hover:bg-white/10 transition-colors" data-filter="rating">Rating Tinggi</button>
                <button class="filter-pill border-2 border-[#D9D9D9] text-white text-[18px] font-medium px-6 py-3 rounded-full cursor-pointer hover:bg-white/10 transition-colors" data-filter="terdekat">Terdekat</button>
            </div>

        </div>
    </div>

    {{-- ===== KATALOG ===== --}}
    <div class="px-8 py-8">
        <div class="max-w-[1400px] mx-auto">
            <div class="bg-[#D9D9D9] rounded-[20px] p-6">

                {{-- Title --}}
                <h2 class="unbounded font-bold text-[28px] text-[#B92C10] mb-6">Katalog Resto</h2>

                {{-- Grid --}}
                <div class="grid grid-cols-3 gap-5" id="restoGrid">

                    @forelse($restaurants as $restaurant)
                    <a
                        href="/katalog/{{ $restaurant->id }}"
                        class="resto-card bg-white rounded-[20px] overflow-hidden shadow-md block"
                        data-status="{{ $restaurant->status }}"
                        data-name="{{ strtolower($restaurant->name) }}"
                    >
                        {{-- Gambar --}}
                        <div class="relative h-[210px] overflow-hidden">
                            @if($restaurant->image)
                                <img
                                    src="{{ asset('storage/' . $restaurant->image) }}"
                                    alt="{{ $restaurant->name }}"
                                    class="w-full h-full object-cover"
                                >
                            @else
                                <div class="w-full h-full bg-[#ccc] flex items-center justify-center">
                                    <svg class="w-14 h-14 text-[#999]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Gradient overlay bawah --}}
                            <div class="card-gradient absolute bottom-0 left-0 right-0 h-[120px]"></div>

                            {{-- Badge Buka / Tutup --}}
                            <div class="absolute top-3 right-3 flex items-center gap-1.5 bg-white rounded-full px-3 py-1 shadow">
                                <div class="w-[13px] h-[13px] rounded-full {{ $restaurant->status === 'active' ? 'bg-[#47DC42]' : 'bg-[#B92C10]' }}"></div>
                                <span class="text-[#474747] text-[13px] font-medium">
                                    {{ $restaurant->status === 'active' ? 'Buka' : 'Tutup' }}
                                </span>
                            </div>
                        </div>

                        {{-- Info bawah --}}
                        <div class="bg-[#D9D9D9] px-4 pt-3 pb-4">
                            <h3 class="unbounded font-bold text-[15px] text-[#272727] leading-snug truncate">
                                {{ $restaurant->name }}
                            </h3>

                            {{-- Tags + Tombol booking --}}
                            <div class="flex items-center gap-1.5 mt-2 flex-wrap">
                                @foreach(array_slice(explode(',', $restaurant->category ?? 'Makanan'), 0, 2) as $tag)
                                    <span class="bg-[#F3D042] text-[#474747] text-[11px] font-medium px-2.5 py-0.5 rounded-[9.5px]">
                                        {{ trim($tag) }}
                                    </span>
                                @endforeach

                                {{-- Tombol + booking --}}
                                <div class="ml-auto bg-[#B92C10] rounded-[9.5px] w-[34px] h-[26px] flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Jarak --}}
                            <p class="text-[#737373] text-[12px] font-medium mt-1.5">4,5 Km ....</p>
                        </div>
                    </a>

                    @empty
                    <div class="col-span-3 text-center py-16 text-[#737373]">
                        <svg class="w-14 h-14 mx-auto mb-3 text-[#bbb]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-[16px] font-medium">Belum ada restoran tersedia</p>
                        <p class="text-[14px] mt-1 text-[#aaa]">Coba lagi nanti</p>
                    </div>
                    @endforelse

                </div>

                {{-- Muat Selengkapnya --}}
                @if(method_exists($restaurants, 'hasMorePages') && $restaurants->hasMorePages())
                <div class="mt-8">
                    <a
                        href="{{ $restaurants->nextPageUrl() }}"
                        class="block w-full border border-[#474747] rounded-[20px] py-4 text-center text-[#474747] text-[18px] hover:bg-[#ccc] transition-colors"
                    >
                        Muat Selengkapnya
                    </a>
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="px-8 py-8">
        <div class="max-w-[1400px] mx-auto">

            <div class="
                h-auto
                rounded-3xl
                bg-[url('/img/gambar_1.jpg')]
                bg-cover
                bg-center
                relative
                overflow-hidden
            ">

                <div class="absolute inset-0 bg-black/65"></div>

                <div class="relative py-12 h-full justify-between items-center px-16 text-white">
                    <h1 class="text-5xl font-bold mb-4">
                        Promo Spesial Bulan Ini 🎉
                    </h1>
    
                    <p class="mb-6 text-white">
                        Dapatkan diskon reservasi hingga 50% di restoran favorit Anda.
                    </p>
    
                    <div class="overflow-x-auto hide-scrollbar">
                        <div class="flex gap-8 w-max py-4 ">

                            <div class="w-85 min-w-85 bg-white rounded-xl overflow-hidden">
                            <div class="h-[180px] overflow-hidden">
                                    <img
                                        src="img/gambar_1.jpg"
                                        alt=""
                                        class="w-full h-full object-cover"
                                    >
                                </div>

                                <!-- Isi Card -->
                                <div class="p-6">
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                        Aktif
                                    </span>

                                    <h3 class="font-bold text-xl mt-3 text-black">
                                        Weekend Flash Sale
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        Berlaku sampai 3 Oktober 2026
                                    </p>
                                    <div class="mt-2 text-gray-500">
                                        Kuota terbatas
                                    </div>
                                    <div class="flex justify-end mt-4">
                                        <button class="px-4 py-2 rounded-xl bg-yellow-400 hover:bg-yellow-500">
                                            Detail
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

    
                    <div class="mt-6">
                        <a href="/promo" class="bg-red-700 text-white font-semibold px-6 py-3 rounded-xl hover:shadow-lg transition">
                            Lihat Selengkapnya
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div id="isiFilter" class="w-120 bg-sky-700">
        <div>
            bok
        </div>
        <button onclick="closeFilter()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            detail
        </button>
    </div>

    <script>
        function openFilter() {
            document.getElementById("isiFilter").classList.remove("hidden");
        }

        function closeFilter() {
            document.getElementById("isiFilter").classList.add("hidden");
        }
        // ── Search live filter ──
        document.getElementById('searchInput').addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            document.querySelectorAll('#restoGrid a[data-name]').forEach(card => {
                const match = card.dataset.name.includes(keyword);
                card.style.display = match ? 'block' : 'none';
            });
        });

        // ── Filter pills ──
        const pills = document.querySelectorAll('.filter-pill');

        pills.forEach(btn => {
            btn.addEventListener('click', function () {
                // Reset semua pill
                pills.forEach(b => {
                    b.classList.remove('bg-[#F3D042]', 'text-[#474747]', 'font-bold', 'border-0');
                    b.classList.add('border-2', 'border-[#D9D9D9]', 'text-white', 'font-medium');
                });

                // Aktifkan pill yang diklik
                this.classList.add('bg-[#F3D042]', 'text-[#474747]', 'font-bold');
                this.classList.remove('border-2', 'border-[#D9D9D9]', 'text-white', 'font-medium');

                const filter = this.dataset.filter;
                document.querySelectorAll('#restoGrid a[data-status]').forEach(card => {
                    if (filter === 'semua') {
                        card.style.display = 'block';
                    } else if (filter === 'buka') {
                        card.style.display = card.dataset.status === 'active' ? 'block' : 'none';
                    } else {
                        card.style.display = 'block'; // terlaris/rating/terdekat butuh backend
                    }
                });
            });
        });
    </script>

</body>
</html>