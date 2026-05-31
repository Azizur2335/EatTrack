<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registrasi Owner EatTrack</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Login - EatTrack</title>
  <style>
    * { font-family: 'Inter', sans-serif; }
    h1 { font-family: 'Unbounded', sans-serif; }
  </style>
</head>
<body>
	
	<div class="w-full md:w-1/2 bg-gray-100 flex flex-col px-12 py-10">
		<div class="pb-4">
					<img src="img/frame 1.png" alt="" class="w-50">
				</div>

		<!-- Divider -->
		<hr class="border-gray-300 mb-8">

		<div class="text-2xl text-red-700">
			<h1>Registrasi Owner</h1>
		</div>

		<div class="flex items-center justify-center">

			<div class="flex items-center m-4">
				<div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-700 text-white text-sm font-bold leading-none">1</div>
				<span class="pl-4 font-bold text-red-700">Data Owner</span>
			</div>

			<div class="w-10 h-0.5 bg-gray-300"></div>

			<div class="flex items-center m-4">
				<div class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-center text-white leading-none">2</div>
				<span class="pl-4">Data Restoran</span>
			</div>

		</div>

		<!-- STEP 1 -->
		<div id="step1">

			<form action="">
				<label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap</label>
				<input type="text" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Username</label>
				<input type="text" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Email</label>
				<input type="email" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Nomor HP</label>
				<input type="text" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
				<input type="password" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Password</label>
				<input type="password" required placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
			</form>

			<div class="flex justify-between">
				<a href="/register_page" class="font-semibold text-sm text-gray-700">
					< Kembali
				</a>
				<button class="bg-red-700 hover:bg-red-900 text-white font-semibold text-sm px-8 py-3 rounded-xl cursor-pointer transition-colors" onclick="nextStep()">
					Lanjutkan
				</button>
			</div>
		</div>


		<div class="hidden" id="step2">

			<form action="" class="form-grid">
				<label class="block text-sm font-bold text-gray-800 mb-2">Nama Restoran</label>
				<input type="text"class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Kota / Kecamatan</label>
				<input type="text"class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label class="block text-sm font-bold text-gray-800 mb-2">Alamat Restoran</label>
				<textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4"></textarea>
				<label class="block text-sm font-bold text-gray-800 mb-2">Link Google Maps (Opsional)</label>
				<input type="url" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<div class="flex gap-4">
				<div class="flex-1">
						<label class="block text-sm font-bold text-gray-800 mb-2">Jam Buka</label>
						<input type="time" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
					</div>
					<div class="flex-1">
						<label class="block text-sm font-bold text-gray-800 mb-2">Jam Tutup</label>
						<input type="time" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
					</div>
				</div>

				<div class="flex gap-4">
					<div class="flex-1">
						<label class="block text-sm font-bold text-gray-800 mb-2">Kategori Restoran</label>
						<select class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
							<option class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 hover:bg-gray-800 bg-white mb-4">Cafe</option>
						</select>
					</div>
					<div class="flex-1">
						<label class="block text-sm font-bold text-gray-800 mb-2">Kapasitas Meja</label>
						<input type="number" placeholder="Contoh: 20" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
					</div>
				</div>
				<label class="block text-sm font-bold text-gray-800 mb-2">Deskripsi Restoran</label>
				<textarea class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4"></textarea>
				<label class="block text-sm font-bold text-gray-800 mb-2">Foto Restoran / Logo</label>
				<input type="file" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">

			</form>

			<div class="flex justify-between">

				<button class="text-sm border-2 border-gray rounded-xl font-semibold px-8 py-3 hover:border-2 hover:border-red-700 hover:text-red-700 cursor-pointer" onclick="prevStep()">
					Kembali
				</button>

				<button class="text-sm bg-red-700 hover:bg-red-900 text-white font-semibold text-sm px-8 py-3 rounded-xl cursor-pointer transition-colors" onclick="nextStep()">
					Daftar Sebagai Owner
				</button>
			</div>
		</div>
	</div>
<script>

function nextStep(){

    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").style.display = "block";

    document.getElementById("circle2").classList.add("active");
}

function prevStep(){

    document.getElementById("step2").style.display = "none";
    document.getElementById("step1").style.display = "block";

    document.getElementById("circle2").classList.remove("active");
}

</script>

</body>
</html>