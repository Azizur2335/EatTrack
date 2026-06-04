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

        <div class="bg-white p-6 rounded-xl shadow-lg w-[550px]">
            <h2 class="text-2xl font-bold mb-5">Detail Promo</h2>

            <div class="space-y-3 text-sm">

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Nama Promo</span>
                    <span>:</span>
                    <span>Weekend Flash Sale</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Jenis Promo</span>
                    <span>:</span>
                    <span>Diskon Persentase</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Nilai Promo</span>
                    <span>:</span>
                    <span>20%</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Berlaku Mulai</span>
                    <span>:</span>
                    <span>1 Oktober 2026</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Berlaku Sampai</span>
                    <span>:</span>
                    <span>31 Oktober 2026</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Minimal Tamu</span>
                    <span>:</span>
                    <span>2 Orang</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Kuota Total</span>
                    <span>:</span>
                    <span>100 Voucher</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr]">
                    <span class="font-medium">Sisa Kuota</span>
                    <span>:</span>
                    <span>78 Voucher</span>
                </div>

                <div class="grid grid-cols-[180px_20px_1fr] items-start">
                    <span class="font-medium">Deskripsi</span>
                    <span>:</span>
                    <span>
                        Nikmati diskon 20% untuk seluruh menu makanan setiap akhir pekan.
                        Promo berlaku untuk minimal 2 tamu dan tidak dapat digabung
                        dengan promo lainnya.
                    </span>
                </div>

            </div>

            <div class="mt-6 flex justify-end">
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