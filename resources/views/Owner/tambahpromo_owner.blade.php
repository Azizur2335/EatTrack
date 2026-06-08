<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Promo - EatTrack</title>
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
          <a href="/promo_owner"
            class="flex items-center gap-2 bg-red-200 hover:bg-red-300 transition text-red-700 font-semibold px-4 py-2.5 rounded-xl text-sm shadow">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Keluar Form
          </a>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-3xl p-8">
          <h2 class="unbound text-xl font-bold text-[#C52F0F] mb-6">{{ isset($promo) ? 'Edit Promo' : 'Tambah Promo' }}</h2>

          <form action="{{ isset($promo) ? '/promo_owner/'.$promo->id : '/promo_owner' }}" method="POST" enctype="multipart/form-data">
            @csrf
            @isset($promo) @method('PATCH') @endisset
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl px-4 py-3 mb-5">
                <ul class="text-sm text-red-600 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Baris 1: Nama Promo + Jenis Promo -->
            <div class="grid grid-cols-2 gap-5 mb-5">
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Nama Promo</label>
                <input
                  type="text"
                  name="title"
                  required
                  value="{{ old('title', $promo->title ?? '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition"
                  placeholder="Nama promo...">
                @error('nama')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
              {{-- <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Jenis Promo</label>
                <div class="relative">
                  <select
                    name="jenis_promo"
                    required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition bg-white appearance-none">
                    <option value="">Diskon Persentase</option>
                    <option value="diskon_persentase" {{ old('jenis_promo') == 'diskon_persentase' ? 'selected' : '' }}>Diskon Persentase</option>
                    <option value="gratis_minuman"    {{ old('jenis_promo') == 'gratis_minuman'    ? 'selected' : '' }}>Gratis Minuman</option>
                    <option value="gratis_dessert"    {{ old('jenis_promo') == 'gratis_dessert'    ? 'selected' : '' }}>Gratis Dessert</option>
                  </select>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </div>
                @error('jenis_promo')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div> --}}
            </div>

            <!-- Baris 2: Nilai Promo + Tanggal Mulai + Tanggal Selesai -->
            <div class="grid grid-cols-3 gap-5 mb-5">
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Nilai Promo</label>
                <input
                  type="text"
                  name="discount"
                  value="{{ old('discount', $promo->discount ?? '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition"
                  placeholder="Misal: 20%">
                @error('nilai_promo')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Tanggal Mulai</label>
                <input
                  type="date"
                  name="start_date"
                  required
                  value="{{ old('start_date', isset($promo) ? $promo->start_date : '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition">
                @error('berlaku_mulai')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Tanggal Selesai</label>
                <input
                  type="date"
                  name="end_date"
                  required
                  value="{{ old('end_date', isset($promo) ? $promo->end_date : '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition">
                @error('berlaku_sampai')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <!-- Baris 3: Minimal Tamu + Total Kuota -->
            <div class="grid grid-cols-2 gap-5 mb-5">
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Minimal Tamu</label>
                <input
                  type="number"
                  name="minimal_tamu"
                  min="1"
                  value="{{ old('minimal_tamu', $promo->minimal_tamu ?? '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition"
                  placeholder="Misal: 2">
                @error('minimal_tamu')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label class="block text-sm text-gray-600 font-medium mb-1.5">Total Kuota</label>
                <input
                  type="number"
                  name="kuota_total"
                  min="1"
                  value="{{ old('kuota_total', $promo->kuota_total ?? '') }}"
                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition"
                  placeholder="Misal: 100">
                @error('kuota_total')
                  <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-5">
              <label class="block text-sm text-gray-600 font-medium mb-1.5">Deskripsi</label>
              <textarea
                name="description"
                rows="4"
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-[#C52F0F]/30 focus:border-[#C52F0F] transition resize-none"
                placeholder="Deskripsi singkat promo...">>{{ old('description', $promo->description ?? '') }}</textarea></textarea>
              @error('deskripsi')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Upload Banner -->
            <div class="mb-8">
              <label class="block text-sm text-gray-600 font-medium mb-1.5">Upload Banner (Opsional)</label>
              <div class="border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">
                <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 transition text-gray-600 text-xs font-medium px-3 py-1.5 rounded-lg flex-shrink-0">
                  Pilih File
                  <input type="file" name="banner" accept="image/*" class="hidden" id="bannerInput">
                </label>
                <span id="bannerFileName" class="text-sm text-gray-400 truncate">Belum ada file dipilih</span>
              </div>
              @error('banner')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-4">
              <a href="../../promo_owner"
                class="flex-1 text-center py-3.5 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">
                Batal
              </a>
              <button
                type="submit"
                class="flex-1 py-3.5 rounded-xl bg-[#C52F0F] text-white font-bold text-sm hover:bg-red-800 transition">
                Simpan
              </button>
            </div>

          </form>
        </div>

      </main>
    </div>

    <script>
      // Tampilkan nama file yang dipilih
      document.getElementById('bannerInput').addEventListener('change', function () {
        const name = this.files[0] ? this.files[0].name : 'Belum ada file dipilih';
        document.getElementById('bannerFileName').textContent = name;
      });
    </script>

  </body>
</html>