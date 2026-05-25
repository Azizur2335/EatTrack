<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

  * {
    font-family: 'Inter', sans-serif;
  }

  </style>
  <title>Eattrack</title>
  <style>
    h1, h1 span{
      font-family: "Unbounded", sans-serif;
      font-weight: 700;
    }
    .stat-num {
      display: block;
      font-family: "Unbounded", sans-serif;
      font-size: 3rem;
      font-weight: bold;
      color: #eab308;
      line-height: 1;
    }
    .stat-label {
      display: block;
      font-family: "Unbounded", sans-serif;
      font-size: 1rem;
      font-weight: bold;
      color: white;
      margin-top: 6px;
    }
  </style>
</head>
<body class="m-0 p-0">

  <!-- ══════════════ NAV ══════════════ -->
  <nav class="px-6 py-3 bg-white flex justify-between items-center border-b border-gray-200">
    <div class="flex items-center gap-2">
      <div class="text-xl font-medium">
        <span class="text-orange-700">Eat</span><span class="text-yellow-500">Track</span>
      </div>
    </div>
    <div class="flex items-center gap-4">
      <a href="/map" class="px-5 py-2 rounded-full text-gray-700 text-sm hover:bg-gray-200">Daftar</a>
      <a href="/beranda" class="text-white text-sm font-medium px-5 py-2 rounded-full bg-orange-700 hover:bg-orange-800">
        Login
      </a>
    </div>
  </nav>

  <!-- ══════════════ HOME ══════════════ -->
  <div id="page-home">

    <!-- Hero image -->
    <div class="h-80 overflow-hidden">
      <img src="img/foto_makan_bareng.jpg" alt="Foto makan bareng" class="w-full h-full object-cover"/>
    </div>

    <!-- Hero content -->
    <section class="bg-orange-700 pt-12 pb-16 px-6">
      <h1 class="text-4xl md:text-5xl text-white text-center leading-tight mb-6">
        Temukan dan Booking<br>
        <span class="text-yellow-400">Tempat Makan</span> Favoritmu
      </h1>
      <p class="text-white text-center opacity-80 mb-14">Track ribuan tempat makan terdekat dari lokasimu</p>

      <!-- Stats -->
      <div class="flex justify-between max-w-5xl mx-auto">
        <div class="text-center">
          <span class="stat-num">30K</span>
          <span class="stat-label">Pengguna</span>
        </div>
        <div class="text-center">
          <span class="stat-num">80K</span>
          <span class="stat-label">Tempat Makan</span>
        </div>
        <div class="text-center">
          <span class="stat-num">4,8</span>
          <span class="stat-label">Rating</span>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-8 flex justify-center gap-10">
      <a href="#" class="text-gray-500 text-sm hover:text-gray-700">Help</a>
      <a href="#" class="text-gray-500 text-sm hover:text-gray-700">Privasi</a>
      <a href="#" class="text-gray-500 text-sm hover:text-gray-700">Syarat</a>
      <a href="#" class="text-gray-500 text-sm hover:text-gray-700">Kontak</a>
    </footer>
  </div>

</body>
</html>