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

	<!-- PROMO TERBARU -->
	<div class="max-w-[1400px] mx-auto my-6">
		<div class="h-auto rounded-3xl bg-white px-12 py-8">

				<h2 class="text-2xl font-bold mb-2 text-black">
					Promo Terbaru
				</h2>

				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($promos as $promo)
                        <div class="shadow-xl bg-white rounded-xl overflow-hidden">
                            <div class="h-[180px] bg-gray-200 flex items-center justify-center overflow-hidden">
                                <span class="text-gray-400 text-sm">{{ $promo->restaurant->name ?? 'Restoran' }}</span>
                            </div>
                            <div class="p-6">
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm">Aktif</span>
                                <h3 class="font-bold text-xl mt-3 text-black">{{ $promo->title }}</h3>
                                <p class="text-gray-500 mt-2">Berlaku sampai {{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d F Y') }}</p>
                                <div class="mt-2 text-gray-500">Diskon {{ $promo->discount }}%</div>
                                <div class="flex justify-end mt-4 gap-2">
                                    <button onclick="openModal({{ $promo->id }})" class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-yellow-500">Detail</button>
                                    <button class="px-4 py-2 rounded-xl bg-yellow-400 hover:bg-yellow-500">Klaim</button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-12 text-gray-400">Belum ada promo aktif saat ini.</div>
                        @endforelse
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
    @foreach($promos as $promo)
<div id="modal-{{ $promo->id }}" class="hidden fixed inset-0 bg-black/50 flex justify-center items-center" style="z-index:9999">
    <div class="bg-white p-6 rounded-xl shadow-lg w-[550px]">
        <h2 class="text-2xl font-bold mb-5">Detail Promo</h2>
        <div class="space-y-3 text-sm">
            <div class="grid grid-cols-[180px_20px_1fr]">
                <span class="font-medium">Nama Promo</span><span>:</span><span>{{ $promo->title }}</span>
            </div>
            <div class="grid grid-cols-[180px_20px_1fr]">
                <span class="font-medium">Restoran</span><span>:</span><span>{{ $promo->restaurant->name ?? '-' }}</span>
            </div>
            <div class="grid grid-cols-[180px_20px_1fr]">
                <span class="font-medium">Nilai Diskon</span><span>:</span><span>{{ $promo->discount }}%</span>
            </div>
            <div class="grid grid-cols-[180px_20px_1fr]">
                <span class="font-medium">Berlaku Mulai</span><span>:</span><span>{{ \Carbon\Carbon::parse($promo->start_date)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="grid grid-cols-[180px_20px_1fr]">
                <span class="font-medium">Berlaku Sampai</span><span>:</span><span>{{ \Carbon\Carbon::parse($promo->end_date)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="grid grid-cols-[180px_20px_1fr] items-start">
                <span class="font-medium">Deskripsi</span><span>:</span><span>{{ $promo->description ?? '-' }}</span>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal({{ $promo->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Tutup</button>
        </div>
    </div>
</div>
@endforeach

    <script>
        function openModal(id) {
            document.getElementById("modal-" + id).classList.remove("hidden");
        }

        function closeModal(id) {
            document.getElementById("modal-" + id).classList.add("hidden");
        }
    </script>

</body>
</html>