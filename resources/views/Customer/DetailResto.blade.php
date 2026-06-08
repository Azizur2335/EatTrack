<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $restaurant->name }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
	.unbound{
		font-family: 'Unbounded', sans-serif;
	}
</style>
<body class="min-h-screen bg-gray-200 font-body">

	<!-- NAVBAR -->
	<x-navbar></x-navbar>

	<!-- HERO -->
	<div class="relative h-64 overflow-hidden">
		<img
			src="{{ $restaurant->image ? Storage::url($restaurant->image) : 'https://images.unsplash.com/photo-1544025162-d76694265947?w=1200&q=80' }}"
			alt="{{ $restaurant->name }}"
			class="w-full h-full object-cover object-center"
			/>
		<div class="absolute inset-0 flex flex-col justify-center px-24"
			style="background: linear-gradient(to right, rgba(153,27,27,0.92) 30%, rgba(153,27,27,0.55) 70%, rgba(0,0,0,0.15) 100%)">
			<h1 class="unbound font-display text-4xl font-bold text-white leading-tight mb-1 mx-">{{ $restaurant->name }}</h1>
			<p class="font-semibold text-base mb-3 text-red-300">{{ $restaurant->category }}</p>
			<div class="flex items-center gap-3 mb-3">
				<div class="flex items-center gap-1">
				<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
					<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
				</svg>
				<span class="text-white font-semibold text-sm">
					{{ $restaurant->reviews->count() > 0 ? number_format($restaurant->reviews->avg('rating'), 1) : '-' }}
				</span>
				</div>
				<span class="text-white/60 text-sm">•</span>
				<span class="text-white/80 text-sm">{{ $restaurant->reviews->count() }} Ulasan</span>
			</div>
			<span class="inline-flex items-center gap-2 bg-white/95 text-gray-800 text-xs font-medium px-3 py-1.5 rounded-full w-fit shadow-sm">
				<span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
				Buka {{ $restaurant->open_time ? \Carbon\Carbon::parse($restaurant->open_time)->format('H.i') : '-' }} - {{ $restaurant->close_time ? \Carbon\Carbon::parse($restaurant->close_time)->format('H.i') : '-' }} WITA
			</span>
		</div>
	</div>

  	<!-- MAIN CONTENT -->
  	<div class="max-w-7xl mx-auto px-6 py-6 flex gap-8">

    	<!-- LEFT: MENU -->
		<div class="flex-1 min-w-0">
		<!-- TABS -->
			<div class="flex gap-6 border-gray-200 mb-6">
				<button onclick="showTab('menu')" id="tab-menu"
					class="tab-btn pb-3 text-sm font-semibold text-red-700 -mb-px">
					Menu
				</button>

				<button onclick="showTab('foto')" id="tab-foto"
					class="tab-btn pb-3 text-sm font-medium text-gray-500">
					Foto
				</button>

				<button onclick="showTab('ulasan')" id="tab-ulasan"
					class="tab-btn pb-3 text-sm font-medium text-gray-500">
					Ulasan
				</button>

				<button onclick="showTab('info')" id="tab-info"
					class="tab-btn pb-3 text-sm font-medium text-gray-500">
					Info Restoran
				</button>
			</div>

			<!-- MENU -->
			<div id="content-menu" class="tab-content">
				@forelse($restaurant->menus->groupBy('category') as $kategori => $items)
					<p class="text-sm font-semibold text-gray-700 mb-3 tracking-wide uppercase">
						{{ $kategori }}
					</p>
					@foreach($items as $menu)
					<div class="bg-white rounded-2xl p-4 flex items-center gap-4 mb-3 shadow-sm">
						<img src="{{ $menu->image ? Storage::url($menu->image) : 'https://images.unsplash.com/photo-1558030006-450675393462?w=120&q=80' }}"
							class="w-16 h-16 rounded-xl object-cover">
						<div class="flex-1">
							<p class="font-semibold text-gray-900 text-sm">{{ $menu->name }}</p>
							<p class="text-xs text-gray-400">{{ $menu->description ?? '-' }}</p>
						</div>
						<span class="font-bold text-red-700 text-sm">
							Rp {{ number_format($menu->price, 0, ',', '.') }}
						</span>
					</div>
					@endforeach
					<div class="mb-4"></div>
				@empty
					<p class="text-sm text-gray-400">Belum ada menu.</p>
				@endforelse
			</div>

			<div id="content-ulasan" class="tab-content hidden">
				@forelse($restaurant->reviews()->with('customer')->latest()->get() as $review)
				<div class="bg-white p-4 rounded-2xl shadow-sm mb-3">
					<div class="flex justify-between items-center">
						<h3 class="font-semibold text-sm">{{ $review->customer->name }}</h3>
						<span class="text-yellow-500 text-sm">
							@for($i = 1; $i <= 5; $i++)
								{{ $i <= $review->rating ? '★' : '☆' }}
							@endfor
						</span>
					</div>
					<p class="text-gray-600 mt-2 text-sm">{{ $review->comment ?? '-' }}</p>
					<p class="text-gray-400 text-xs mt-1">{{ $review->created_at->diffForHumans() }}</p>
				</div>
				@empty
				<div class="bg-white rounded-2xl p-6 shadow-sm text-center text-gray-400 text-sm">
					Belum ada ulasan untuk restoran ini.
				</div>
				@endforelse
			</div>

			<div id="content-info" class="tab-content hidden">

				<div class="bg-white rounded-2xl p-6 shadow-sm">

					<h3 class="font-semibold text-lg mb-4">
						Informasi Restoran
					</h3>

					<div class="space-y-3 text-sm">
						<p><strong>Alamat:</strong> {{ $restaurant->address }}{{ $restaurant->city ? ', ' . $restaurant->city : '' }}</p>
						<p><strong>Jam Operasional:</strong> {{ $restaurant->open_time ? \Carbon\Carbon::parse($restaurant->open_time)->format('H.i') : '-' }} - {{ $restaurant->close_time ? \Carbon\Carbon::parse($restaurant->close_time)->format('H.i') : '-' }} WITA</p>
						<p><strong>Telepon:</strong> {{ $restaurant->phone ?? '-' }}</p>
						<p><strong>Kategori:</strong> {{ $restaurant->category }}</p>
						<p><strong>Deskripsi:</strong> {{ $restaurant->description ?? '-' }}</p>
					</div>

				</div>

			</div>
		</div>

		<!-- RIGHT: RESERVATION CARD -->
		<div class="w-96 flex-shrink-0">
			<div class="bg-white rounded-3xl shadow-md p-6">
				<h2 class="font-display text-xl font-bold text-red mb-5">Reservasi Meja</h2>
				<form method="POST" action="/reservasi" id="reservasiForm">
					@csrf
					<input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
					<input type="hidden" name="date" id="selectedDate">
					<input type="hidden" name="guest_count" id="guestCountInput" value="2">

				<!-- CALENDAR -->
				<div class="mb-5">
				<div class="flex items-center justify-between mb-4">
					<button type="button" onclick="prevMonth()" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-red hover:text-red transition-colors">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
					</svg>
					</button>
					<span class="font-semibold text-gray-800 text-sm" id="monthLabel"></span>
					<button type="button" onclick="nextMonth()" class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-red hover:text-red transition-colors">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
					</button>
				</div>

				<!-- Day Headers -->
				<div class="grid grid-cols-7 mb-1">
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Min</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Sen</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Sel</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Rab</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Kam</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Jum</div>
					<div class="w-10 h-10 flex items-center justify-center text-xs font-semibold text-gray-400">Sab</div>
				</div>

				<!-- Days Grid -->
				<div class="grid grid-cols-7 gap-y-1" id="calendarGrid"></div>
				</div>

				<!-- TIME -->
				<div class="mb-4">
				<label class="flex items-center gap-2 text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">
					<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
					</svg>
					Waktu
				</label>
				<input type="time" id="timeInput" name="time"
					class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:border-red focus:ring-2 focus:ring-red/10 transition-all duration-200 font-body"
				/>
				</div>

				<!-- GUESTS & TABLE -->
				<div class="flex gap-3 mb-5">
				<div class="flex-1">
					<label class="flex items-center gap-1.5 text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">
					<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
					</svg>
					Jumlah Tamu
					</label>
					<div class="flex items-center gap-3">
					<button type="button" onclick="decreaseGuests()" class="w-8 h-8 rounded-full border-2 border-red text-red flex items-center justify-center hover:bg-red-700 hover:text-white transition-all text-lg font-bold leading-none">−</button>
					<span class="font-bold text-gray-800 text-base w-4 text-center" id="guestCount">2</span>
					<button type="button" onclick="increaseGuests()" class="w-8 h-8 rounded-full border-2 border-red text-red flex items-center justify-center hover:bg-red-700 hover:text-white transition-all text-lg font-bold leading-none">+</button>
					</div>
				</div>
				<div class="flex-1">
					<label class="text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide block">Meja</label>
					<select name="table_id"
						class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 bg-gray-50 focus:outline-none focus:border-red-700 focus:ring-2 focus:ring-red-200 transition-all duration-200"
					>
						<option value="">Pilih Meja</option>
						@foreach($restaurant->tables as $table)
							<option value="{{ $table->id }}">{{ $table->table_number }} (Kapasitas {{ $table->capacity }})</option>
						@endforeach
					</select>
				</div>
				</div>

				<!-- BOOKING BUTTON -->
				<button type="button" onclick="submitReservasi()" class="w-full bg-red-700 hover:bg-red-900 active:scale-[0.99] text-white font-semibold py-3.5 rounded-2xl text-sm tracking-wide shadow-lg shadow-red/30 hover:shadow-red/40 transition-all duration-200">
				Booking
				</button>
				</form>
			</div>
		</div>
	</div>

	<script>
		function showTab(tabName) {

			document.querySelectorAll('.tab-content').forEach(tab => {
				tab.classList.add('hidden');
			});

			document.querySelectorAll('.tab-btn').forEach(btn => {
				btn.classList.remove(
					'text-red-700',
					'font-semibold'
				);

				btn.classList.add(
					'text-gray-500',
					'font-medium'
				);
			});

			document.getElementById(`content-${tabName}`)
				.classList.remove('hidden');

			const activeBtn =
				document.getElementById(`tab-${tabName}`);

			activeBtn.classList.remove(
				'text-gray-500',
				'font-medium'
			);

			activeBtn.classList.add(
				'text-red-700',
				'font-semibold'
			);
		}

		const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		let today = new Date();
		let currentYear = today.getFullYear();
		let currentMonth = today.getMonth();
		let selectedDay = today.getDate();
		let guests = 2;

		function renderCalendar() {
		document.getElementById('monthLabel').textContent = MONTHS_ID[currentMonth] + ' ' + currentYear;

		const grid = document.getElementById('calendarGrid');
		grid.innerHTML = '';

		const firstDay = new Date(currentYear, currentMonth, 1).getDay();
		const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
		const prevDays = new Date(currentYear, currentMonth, 0).getDate();

		for (let i = 0; i < firstDay; i++) {
			const d = document.createElement('div');
			d.className = 'w-10 h-10 flex items-center justify-center rounded-[10px] text-[0.9rem] font-medium text-gray-300 cursor-default';
			d.textContent = prevDays - firstDay + 1 + i;
			grid.appendChild(d);
		}

		for (let d = 1; d <= daysInMonth; d++) {
			const el = document.createElement('div');
			const isSelected = (d === selectedDay && currentMonth === today.getMonth() && currentYear === today.getFullYear());
			const isToday = (d === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear());

			if (isSelected) {
			el.className = 'w-10 h-10 flex items-center justify-center rounded-[10px] text-[0.9rem] font-medium bg-red-700 text-white cursor-pointer shadow-[0_4px_12px_rgba(185,28,28,0.35)]';
			} else if (isToday) {
			el.className = 'w-10 h-10 flex items-center justify-center rounded-[10px] text-[0.9rem] font-bold text-red-700 cursor-pointer hover:bg-red-100 transition-colors';
			} else {
			el.className = 'w-10 h-10 flex items-center justify-center rounded-[10px] text-[0.9rem] font-medium text-gray-700 cursor-pointer hover:bg-red-50 hover:text-red transition-colors';
			}

			el.textContent = d;
			el.addEventListener('click', () => {
			selectedDay = d;
			renderCalendar();
			const mm = String(currentMonth + 1).padStart(2, '0');
			const dd = String(selectedDay).padStart(2, '0');
			document.getElementById('selectedDate').value = currentYear + '-' + mm + '-' + dd;
			});
			grid.appendChild(el);
		}

		const total = firstDay + daysInMonth;
		const remainder = total % 7 === 0 ? 0 : 7 - (total % 7);
		for (let i = 1; i <= remainder; i++) {
			const d = document.createElement('div');
			d.className = 'w-10 h-10 flex items-center justify-center rounded-[10px] text-[0.9rem] font-medium text-gray-300 cursor-default';
			d.textContent = i;
			grid.appendChild(d);
		}
		}

		function prevMonth() {
		if (currentMonth === 0) { currentMonth = 11; currentYear--; } else currentMonth--;
		renderCalendar();
		}
		function nextMonth() {
		if (currentMonth === 11) { currentMonth = 0; currentYear++; } else currentMonth++;
		renderCalendar();
		}
		function increaseGuests() {
		guests = Math.min(guests + 1, 20);
		document.getElementById('guestCount').textContent = guests;
		document.getElementById('guestCountInput').value = guests;
		}
		function decreaseGuests() {
		guests = Math.max(guests - 1, 1);
		document.getElementById('guestCount').textContent = guests;
		document.getElementById('guestCountInput').value = guests;
		}

		renderCalendar();

		// Set default selectedDate ke hari ini
		const todayMm = String(today.getMonth() + 1).padStart(2, '0');
		const todayDd = String(today.getDate()).padStart(2, '0');
		document.getElementById('selectedDate').value = today.getFullYear() + '-' + todayMm + '-' + todayDd;

		function submitReservasi() {
			if (!document.getElementById('selectedDate').value) {
				alert('Pilih tanggal terlebih dahulu.');
				return;
			}
			if (!document.getElementById('timeInput').value) {
				alert('Pilih waktu terlebih dahulu.');
				return;
			}
			const tableSelect = document.querySelector('select[name="table_id"]');
			if (!tableSelect.value) {
				alert('Pilih meja terlebih dahulu.');
				return;
			}
			document.getElementById('reservasiForm').submit();
		}
	</script>
</body>
</html>