<nav class="px-6 py-4 bg-white flex justify-between items-center relative">

    {{-- Logo --}}
    <div class="flex items-center">
        <img src="{{ asset('img/logoWEB.png') }}" alt="EatTrack" class="h-12 object-contain">
    </div>

    {{-- Menu Tengah --}}
    <div class="flex items-center gap-10">
        <a href="/beranda" class="text-xl {{ request()->is('beranda') ? 'font-bold text-[#B92C10]' : 'font-normal text-[#272727]' }} hover:text-[#B92C10] transition">Beranda</a>
        <a href="/map" class="text-xl {{ request()->is('map') ? 'font-bold text-[#B92C10]' : 'font-normal text-[#272727]' }} hover:text-[#B92C10] transition">Map</a>
        <a href="/reservasi" class="text-xl {{ request()->is('reservasi') ? 'font-bold text-[#B92C10]' : 'font-normal text-[#272727]' }} hover:text-[#B92C10] transition">Reservasi</a>
    </div>

    {{-- Dropdown Kanan --}}
    <div class="relative group">
        {{-- Tombol Chevron --}}
        <button class="w-10 h-10 rounded-full bg-[#D9D9D9] flex items-center justify-center hover:bg-gray-300 transition">
            <svg class="w-5 h-5 text-[#272727]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div class="absolute right-0 top-14 bg-white rounded-2xl shadow-lg py-2 w-48 border border-gray-100 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200" style="z-index: 9999;">

            {{-- Profile --}}
            <a href="#" class="flex items-center gap-3 px-5 py-3 text-[#272727] hover:bg-gray-50 transition text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>

            {{-- About --}}
            <a href="#" class="flex items-center gap-3 px-5 py-3 text-[#272727] hover:bg-gray-50 transition text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                About
            </a>

            {{-- Divider --}}
            <div class="border-t border-gray-100 my-1"></div>

            {{-- Logout --}}
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-[#B92C10] hover:bg-red-50 transition text-sm">
                    <svg class="w-5 h-5 text-[#B92C10]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

</nav>