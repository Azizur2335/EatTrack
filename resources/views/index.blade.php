```html
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>EatTrack</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- UNBOUNDED -->
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&display=swap" rel="stylesheet">

    <!-- INTER -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h1 span {
            font-family: 'Unbounded', sans-serif;
        }

        .stat-num {
            display: block;
            font-family: 'Unbounded', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            color: #facc15;
            line-height: 1;
        }

        .stat-label {
            display: block;
            font-family: 'Unbounded', sans-serif;
            font-size: 1rem;
            color: white;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">

            <img
                src="{{ asset('assets/Frame 1.png') }}"
                alt="EatTrack Logo"
                class="h-12 object-contain"
            >

            <div class="flex items-center gap-3">

                <a
                    href="/register_page"
                    class="px-5 py-2 rounded-full text-gray-700 hover:bg-gray-100 transition"
                >
                    Daftar
                </a>

                <a
                    href="/loginPage"
                    class="bg-orange-700 hover:bg-orange-800 text-white px-5 py-2 rounded-full transition"
                >
                    Login
                </a>

            </div>

        </div>
    </nav>

    <!-- HERO IMAGE -->
    <div class="h-80 overflow-hidden">
        <img
            src="{{ asset('assets/foto_makan_bareng.jpg') }}"
            alt="Foto makan bersama"
            class="w-full h-full object-cover"
        >
    </div>

    <!-- HERO CONTENT -->
    <section class="bg-orange-700 pt-16 pb-24 px-6">

        <div class="max-w-6xl mx-auto">

            <h1
                class="text-4xl md:text-6xl text-white text-center leading-tight mb-6"
            >
                Temukan dan Booking
                <br>
                <span class="text-yellow-400">
                    Tempat Makan
                </span>
                Favoritmu
            </h1>

            <p class="text-center text-white/80 text-lg mb-16">
                Track ribuan tempat makan terdekat dari lokasimu
            </p>

            <!-- STATS -->
            <div class="flex justify-center gap-20 flex-wrap">

                <div class="text-center">
                    <span class="stat-num">77K</span>
                    <span class="stat-label">Pengguna</span>
                </div>

                <div class="text-center">
                    <span class="stat-num">77K</span>
                    <span class="stat-label">Tempat Makan</span>
                </div>

                <div class="text-center">
                    <span class="stat-num">7.7</span>
                    <span class="stat-label">Rating</span>
                </div>

            </div>

        </div>

    </section>

    <!-- ABOUT -->
    <section class="py-20 px-6">

        <div class="max-w-5xl mx-auto">

            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="bg-orange-700 px-8 py-5">
                    <h2 class="text-2xl text-white">
                        Apa itu EatTrack?
                    </h2>
                </div>

                <div class="p-8">

                    <p class="text-gray-700 leading-8">

                        EatTrack merupakan sebuah sistem reservasi tempat makan
                        berbasis web yang berfokus untuk memberikan informasi
                        tempat makan terdekat di lokasi pengguna.

                        <br><br>

                        Informasi yang diberikan meliputi jam operasional,
                        foto restoran, daftar menu, kapasitas tempat,
                        lokasi restoran, hingga berbagai informasi penting
                        lainnya yang membantu pengguna menentukan pilihan.

                        <br><br>

                        Tidak hanya memberikan informasi, EatTrack juga
                        memungkinkan pengguna melakukan reservasi tempat makan
                        secara online dengan cepat dan mudah.

                        <br><br>

                        Dengan adanya EatTrack, pengguna dapat menemukan
                        restoran favorit, melakukan pemesanan tempat,
                        dan merencanakan kunjungan dengan lebih praktis,
                        nyaman, dan efisien.

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200">

        <div
            class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between gap-4"
        >

            <img
                src="{{ asset('assets/Frame 1.png') }}"
                alt="EatTrack"
                class="h-10"
            >

            <div class="flex gap-8">

                <a
                    href="/about"
                    class="text-gray-600 hover:text-orange-700 transition"
                >
                    About
                </a>

                <a
                    href="/kontak"
                    class="text-gray-600 hover:text-orange-700 transition"
                >
                    Contact
                </a>

            </div>

            <p class="text-sm text-gray-500 text-center">
                © 2026 EatTrack. All Rights Reserved.
            </p>

        </div>

    </footer>

</body>
</html>
```
