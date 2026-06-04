<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<title>Halaman Daftar</title>
	<style>
		h1{
			font-family: "Unbounded", sans-serif;
			font-weight: 700;
		}
	</style>
</head>
<body class="h-screen m-0 overflow-hidden">
	<div class="flex w-screen h-screen">
		<div class="md:w-1/2 flex flex-col px-12 py-10 h-full">
			<div class="pb-4">
				<img src="img/frame 1.png" alt="" class="w-50">
			</div>
			<hr class="border-gray-300 mb-8">
			<h1 class="text-3xl text-red-700 mb-16">Daftar</h1>
			<div class="text-center justify-center mb-4">Daftar akun sebagai:</div>
			<a href="/register_as_owner" class="text-lg font-bold text-white bg-red-700 rounded-lg w-full pt-3 pb-3 text-center mb-4 hover:bg-red-900">Owner</a>
			<a href="/register_as_customer" class="text-lg font-bold text-black bg-yellow-400 rounded-lg w-full pt-3 pb-3 text-center mb-4 hover:bg-yellow-700">Customer</a>
			<div class="flex mt-8 justify-between items-center">
				<a href="/" class="flex w-30 py-2 gap-3 rounded-xl bg-gray-200 hover:bg-gray-400 justify-center items-center"><img src="assets/icon_back.png" alt="" class="h-4 w-4">Kembali</a>
				<div class="">Sudah memiliki akun? <a href="/loginPage" class="text-red-700 hover:underline">Login</a></div>
			</div>
		</div>
		<div class="overflow-hidden md:w-1/2 w-full h-full">
			<img src="img/gambar_resto.jpg" alt="" class="h-full w-full object-cover">
		</div>
	</div>
</body>
</html>