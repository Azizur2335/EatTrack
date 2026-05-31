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
		
		<div class="text-2xl text-red-700">
			<h1>Registrasi Owner</h1>
		</div>

		<div class="flex">

			<div class="flex m-4">
				<div class="w-6 h-6 rounded-full bg-red-700 text-center text-white" id="circle1">1</div>
				<span class="px-4">Data Owner</span>
			</div>

			<div class="w-16 h-0.5 align-center bg-gray-300"></div>

			<div class="flex m-4">
				<div class="w-6 h-6 rounded-full bg-red-700 text-center text-white" id="circle2">2</div>
				<span class="px-4">Data Restoran</span>
			</div>

		</div>

		<!-- STEP 1 -->
		<div id="step1" class="form-section">

			<div class="form-grid">

				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" required>
				</div>

				<div class="form-group">
					<label>Username</label>
					<input type="text" required>
				</div>

				<div class="form-group">
					<label>Email</label>
					<input type="email" required>
				</div>

				<div class="form-group">
					<label>Nomor HP</label>
					<input type="text" required>
				</div>

				<div class="form-group">
					<label>Password</label>
					<input type="password" required>
				</div>

				<div class="form-group">
					<label>Konfirmasi Password</label>
					<input type="password" required>
				</div>

			</div>

			<div class="btn-container">
				<div></div>
				<button class="btn btn-primary" onclick="nextStep()">
					Lanjutkan
				</button>
			</div>

		</div>

		<!-- STEP 2 -->
		<div id="step2" class="form-section">

			<div class="form-grid">

				<div class="form-group">
					<label>Nama Restoran</label>
					<input type="text">
				</div>

				<div class="form-group">
					<label>Kota / Kecamatan</label>
					<input type="text">
				</div>

				<div class="form-group full">
					<label>Alamat Restoran</label>
					<textarea></textarea>
				</div>

				<div class="form-group full">
					<label>Link Google Maps (Opsional)</label>
					<input type="url">
				</div>

				<div class="form-group">
					<label>Jam Buka</label>
					<input type="time">
				</div>

				<div class="form-group">
					<label>Jam Tutup</label>
					<input type="time">
				</div>

				<div class="form-group">
					<label>Kategori Restoran</label>
					<select>
						<option>Cafe</option>
						<option>Seafood</option>
						<option>Ayam Geprek</option>
						<option>Japanese Food</option>
						<option>Fast Food</option>
					</select>
				</div>

				<div class="form-group">
					<label>Kapasitas Meja</label>
					<input type="number" placeholder="Contoh: 20">
				</div>

				<div class="form-group full">
					<label>Deskripsi Restoran</label>
					<textarea></textarea>
				</div>

				<div class="form-group full">
					<label>Foto Restoran / Logo</label>
					<input type="file">
				</div>

			</div>

			<div class="btn-container">

				<button class="btn btn-secondary" onclick="prevStep()">
					Kembali
				</button>

				<button class="btn btn-primary">
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