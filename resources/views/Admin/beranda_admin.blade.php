<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
		}
		.unbound {
			font-family: 'Unbounded', sans-serif;
		}
	</style>
	<title>Admin Dashboard - EatTrack</title>
</head>
<body class="bg-red-700 min-h-screen">
	<div class="flex min-h-screen">
		<x-sidebar_admin class="flex-shrink-0"></x-sidebar_admin>
		<div class="flex-1 p-8 overflow-y-auto max-h-screen bg-red-700">
			<div class="flex justify-between items-center mb-8">
				<div>
					<h1 class="unbound text-2xl font-bold text-white">Dashboard</h1>
					<p class="text-sm text-red-100 mt-1">Selamat datang kembali, <span class="font-bold underline">{{ auth()->user()->name }}</span>!</p>
				</div>
				<div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-right">
					<p id="liveDate" class="text-[10px] font-semibold text-red-200 uppercase tracking-wider mb-0.5">Selasa, 23 Juni 2026</p>
					<p id="liveTime" class="unbound text-lg font-bold text-white">21:27 WITA</p>
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
				<div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
					<div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm-6 3a2 2 0 11-4 0 2 2 0 014 0z"/>
						</svg>
					</div>
					<div>
						<p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Pengguna</p>
						<h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $totalUsers }}</h3>
						<span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-1">
							+{{ $newUsersThisMonth }} bulan ini
						</span>
					</div>
				</div>
				<div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
					<div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9"/>
						</svg>
					</div>
					<div>
						<p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Restoran</p>
						<h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $totalRestaurants }}</h3>
						<span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-1">
							+{{ $newRestoThisMonth }} bulan ini
						</span>
					</div>
				</div>
				<div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
					<div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
						</svg>
					</div>
					<div>
						<p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Reservasi</p>
						<h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $totalReservations }}</h3>
						<span class="inline-flex items-center text-xs font-medium text-emerald-600 mt-1">
							+{{ $newResvThisMonth }} bulan ini
						</span>
					</div>
				</div>
				<div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
					<div class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 flex-shrink-0">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
						</svg>
					</div>
					<div>
						<p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Laporan</p>
						<h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ \App\Models\Report::count() }}</h3>
						<span class="inline-flex items-center text-xs font-semibold text-rose-600 mt-1">
							{{ \App\Models\Report::where('status','belum_dibaca')->count() }} belum dibaca
						</span>
					</div>
				</div>

			</div>
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

				<div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-md flex flex-col">
					<div class="flex justify-between items-center mb-6">
						<div>
							<h3 class="unbound text-base font-bold text-slate-800">Statistik Reservasi</h3>
							<p class="text-xs text-slate-400 mt-0.5">Visualisasi jumlah reservasi dalam 6 bulan terakhir</p>
						</div>
						<div class="px-3 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-full">
							6 Bulan Terakhir
						</div>
					</div>
					<div class="h-80 flex-1">
						<canvas id="bookingChart"></canvas>
					</div>
				</div>

				<!-- Recent Reports Feed -->
				<div class="bg-white rounded-3xl p-6 shadow-md flex flex-col">
					<div class="flex justify-between items-center mb-6">
						<div>
							<h3 class="unbound text-base font-bold text-slate-800">Laporan Terbaru</h3>
							<p class="text-xs text-slate-400 mt-0.5">Keluhan & Bug masuk dari Customer</p>
						</div>
						<a href="/laporan_admin" class="text-red-600 hover:text-red-800 font-semibold text-xs transition font-bold">Lihat Semua</a>
					</div>
					
					<div class="space-y-4 overflow-y-auto max-h-80 flex-1 pr-1">
						@forelse(\App\Models\Report::with(['customer'])->latest()->take(5)->get() as $report)
							<div class="p-4 bg-slate-50 hover:bg-slate-100/70 border border-slate-100 rounded-2xl transition duration-150 flex flex-col gap-1.5">
								<div class="flex justify-between items-center">
									<span class="text-xs font-semibold text-slate-500">{{ $report->customer->name }}</span>
									@php
										$badgeColor = match($report->category) {
											'bug' => 'bg-red-100 text-red-700',
											'keluhan' => 'bg-amber-100 text-amber-700',
											'saran' => 'bg-blue-100 text-blue-700',
											default => 'bg-slate-100 text-slate-700'
										};
									@endphp
									<span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $badgeColor }}">
										{{ $report->category }}
									</span>
								</div>
								<h4 class="text-xs font-bold text-slate-700 line-clamp-1">{{ $report->title }}</h4>
								<span class="text-[10px] text-slate-400">{{ $report->created_at->diffForHumans() }}</span>
							</div>
						@empty
							<div class="text-center py-12 text-slate-400">
								<svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
								</svg>
								<p class="text-xs">Belum ada laporan dari pelanggan.</p>
							</div>
						@endforelse
					</div>
				</div>

			</div>

		</div>
	</div>

	<script>
		// Live clock & Date
		const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		const DAYS_ID = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
		
		function updateTime() {
			const now = new Date();
			const day = DAYS_ID[now.getDay()];
			const date = now.getDate();
			const month = MONTHS_ID[now.getMonth()];
			const year = now.getFullYear();
			
			const hours = String(now.getHours()).padStart(2, '0');
			const minutes = String(now.getMinutes()).padStart(2, '0');
			
			document.getElementById('liveDate').textContent = `${day}, ${date} ${month} ${year}`;
			document.getElementById('liveTime').textContent = `${hours}:${minutes} WITA`;
		}
		
		setInterval(updateTime, 1000);
		updateTime(); // Initial run

		// Chart styling
		const ctx = document.getElementById('bookingChart').getContext('2d');
		
		// Create gradient
		const gradient = ctx.createLinearGradient(0, 0, 0, 300);
		gradient.addColorStop(0, 'rgba(185, 44, 16, 0.35)');
		gradient.addColorStop(1, 'rgba(185, 44, 16, 0.00)');

		new Chart(ctx, {
			type: 'line',
			data: {
				labels: {!! json_encode($chartLabels) !!},
				datasets: [{
					label: 'Jumlah Reservasi',
					data: {!! json_encode($chartData) !!},
					borderColor: '#B92C10',
					borderWidth: 3.5,
					tension: 0.4,
					fill: true,
					backgroundColor: gradient,
					pointBackgroundColor: '#B92C10',
					pointBorderColor: '#ffffff',
					pointBorderWidth: 2,
					pointRadius: 5,
					pointHoverRadius: 7
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false
					},
					tooltip: {
						backgroundColor: '#0f172a',
						titleFont: { family: 'Inter', size: 12, weight: '600' },
						bodyFont: { family: 'Inter', size: 11 },
						padding: 12,
						cornerRadius: 12,
						displayColors: false,
						callbacks: {
							label: function(context) {
								return context.parsed.y + ' Reservasi';
							}
						}
					}
				},
				scales: {
					y: {
						grid: {
							color: '#f1f5f9',
							drawBorder: false
						},
						ticks: {
							font: { family: 'Inter', size: 10, weight: '500' },
							color: '#94a3b8',
							precision: 0
						}
					},
					x: {
						grid: {
							display: false
						},
						ticks: {
							font: { family: 'Inter', size: 10, weight: '500' },
							color: '#94a3b8'
						}
					}
				}
			}
		});
	</script>
</body>
</html>