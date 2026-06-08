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
        <a href="/promo" class="text-xl {{ request()->is('promo') ? 'font-bold text-[#B92C10]' : 'font-normal text-[#272727]' }} hover:text-[#B92C10] transition">Promo</a>
    </div>

    {{-- Dropdown Kanan --}}
    <div class="relative">
        {{-- Tombol Chevron --}}
        <button
            id="dropdownBtn"
            onclick="toggleDropdown()"
            class="w-10 h-10 rounded-full bg-[#D9D9D9] flex items-center justify-center hover:bg-gray-300 cursor-pointer transition"
        >
            <img src="assets/icon_drop.png" alt="" id="dropdownChevron" class="w-5 h-5 text-[#272727] transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        </button>

        {{-- Dropdown Menu --}}
        <div
            id="dropdownMenu"
            class="absolute right-0 top-14 bg-white overflow-hidden rounded-2xl shadow-lg py-2 w-48 border border-gray-100 hidden transition-all duration-200"
            style="z-index: 9999;"
        >
            {{-- Profile --}}
            <a href="/profile" class="flex items-center gap-3 px-5 py-3 text-[#272727] hover:bg-gray-200 transition text-sm">
                <img src="assets/iconcustomer.png" alt="" class="h-5 w-5">
                Profile
            </a>

            {{-- Laporan --}}
            <a href="/laporan" class="flex items-center gap-3 px-5 py-3 text-[#272727] hover:bg-gray-200 transition text-sm">
                <img src="assets/icon_service.png" alt="" class="h-5 w-5">
                Laporan
            </a>

            {{-- About --}}
            <a href="#" class="flex items-center gap-3 px-5 py-3 text-[#272727] hover:bg-gray-200 transition text-sm">
                <img src="assets/icon_about.png" alt="" class="h-5 w-5">
                About
            </a>

            {{-- Divider --}}
            <div class="border-t border-gray-100 my-1"></div>

            {{-- Logout --}}
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-[#B92C10] hover:bg-red-200 transition text-sm cursor-pointer">
                    <img src="assets/icon_logout.png" alt="" class="h-5 w-5">
                    Logout
                </button>
            </form>
        </div>
    </div>

</nav>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('dropdownMenu');
        const chevron = document.getElementById('dropdownChevron');
        const isHidden = menu.classList.contains('hidden');

        menu.classList.toggle('hidden', !isHidden);
        chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
    }

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function (e) {
        const btn = document.getElementById('dropdownBtn');
        const menu = document.getElementById('dropdownMenu');

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            document.getElementById('dropdownChevron').style.transform = 'rotate(0deg)';
        }
    });
</script>