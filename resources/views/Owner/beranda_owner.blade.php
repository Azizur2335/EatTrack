<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Owner - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

  <body class="bg-red-700 min-h-screen">
    <div class="flex min-h-screen">

      <!-- SIDEBAR -->
      <x-sidebar></x-sidebar>

      <!-- CONTENT -->
      <main class="flex-1 p-8 overflow-y-auto max-h-screen bg-red-700">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-8">
          <div>
            <h1 class="unbound text-2xl font-bold text-white">Dashboard Owner</h1>
            <p class="text-sm text-red-100 mt-1">Selamat datang kembali, <span class="font-bold underline">{{ auth()->user()->name }}</span>!</p>
          </div>

          <div class="flex items-center gap-4">
            <!-- LIVE TIME WIDGET -->
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-right">
              <p id="liveDate" class="text-[10px] font-semibold text-red-200 uppercase tracking-wider mb-0.5">...</p>
              <p id="liveTime" class="unbound text-lg font-bold text-white">...</p>
            </div>

            <!-- DROPDOWN FILTER -->
            <div class="relative">
              <select id="filterPeriode" class="appearance-none bg-white px-5 py-2.5 pr-12 rounded-2xl text-gray-700 font-semibold cursor-pointer outline-none border border-transparent hover:border-gray-200 transition">
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
        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Total Reservasi</p>
              <h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $totalReservasi ?? '0' }}</h3>
              <span class="inline-flex items-center text-[10px] font-medium text-emerald-600 mt-1">
                periode: {{ $periode }}
              </span>
            </div>
          </div>
          <div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
            <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Reservasi Dikonfirmasi</p>
              <h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $reservasiDikonfirmasi ?? '0' }}</h3>
              <span class="inline-flex items-center text-[10px] font-medium text-slate-400 mt-1">
                status: dikonfirmasi
              </span>
            </div>
          </div>
          <div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Reservasi Selesai</p>
              <h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $reservasiSelesai ?? '0' }}</h3>
              <span class="inline-flex items-center text-[10px] font-medium text-slate-400 mt-1">
                status: selesai
              </span>
            </div>
          </div>
          <div class="bg-white rounded-3xl p-6 shadow-md hover:-translate-y-0.5 transition duration-200 flex items-center gap-5">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide">Menunggu Konfirmasi</p>
              <h3 class="unbound text-2xl font-bold text-slate-800 mt-1">{{ $menungguKonfirmasi ?? '0' }}</h3>
              <span class="inline-flex items-center text-[10px] font-semibold text-amber-600 mt-1">
                status: pending
              </span>
            </div>
          </div>
        </div>

        <!-- GRID TENGAH: CHART + RESERVASI -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
          <!-- CHART -->
          <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-md flex flex-col">
            <div class="flex justify-between items-center mb-6">
              <div>
                <h3 class="unbound text-base font-bold text-slate-800">Statistik Reservasi Restoran</h3>
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

          <!-- RESERVASI TERBARU -->
          <div class="bg-white rounded-3xl p-6 shadow-md flex flex-col">
            <div class="flex justify-between items-center mb-6">
              <div>
                <h3 class="unbound text-base font-bold text-slate-800">Reservasi Terbaru</h3>
                <p class="text-xs text-slate-400 mt-0.5">Reservasi terakhir pelanggan Anda</p>
              </div>
              <a href="/konfirmasi_book" class="text-red-600 hover:text-red-800 font-semibold text-xs transition font-bold">Lihat Semua</a>
            </div>

            <div class="space-y-4 overflow-y-auto max-h-80 flex-1 pr-1">
              @forelse($reservasiTerbaru ?? [] as $item)
              <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl flex flex-col gap-2 shadow-sm hover:bg-slate-100/50 transition">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0 bg-gray-200">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                      <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                      </svg>
                    </div>
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $item->customer?->name ?? 'Pelanggan' }}</h4>
                    <p class="text-xs text-gray-500">{{ $item->tableData?->table_number ?? 'Meja' }} · {{ $item->date }}</p>
                  </div>
                  <div>
                    @php
                      $badgeStyle = match($item->status) {
                        'pending'   => 'bg-yellow-100 text-yellow-700',
                        'confirmed' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                        'completed' => 'bg-blue-100 text-blue-700',
                        default     => 'bg-gray-100 text-gray-700',
                      };
                    @endphp
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $badgeStyle }}">
                      {{ $item->status }}
                    </span>
                  </div>
                </div>
              </div>
              @empty
              <div class="text-center py-12 text-slate-400">
                <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-xs">Belum ada reservasi masuk.</p>
              </div>
              @endforelse
            </div>
          </div>
        </div>

        <!-- ROW BAWAH: PROMO -->
        <div class="bg-white rounded-3xl p-6 shadow-md mb-8">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h3 class="unbound text-base font-bold text-slate-800">Promo Aktif</h3>
              <p class="text-xs text-slate-400 mt-0.5">Daftar penawaran aktif untuk restoran Anda</p>
            </div>
            <a href="/promo_owner" class="text-red-600 hover:text-red-800 font-semibold text-xs transition font-bold">Kelola Promo</a>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($promoAktif ?? [] as $promo)
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 hover:shadow-md transition">
              <div class="flex justify-between items-start mb-3">
                <div>
                  <h4 class="font-bold text-slate-800 text-sm line-clamp-1">{{ $promo->title }}</h4>
                  <span class="inline-block mt-1 text-[10px] px-2 py-0.5 rounded bg-green-100 text-green-700 font-bold uppercase tracking-wider">Aktif</span>
                </div>
                <div class="text-right">
                  <span class="text-xs text-slate-400">Kuota Terpakai</span>
                  <p class="text-sm font-bold text-slate-700">{{ $promo->kuota_terpakai ?? 0 }} / {{ $promo->kuota_total ?? 0 }}</p>
                </div>
              </div>
              <p class="text-xs text-slate-500 mb-4 line-clamp-2">{{ $promo->description ?? '-' }}</p>
              <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-3">
                <div class="h-full bg-orange-500 rounded-full" style="width: {{ $promo->kuota_total > 0 ? min(100, round(($promo->kuota_terpakai / $promo->kuota_total) * 100)) : 0 }}%"></div>
              </div>
              <div class="flex justify-between items-center text-[10px] text-slate-400 font-semibold uppercase tracking-wider">
                <span>Diskon: {{ $promo->discount }}%</span>
                <span>Sampai: {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}</span>
              </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 text-slate-400">
              <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/>
              </svg>
              <p class="text-xs">Belum ada promo aktif.</p>
            </div>
            @endforelse
          </div>
        </div>

      </main>
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

      // Filter periode
      document.getElementById('filterPeriode').addEventListener('change', function () {
        const periode = this.value;
        window.location.href = `/dashboard_owner?periode=${periode}`;
      });

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