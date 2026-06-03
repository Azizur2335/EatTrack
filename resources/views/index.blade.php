<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>EatTrack</title>

    <!-- TAILWIND -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- UNBOUNDED -->
    <link
      href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap"
      rel="stylesheet"
    />

    <!-- INTER -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <style>
      * {
        font-family: "Inter", sans-serif;
      }

      h1,
      h1 span {
        font-family: "Unbounded", sans-serif;
        font-weight: 700;
      }

      .stat-num {
        display: block;
        font-family: "Unbounded", sans-serif;
        font-size: 3rem;
        font-weight: bold;
        color: #facc15;
        line-height: 1;
      }

      .stat-label {
        display: block;
        font-family: "Unbounded", sans-serif;
        font-size: 1rem;
        font-weight: bold;
        color: white;
        margin-top: 8px;
      }
    </style>
  </head>

  <body class="m-0 p-0 bg-orange-700">
    <!-- NAVBAR -->
    <nav class="px-6 py-4 bg-white flex justify-between items-center">
      <!-- LOGO -->
      <div class="flex items-center">
        <img
          src="{{ asset('assets/Frame 1.png') }}"
          alt="EatTrack Logo"
          class="h-12 object-contain"
        />
      </div>

      <!-- MENU -->
      <div class="flex items-center gap-4">
        <a
          href="/register_page"
          class="px-5 py-2 rounded-full text-gray-700 text-sm hover:bg-gray-100 transition"
        >
          Daftar
        </a>

        <a
          href="/loginPage"
          class="text-white text-sm font-medium px-5 py-2 rounded-full bg-orange-700 hover:bg-orange-800 transition"
        >
          Login
        </a>
      </div>
    </nav>

    <!-- HERO IMAGE -->
    <div class="h-80 overflow-hidden">
      <img
        src="{{ asset('assets/foto_makan_bareng.jpg') }}"
        alt="Foto makan bareng"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- CONTENT -->
    <section class="bg-orange-700 pt-14 pb-20 px-6">
      <!-- TITLE -->
      <h1
        class="text-4xl md:text-5xl text-white text-center leading-tight mb-6"
      >
        Temukan dan Booking <br />
        <span class="text-yellow-400">Tempat Makan</span> Favoritmu
      </h1>

      <!-- SUBTITLE -->
      <p class="text-white text-center opacity-80 mb-16">
        Track ribuan tempat makan terdekat dari lokasimu
      </p>

      <!-- STATS -->
      <div class="flex justify-center gap-24 flex-wrap">
        <div class="text-center">
          <span class="stat-num">77K</span>
          <span class="stat-label">Pengguna</span>
        </div>

        <div class="text-center">
          <span class="stat-num">77K</span>
          <span class="stat-label">Tempat Makan</span>
        </div>

        <div class="text-center">
          <span class="stat-num">7,7</span>
          <span class="stat-label">Rating</span>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-8 flex justify-center gap-10 flex-wrap">
      <a href="/beranda" class="text-white text-sm hover:text-gray-700 transition">
        Bantuan
      </a>

      <a href="#" class="text-white text-sm hover:text-gray-700 transition">
        Tentang
      </a>

      <a href="#" class="text-white text-sm hover:text-gray-700 transition">
        Kontak
      </a>
    </footer>
  </body>
</html>
