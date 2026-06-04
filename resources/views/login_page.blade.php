<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Login - EatTrack</title>
  <style>
    * { font-family: 'Inter', sans-serif; }
    h1 { font-family: 'Unbounded', sans-serif; }
  </style>
</head>
<body class="m-0 p-0 bg-gray-100">

  <div class="flex min-h-screen">

    <!-- ══ Kiri: Form ══ -->
    <div class="w-full md:w-1/2 bg-gray-100 flex flex-col px-12 py-10">

      <!-- Logo -->
      <div class="pb-4">
				<img src="img/frame 1.png" alt="" class="w-50">
			</div>

      <!-- Divider -->
      <hr class="border-gray-300 mb-8">

      <!-- Judul -->
      <h1 class="text-3xl font-bold text-orange-700 mb-2">Login</h1>
      <p class="text-gray-500 text-sm mb-6">Masuk ke akun EatTrack anda</p>

      <!-- Form -->
      <form action="/login" method="POST" class="flex flex-col gap-5">
        @csrf   {{-- ← tambahkan ini --}}
    
        <!-- tampilkan error kalau login gagal -->
        @if ($errors->any())
            <div class="text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <!-- Username -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Username atau Email</label>
          <input
            type="text"
            name="username"
            placeholder="Masukkan Username atau Email anda"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white"
          >
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Masukkan Password anda"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-orange-400 bg-white"
          >
          <!-- Lupa Password -->
          <div class="text-right mt-2">
            <a href="/forgot-password" class="text-sm text-gray-500 hover:text-orange-700">Lupa Password?</a>
          </div>
        </div>

        <!-- Tombol Login -->
        <button
          type="submit"
          class="w-full py-3 rounded-lg bg-red-700 hover:bg-red-800 text-white font-bold text-base transition-colors"
        >
          Login
        </button>

        <!-- Atau -->
        <div class="flex items-center gap-3 my-1">
          <hr class="flex-1 border-gray-300">
          <span class="text-sm text-gray-400">Atau</span>
          <hr class="flex-1 border-gray-300">
        </div>

        <!-- Google -->
        <a href="/auth/google" class="w-full py-3 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center gap-3 text-sm font-medium text-gray-700 transition-colors">
            <img src="img/google.png" alt="" class="h-5 w-5"> Lanjutkan dengan Google
        </a>

        <!-- Daftar -->
        <p class="text-center text-sm text-gray-700 mt-1">
          Belum punya akun?
          <a href="/register_page" class="text-orange-700 font-medium hover:underline">Daftar Sekarang</a>
        </p>

      </form>
      <a href="/">kembali</a>
    </div>

    <!-- ══ Kanan: Foto ══ -->
    <div class="hidden md:block w-1/2">
      <img
        src="/assets/foto_makan_bareng.jpg"
        alt="Restoran"
        class="w-full h-full object-cover"
        onerror="this.parentElement.style.background='#c0391b'"
      >
    </div>

  </div>

</body>
</html>