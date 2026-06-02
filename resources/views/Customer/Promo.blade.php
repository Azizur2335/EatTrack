<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - EatTrack</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-[#B92C10]">

    <!-- NAVBAR -->
	<x-navbar></x-navbar>

	<div class="hero-section px-8 pt-10">
        <div class="relative z-10 max-w-[1400px] mx-auto">

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
                <button class="w-[72px] h-[72px] bg-[#F3D042] rounded-[21px] flex items-center justify-center flex-shrink-0 hover:bg-[#e0bc30] transition-colors">
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

	<!-- PROMO TERBARU -->
	<div class="max-w-[1400px] mx-auto my-6">
		<div class="h-auto rounded-3xl bg-white px-12 py-8">

				<h2 class="text-2xl font-bold mb-2 text-black">
					Promo Terbaru
				</h2>

				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

					<!-- CARD 1 -->
					<div class="flex gap-8 w-max py-4 ">

					<div class="shadow-xl w-85 min-w-85 bg-white rounded-xl overflow-hidden">
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
								<div class="flex justify-end mt-4 gap-2">
									<button onclick="openModal()" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-yellow-500">
										Detail
									</button>
									<button class="px-4 py-2 rounded-xl bg-yellow-400 hover:bg-yellow-500">
										Klaim
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="max-w-[1400px] mx-auto my-6">
        <section class="mb-14">

            <h2 class="text-2xl font-bold mb-6 text-yellow-400">
                Voucher Saya
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="bg-white border-l-4 border-yellow-500 rounded-2xl p-6 shadow">
                    <h3 class="text-red-500 font-bold text-xl mb-2">
                        Diskon 20%
                    </h3>
                    <p class="text-gray-600">
                        Berlaku sampai 30 Juni 2026
                    </p>
                </div>

                <div class="bg-white border-l-4 border-yellow-500 rounded-2xl p-6 shadow">
                    <h3 class="text-red-500 font-bold text-xl mb-2">
                        Cashback Rp25.000
                    </h3>
                    <p class="text-gray-600">
                        Untuk reservasi pertama
                    </p>
                </div>

            </div>

        </section>
	</div>
    <div
        id="modal"
        class="hidden fixed inset-0 bg-black/50 flex justify-center items-center">

        <div class="bg-white p-6 rounded-xl shadow-lg w-120">
            <h2 class="text-2xl font-bold mb-3">Detail</h2>
            <p class="text-gray-600">
                Ini adalah contoh popup menggunakan HTML, CSS, dan JavaScript.
            </p>

            <div class="mt-5 flex justify-end">
                <button
                    onclick="closeModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }
    </script>

</body>
</html>