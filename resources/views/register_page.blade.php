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
			<div class="bg-red-700 rounded-lg w-full pt-3 pb-3 text-center mb-4 hover:bg-red-900">
				<a href="" class="text-lg font-bold text-white ">Owner</a>
			</div>
			<a href="/register_as_customer" class="text-lg font-bold text-black bg-yellow-400 rounded-lg w-full pt-3 pb-3 text-center mb-4 hover:bg-yellow-700">Customer</a>
			<div class="mt-8">Sudah memiliki akun? <a href="/loginPage" class="text-red-700 hover:underline">Login</a></div>
		</div>
		<div class="overflow-hidden md:w-1/2 w-full h-full">
			<img src="img/gambar_resto.jpg" alt="" class="h-full w-full object-cover">
		</div>
	</div>
</body>
</html>