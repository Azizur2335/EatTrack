<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
		li{
			font-family: "Unbounded", sans-serif;
		}
		.unbound{
			font-family: "Unbounded", sans-serif;
		}
	</style>
  </head>

  <body class="bg-[#C52F0F] min-h-screen">
    <div class="flex min-h-screen">

      <!-- SIDEBAR -->
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
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/dashboard_owner">Dashboard</a></li>
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/kelola_user">Kelola Pengguna</a></li>
				<li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/laporan">Laporan</a></li>
			</ul>
			<form method="POST" action="/logout" class="px-6 mt-8">
				@csrf
				<button type="submit" class="text-red-600 font-medium">Log Out</button>
			</form>
		</nav>

      <!-- CONTENT -->
      <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-8">
          <div>
            <h1 class="unbound text-3xl text-white">Selamat Pagi, <span class="font-bold">Owner</span></h1>
            <p class="text-white/80 mt-1 text-sm">Kelola tempat makan anda</p>
          </div>

          <!-- FILTER -->
          <div class="relative">
            <button id="filterBtn" class="flex items-center gap-2 bg-gray-100 px-5 py-2 rounded-lg text-gray-700 font-medium cursor-pointer outline-none hover:bg-gray-200 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
              </svg>
              Filter
            </button>

            <!-- Dropdown filter -->
            <div id="filterDropdown" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg z-10 overflow-hidden">
              <a href="?status=semua" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('status','semua') == 'semua' ? 'bg-gray-100 font-semibold' : '' }}">Semua</a>
              <a href="?status=menunggu" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('status') == 'menunggu' ? 'bg-gray-100 font-semibold' : '' }}">Menunggu</a>
              <a href="?status=dikonfirmasi" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('status') == 'dikonfirmasi' ? 'bg-gray-100 font-semibold' : '' }}">Dikonfirmasi</a>
              <a href="?status=ditolak" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('status') == 'ditolak' ? 'bg-gray-100 font-semibold' : '' }}">Ditolak</a>
              <a href="?status=selesai" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('status') == 'selesai' ? 'bg-gray-100 font-semibold' : '' }}">Selesai</a>
            </div>
          </div>
        </div>

        <!-- DAFTAR BOOKING -->
        <div class="bg-gray-100 rounded-3xl p-6 space-y-4">

          @forelse($reservasi ?? [] as $item)
          <div class="bg-white rounded-2xl p-5 shadow-sm">

            <!-- Top row: nama + status -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-[#D9D9D9] flex-shrink-0">
                  @if($item->user?->avatar)
                    <img src="{{ asset('storage/' . $item->user->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                  @else
                    <div class="w-full h-full bg-[#D9D9D9] flex items-center justify-center">
                      <svg class="w-5 h-5 text-[#999]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                      </svg>
                    </div>
                  @endif
                </div>
                <div>
                  <p class="font-semibold text-gray-800">{{ $item->user?->name ?? 'Pengguna' }}</p>
                  <p class="text-xs text-gray-400">{{ $item->user?->email ?? '-' }}</p>
                </div>
              </div>
              <div class="flex items-center gap-2">
                @php
                  $statusColor = match($item->status) {
                    'menunggu'      => 'bg-yellow-100 text-yellow-600',
                    'dikonfirmasi'  => 'bg-green-100 text-green-600',
                    'ditolak'       => 'bg-red-100 text-red-500',
                    'selesai'       => 'bg-blue-100 text-blue-500',
                    default         => 'bg-gray-100 text-gray-500',
                  };
                @endphp
                <span class="{{ $statusColor }} px-3 py-1 rounded-full text-xs font-medium capitalize">
                  {{ ucfirst($item->status) }}
                </span>
                <!-- Ikon waktu -->
                <div class="w-7 h-7 rounded-full bg-orange-100 flex items-center justify-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Detail row -->
            <div class="grid grid-cols-4 gap-4 mb-5">
              <div>
                <p class="text-xs text-gray-400 flex items-center gap-1 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                  Tanggal
                </p>
                <p class="font-semibold text-sm text-gray-800">
                  {{ \Carbon\Carbon::parse($item->tanggal)->format('j/n/Y') }}
                </p>
              </div>
              <div>
                <p class="text-xs text-gray-400 flex items-center gap-1 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  Waktu
                </p>
                <p class="font-semibold text-sm text-gray-800">
                  {{ \Carbon\Carbon::parse($item->waktu)->format('H.i') }} WITA
                </p>
              </div>
              <div>
                <p class="text-xs text-gray-400 flex items-center gap-1 mb-1">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2h5"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M23 20v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                  </svg>
                  Tamu
                </p>
                <p class="font-semibold text-sm text-gray-800">{{ $item->jumlah_tamu ?? 0 }} Orang</p>
              </div>
              <div>
                <p class="text-xs text-gray-400 mb-1">Meja</p>
                <p class="font-semibold text-sm text-gray-800">
                  No. {{ $item->nomor_meja ?? '-' }} ({{ $item->tipe_meja ?? 'Outdoor' }})
                </p>
              </div>
            </div>

            <!-- Action buttons -->
            @if($item->status === 'menunggu')
            <div class="flex gap-3 justify-end">
              <form action="/konfirmasiBook/{{ $item->id }}/tolak" method="POST">
                @csrf @method('PATCH')
                <button type="submit"
                  class="px-6 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-semibold text-sm hover:bg-gray-100 transition">
                  Tolak
                </button>
              </form>
              <form action="/konfirmasiBook/{{ $item->id }}/terima" method="POST">
                @csrf @method('PATCH')
                <button type="submit"
                  class="px-6 py-2 rounded-full bg-green-500 text-white font-semibold text-sm hover:bg-green-600 transition">
                  Terima
                </button>
              </form>
            </div>
            @endif

          </div>
          @empty
          <div class="text-center py-16 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-sm">Belum ada reservasi</p>
          </div>
          @endforelse

        </div>

      </main>
    </div>

    <script>
      // Toggle filter dropdown
      const filterBtn = document.getElementById('filterBtn');
      const filterDropdown = document.getElementById('filterDropdown');
      filterBtn.addEventListener('click', () => {
        filterDropdown.classList.toggle('hidden');
      });
      document.addEventListener('click', (e) => {
        if (!filterBtn.contains(e.target) && !filterDropdown.contains(e.target)) {
          filterDropdown.classList.add('hidden');
        }
      });
    </script>
  </body>
</html>