<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Owner - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
      body { font-family: "Inter", sans-serif; }
      .unbound { font-family: "Unbounded", sans-serif; }
    </style>
  </head>

  <body class="bg-[#C52F0F] min-h-screen">
    <div class="flex min-h-screen">

      <!-- SIDEBAR -->
      <x-sidebar></x-sidebar>

      <!-- CONTENT -->
      <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-8">
          <div>
            <h1 class="title-font text-4xl text-white">Selamat Datang, Owner</h1>
            <p class="text-white/80 mt-2">Kelola tempat makan anda</p>
          </div>

          <!-- DROPDOWN FILTER -->
          <div class="relative">
            <select id="filterPeriode" class="appearance-none bg-gray-100 px-6 py-2 pr-12 rounded-lg text-gray-700 font-medium cursor-pointer outline-none">
                <option value="day"   {{ $periode == 'day'   ? 'selected' : '' }}>Hari Ini</option>
                <option value="week"  {{ $periode == 'week'  ? 'selected' : '' }}>Minggu Ini</option>
                <option value="month" {{ $periode == 'month' ? 'selected' : '' }}>Bulan Ini</option>
            </select>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500"
              fill="none" viewBox="0 0 24 24" stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-4 gap-4 mb-6">
          <div class="bg-white rounded-3xl p-5">
            <p class="text-sm text-gray-500">Total Reservasi</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalReservasi ?? '0' }}</h2>
            <p class="text-xs text-gray-400 mt-2">periode: {{ $periode }}</p>
          </div>
          <div class="bg-white rounded-3xl p-5">
            <p class="text-sm text-gray-500">Reservasi Dikonfirmasi</p>
            <h2 class="text-3xl font-bold mt-2">{{ $reservasiDikonfirmasi ?? '0' }}</h2>
            <p class="text-xs text-gray-400 mt-2">dikonfirmasi</p>
          </div>
          <div class="bg-white rounded-3xl p-5">
            <p class="text-sm text-gray-500">Reservasi Selesai</p>
            <h2 class="text-3xl font-bold mt-2">{{ $reservasiSelesai ?? '0' }}</h2>
            <p class="text-xs text-gray-400 mt-2">selesai</p>
          </div>
          <div class="bg-white rounded-3xl p-5">
            <p class="text-sm text-gray-500">Menunggu Konfirmasi</p>
            <h2 class="text-3xl font-bold mt-2">{{ $menungguKonfirmasi ?? '0' }}</h2>
            <p class="text-xs text-green-600 mt-2">+50 pengguna minggu ini</p>
          </div>
        </div>

        <!-- KONTEN BAWAH -->
        <div class="grid grid-cols-2 gap-6">

          <!-- RESERVASI TERBARU -->
          <div class="bg-gray-200 rounded-3xl p-5 min-h-[500px]">
            <h3 class="font-medium text-gray-600 mb-4">Reservasi Terbaru</h3>

            @forelse($reservasiTerbaru ?? [] as $item)
            <div class="bg-white rounded-2xl p-3 flex items-center justify-between mb-3">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0 bg-[#D9D9D9]">
                  @if($item->user?->avatar)
                    <img src="{{ asset('storage/' . $item->user->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                  @else
                    <div class="w-full h-full bg-[#D9D9D9] flex items-center justify-center">
                      <svg class="w-6 h-6 text-[#999]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                      </svg>
                    </div>
                  @endif
                </div>
                <div>
                  <h4 class="font-medium">{{ $item->user?->name ?? 'Pengguna' }}</h4>
                  <p class="text-sm text-gray-500">{{ $item->jumlah_meja }} Meja</p>
                </div>
              </div>
              <div class="flex items-center gap-4">
                <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                  {{ ucfirst($item->status) }}
                </span>
                <a href="/konfirmasiBook/{{ $item->id }}" class="font-semibold text-sm">Lihat</a>
              </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center mt-10">Belum ada reservasi</p>
            @endforelse
          </div>

          <!-- PROMO -->
          <div class="bg-gray-200 rounded-3xl p-5 min-h-[500px]">
            <h3 class="font-medium text-gray-600 mb-4">Promo Aktif</h3>

            @forelse($promoAktif ?? [] as $promo)
            <div class="bg-white rounded-2xl p-4 mb-3">
              <div class="flex justify-between">
                <h4 class="font-medium">{{ $promo->nama }}</h4>
                <a href="/promo/{{ $promo->id }}" class="font-semibold text-sm">Detail</a>
              </div>
              <p class="text-xs text-gray-500 mt-1">
                Berlaku sampai {{ \Carbon\Carbon::parse($promo->berlaku_sampai)->translatedFormat('j F Y') }}
              </p>
              <div class="w-full h-2 bg-gray-200 rounded-full mt-4">
                <div
                  class="h-2 bg-orange-500 rounded-full"
                  style="width: {{ $promo->kuota_terpakai && $promo->kuota_total ? round(($promo->kuota_terpakai / $promo->kuota_total) * 100) : 0 }}%"
                ></div>
              </div>
              <p class="text-xs text-gray-500 mt-2">
                {{ $promo->kuota_terpakai ?? 0 }} dari {{ $promo->kuota_total ?? 0 }} kuota
              </p>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center mt-10">Belum ada promo aktif</p>
            @endforelse
          </div>

        </div>
      </main>
    </div>

    <script>
      document.getElementById('filterPeriode').addEventListener('change', function () {
        const periode = this.value;
        window.location.href = `/dashboard_owner?periode=${periode}`;
      });
    </script>
  </body>
</html>