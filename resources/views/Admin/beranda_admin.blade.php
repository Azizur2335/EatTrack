<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		li{
			font-family: "Unbounded", sans-serif;
		}
		.unbound{
			font-family: "Unbounded", sans-serif;
		}
	</style>
	<title>Dashboard</title>
</head>
<body>
	<div class="flex min-h-screen">
		<nav class="w-md bg-white">
			<div class="flex px-6 py-2 mt-6 mb-12">
				<div class="rounded-full overflow-hidden size-16">
					<img src="img/profile.jpg" alt="" class="w-full h-full object-cover">
				</div>
				<div class="px-6 py-2">
					<h3>{{ auth()->user()->name }}</h3>
					<p class="text-sm">{{ auth()->user()->email }}</p>
				</div>
			</div>
			<ul>
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/dashboard_admin">Dashboard</a></li>
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/kelola_user">Kelola Pengguna</a></li>
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/laporan">Laporan</a></li>
			</ul>
			<form method="POST" action="/logout" class="px-6 mt-8">
				@csrf
				<button type="submit" class="text-red-600 font-medium">Log Out</button>
			</form>
		</nav>
		<div class="bg-red-700 h-screen w-screen p-6">
			<div class="unbound text-2xl text-white py-6">
				Selamat Datang Minnnn
			</div>
			<div class="grid grid-cols-4 gap-6">
				<div class="rounded-xl bg-white p-4">
					<p class="text-sm mb-2">Total Pengguna</p>
					<p class="unbound text-xl font-bold mb-2">0</p>
					<p class="text-sm mb-2">+Pengguna Baru</p>
				</div>
				<div class="rounded-xl bg-white p-4">
					<p class="text-sm mb-2">Total Pengguna</p>
					<p class="unbound text-xl font-bold mb-2">0</p>
					<p class="text-sm mb-2">+Pengguna Baru</p>
				</div>
				<div class="rounded-xl bg-white p-4">
					<p class="text-sm mb-2">Total Pengguna</p>
					<p class="unbound text-xl font-bold mb-2">0</p>
					<p class="text-sm mb-2">+Pengguna Baru</p>
				</div>
				<div class="rounded-xl bg-white p-4">
					<p class="text-sm mb-2">Total Pengguna</p>
					<p class="unbound text-xl font-bold mb-2">0</p>
					<p class="text-sm mb-2">+Pengguna Baru</p>
				</div>
				<div class="col-span-4 rounded-xl bg-white p-6">
					<h3 class="unbound text-lg mb-4">
						Statistik Reservasi
					</h3>
					<div class="h-80">
						<canvas id="bookingChart"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	const ctx = document.getElementById('bookingChart');

	new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
				'Jan',
				'Feb',
				'Mar',
				'Apr',
				'Mei',
				'Jun'
			],
			datasets: [{
				label: 'Jumlah Reservasi',
				data: [12, 19, 8, 15, 22, 30],
				borderWidth: 3,
				tension: 0.4,
				fill: false
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false
		}
	});
	</script>
</body>
</html>