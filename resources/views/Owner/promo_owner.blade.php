<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Promo - EatTrack</title>
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
        <div class="flex justify-between items-start mb-6">
          <div>
            <h1 class="unbound text-3xl text-white font-bold">PROMO</h1>
            <p class="text-white/80 mt-1 text-sm">Kelola tempat makan anda</p>
          </div>
          <a href="/tambah-promo"
            class="flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 transition text-gray-800 font-semibold px-5 py-2.5 rounded-xl text-sm shadow">
            + Promo
          </a>
        </div>

        <!-- STAT CARDS -->
        <div class="grid grid-cols-3 gap-4 mb-6">
          <div class="bg-white rounded-2xl p-5">
            <p class="text-xs text-gray-500 mb-1">Promo Aktif</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $promoAktifCount ?? 0 }}</h2>
          </div>
          <div class="bg-white rounded-2xl p-5">
            <p class="text-xs text-gray-500 mb-1">Total Digunakan</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalDigunakan ?? 0 }}</h2>
          </div>
          <div class="bg-white rounded-2xl p-5">
            <p class="text-xs text-gray-500 mb-1">Promo Berakhir</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $promoBerakhirCount ?? 0 }}</h2>
          </div>
        </div>

        <!-- TABS + DAFTAR PROMO -->
        <div class="bg-gray-100 rounded-3xl p-6">

          <!-- Tabs -->
          <div class="flex gap-2 mb-5">
            @php $tab = request('tab', 'semua'); @endphp
            <a href="?tab=semua"
              class="px-4 py-1.5 rounded-full text-sm font-medium transition
              {{ $tab === 'semua' ? 'bg-[#C52F0F] text-white' : 'bg-white text-gray-600 hover:bg-gray-200' }}">
              Semua ({{ $totalPromo ?? 0 }})
            </a>
            <a href="?tab=aktif"
              class="px-4 py-1.5 rounded-full text-sm font-medium transition
              {{ $tab === 'aktif' ? 'bg-[#C52F0F] text-white' : 'bg-white text-gray-600 hover:bg-gray-200' }}">
              Aktif
            </a>
            <a href="?tab=berakhir"
              class="px-4 py-1.5 rounded-full text-sm font-medium transition
              {{ $tab === 'berakhir' ? 'bg-[#C52F0F] text-white' : 'bg-white text-gray-600 hover:bg-gray-200' }}">
              Berakhir
            </a>
          </div>

          <!-- Grid Promo -->
          <div class="grid grid-cols-3 gap-4">

            @forelse($promos ?? [] as $promo)
            @php
              $isAktif = \Carbon\Carbon::parse($promo->berlaku_sampai)->isFuture();
              $persen = ($promo->kuota_total > 0)
                ? round(($promo->kuota_terpakai / $promo->kuota_total) * 100)
                : 0;
            @endphp
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

              <!-- Banner image -->
              <div class="h-36 bg-gray-200 relative overflow-hidden">
                @if($promo->banner)
                  <img src="{{ asset('storage/' . $promo->banner) }}" class="w-full h-full object-cover" alt="Banner">
                @else
                  <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                  </div>
                @endif
                <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-semibold
                  {{ $isAktif ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                  {{ $isAktif ? 'Aktif' : 'Berakhir' }}
                </span>
              </div>

              <!-- Info -->
              <div class="p-4">
                <h4 class="font-semibold text-gray-800 text-sm mb-0.5">{{ $promo->nama }}</h4>
                <p class="text-xs text-gray-400 mb-1">
                  Berlaku Sampai {{ \Carbon\Carbon::parse($promo->berlaku_sampai)->translatedFormat('j F Y') }}
                </p>
                <p class="text-xs text-gray-400 mb-3">
                  Digunakan {{ $promo->kuota_terpakai ?? 0 }} dari {{ $promo->kuota_total ?? 0 }} kuota
                </p>

                <!-- Progress bar -->
                <div class="w-full h-1.5 bg-gray-200 rounded-full mb-4">
                  <div class="h-1.5 bg-orange-500 rounded-full" style="width: {{ $persen }}%"></div>
                </div>

                <!-- Action buttons -->
                <div class="flex gap-2">
                  <a href="/promo/{{ $promo->id }}/edit"
                    class="flex-1 text-center text-xs font-semibold py-1.5 rounded-lg bg-yellow-400 text-gray-800 hover:bg-yellow-300 transition">
                    Edit
                  </a>
                  <form action="/promo/{{ $promo->id }}/nonaktif" method="POST" class="flex-1">
                    @csrf @method('PATCH')
                    <button type="submit"
                      class="w-full text-xs font-semibold py-1.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                      Nonaktifkan
                    </button>
                  </form>
                  <form action="/promo/{{ $promo->id }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                      class="text-xs font-semibold py-1.5 px-3 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                      Hapus
                    </button>
                  </form>
                </div>
              </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
              </svg>
              <p class="text-sm">Belum ada promo</p>
            </div>
            @endforelse

          </div>
        </div>

      </main>
    </div>
  </body>
</html>