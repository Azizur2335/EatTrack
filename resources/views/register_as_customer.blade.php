<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<title>Document</title>
</head>
<body>
	<div class="w-full md:w-1/2 bg-gray-100 flex flex-col px-12 py-10">
		<div class="pb-4">
			<img src="img/frame 1.png" alt="" class="w-50">
		</div>
		<hr class="border-gray-300 mb-2">
    	<h1 class="text-3xl font-bold text-orange-700 mb-2">Registrasi Akun Customer</h1>
		<div class="flex-block">
			<form action="/register" method="POST">
				@csrf
				@if ($errors->any())
					<div style="color:red">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<input type="hidden" name="role" value="customer" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label for="" class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap</label>
				<input type="text" name="name" placeholder="Nama Lengkap" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label for="" class="block text-sm font-bold text-gray-800 mb-2">Email</label>
				<input type="email" name="email" placeholder="Email" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label for="" class="block text-sm font-bold text-gray-800 mb-2">Nomor HP/Telepon</label>
				<input type="tel" name="phone" placeholder="Nomor HP" class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label for="" class="block text-sm font-bold text-gray-800 mb-2">Password</label>
				<input type="password" name="password" placeholder="Password"class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<label for="" class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Password</label>
				<input type="password" name="password_confirmation" placeholder="Konfirmasi Password"class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white mb-4">
				<button
					type="submit"
					class="w-full py-3 rounded-lg bg-red-700 hover:bg-red-800 text-white font-bold text-base transition-colors"
					>Login
				</button>
				<!-- Atau -->
				<div class="flex items-center gap-3 my-1">
				<hr class="flex-1 border-gray-300">
				<span class="text-sm text-gray-400">Atau</span>
				<hr class="flex-1 border-gray-300">
				</div>
				<a href="/auth/google" class="w-full py-3 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center gap-3 text-sm font-medium text-gray-700 transition-colors mb-4">
					Lanjutkan dengan Google
				</a>
			</form>
			<a href="/register_page" class="text-gray-700">
				< Kembali
			</a>
		</div>
		<div></div>
	</div>
</body>
</html>