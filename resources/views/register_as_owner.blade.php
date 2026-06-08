<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Owner EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        h1 { font-family: 'Unbounded', sans-serif; }

        #circle1-check {
            display: none;
            animation: popIn 0.3s ease;
        }
        @keyframes popIn {
            0%   { transform: scale(0.5); opacity: 0; }
            70%  { transform: scale(1.15); }
            100% { transform: scale(1); opacity: 1; }
        }
        .input-error {
            border-color: #dc2626 !important;
            background-color: #fff5f5 !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full md:w-1/2 bg-gray-100 flex flex-col px-12 py-10">

    {{-- Logo --}}
    <div class="pb-4">
        <img src="{{ asset('img/logoWEB.png') }}" alt="EatTrack" class="h-12">
    </div>

    <hr class="border-gray-300 mb-8">

    <div class="text-2xl text-red-700 mb-4">
        <h1>Registrasi Owner</h1>
    </div>

    {{-- Step Indicator --}}
    <div class="flex items-center justify-center mb-6">
        <div class="flex items-center m-4">
            <div id="circle1" class="flex items-center justify-center w-8 h-8 rounded-full bg-red-700 text-white text-sm font-bold">
                <span id="circle1-number">1</span>
                <span id="circle1-check"><i class="fa-solid fa-check text-xs"></i></span>
            </div>
            <span id="label1" class="pl-4 font-bold text-red-700">Data Owner</span>
        </div>
        <div class="w-10 h-0.5 bg-gray-300"></div>
        <div class="flex items-center m-4">
            <div id="circle2" class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-300 text-white text-sm font-bold">2</div>
            <span id="label2" class="pl-4 text-gray-400">Data Restoran</span>
        </div>
    </div>

    {{-- Server-side errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 rounded-lg px-4 py-3 mb-4">
            @foreach ($errors->all() as $error)
                <p class="text-red-600 text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- JS error box --}}
    <div id="js-error-box" class="hidden bg-red-50 border border-red-300 rounded-lg px-4 py-3 mb-4">
        <p id="js-error-msg" class="text-red-600 text-sm"></p>
    </div>

    <form action="/register-owner" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ===== STEP 1: DATA OWNER ===== --}}
        <div id="step1">
            <label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap"
                oninput="checkStep1()"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <label class="block text-sm font-bold text-gray-800 mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email"
                oninput="checkStep1()"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <label class="block text-sm font-bold text-gray-800 mb-2">Nomor HP</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Masukkan Nomor HP"
                oninput="checkStep1()"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
            <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                oninput="checkPasswordMatch(); checkStep1()"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-1">
            <p id="pw-length-hint" class="text-xs text-gray-400 mb-3">Minimal 8 karakter</p>

            <label class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password"
                oninput="checkPasswordMatch(); checkStep1()"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-1">
            <p id="pw-match-hint" class="text-xs text-gray-400 mb-3">Ulangi password yang sama</p>

            <div class="flex justify-between mt-4">
                <a href="/register_page" class="font-semibold text-sm text-gray-700">&lt; Kembali</a>
                <button type="button" id="btn-next" onclick="nextStep()" disabled
                    class="bg-red-700 text-white font-semibold text-sm px-8 py-3 rounded-xl transition-colors opacity-50 cursor-not-allowed">
                    Lanjutkan
                </button>
            </div>
        </div>

        {{-- ===== STEP 2: DATA RESTORAN ===== --}}
        <div id="step2" class="hidden">

            <label class="block text-sm font-bold text-gray-800 mb-2">Nama Restoran</label>
            <input type="text" name="restaurant_name" value="{{ old('restaurant_name') }}" required placeholder="Masukkan Nama Restoran"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <label class="block text-sm font-bold text-gray-800 mb-2">Kota / Kecamatan</label>
            <input type="text" name="city" value="{{ old('city') }}" placeholder="Contoh: Mataram"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <label class="block text-sm font-bold text-gray-800 mb-2">Alamat Restoran</label>
            <textarea name="address" required placeholder="Masukkan alamat lengkap restoran"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">{{ old('address') }}</textarea>

            <label class="block text-sm font-bold text-gray-800 mb-2">Link Google Maps (Opsional)</label>
            <input type="url" name="maps_link" value="{{ old('maps_link') }}" placeholder="https://maps.google.com/..."
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-800 mb-2">Jam Buka</label>
                    <input type="time" name="open_time"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-800 mb-2">Jam Tutup</label>
                    <input type="time" name="close_time"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-800 mb-2">Kategori Restoran</label>
                    <select name="category"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">
                        <option value="cafe">Cafe</option>
                        <option value="restoran">Restoran</option>
                        <option value="warung">Warung</option>
                        <option value="fastfood">Fast Food</option>
                        <option value="steakhouse">Steakhouse</option>
                        <option value="seafood">Seafood</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-bold text-gray-800 mb-2">Jumlah Meja</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Contoh: 10" min="1"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">
                </div>
            </div>

            <label class="block text-sm font-bold text-gray-800 mb-2">Deskripsi Restoran</label>
            <textarea name="description" placeholder="Ceritakan sedikit tentang restoran kamu"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 focus:outline-none focus:border-red-400 bg-white mb-4">{{ old('description') }}</textarea>

            <label class="block text-sm font-bold text-gray-800 mb-2">Foto Restoran / Logo</label>
            <input type="file" name="image" accept="image/*"
                class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-500 bg-white mb-4">

            <div class="flex justify-between mt-4">
                <button type="button" onclick="prevStep()"
                    class="text-sm border-2 border-gray-300 rounded-xl font-semibold px-8 py-3 hover:border-red-700 hover:text-red-700 cursor-pointer transition-colors">
                    Kembali
                </button>
                <button type="submit"
                    class="text-sm bg-red-700 hover:bg-red-900 text-white font-semibold px-8 py-3 rounded-xl cursor-pointer transition-colors">
                    Daftar Sebagai Owner
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    function checkPasswordMatch() {
        const pw    = document.getElementById('password');
        const cpw   = document.getElementById('password_confirmation');
        const hint  = document.getElementById('pw-match-hint');
        const lHint = document.getElementById('pw-length-hint');

        // Panjang password
        if (pw.value.length > 0 && pw.value.length < 8) {
            lHint.textContent = '⚠ Password minimal 8 karakter';
            lHint.className = 'text-xs text-red-500 mb-3';
        } else if (pw.value.length >= 8) {
            lHint.textContent = '✓ Panjang password oke';
            lHint.className = 'text-xs text-green-600 mb-3';
        } else {
            lHint.textContent = 'Minimal 8 karakter';
            lHint.className = 'text-xs text-gray-400 mb-3';
        }

        // Kecocokan password
        if (cpw.value.length === 0) {
            hint.textContent = 'Ulangi password yang sama';
            hint.className = 'text-xs text-gray-400 mb-3';
            pw.classList.remove('input-error');
            cpw.classList.remove('input-error');
        } else if (pw.value === cpw.value) {
            hint.textContent = '✓ Password cocok';
            hint.className = 'text-xs text-green-600 mb-3';
            pw.classList.remove('input-error');
            cpw.classList.remove('input-error');
        } else {
            hint.textContent = '✗ Password tidak sama';
            hint.className = 'text-xs text-red-500 mb-3';
            pw.classList.add('input-error');
            cpw.classList.add('input-error');
        }
    }

    function checkStep1() {
        const name  = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const pw    = document.getElementById('password').value;
        const cpw   = document.getElementById('password_confirmation').value;

        const valid = name && email && phone && pw.length >= 8 && pw === cpw;
        const btn   = document.getElementById('btn-next');

        if (valid) {
            btn.disabled = false;
            btn.className = 'bg-red-700 hover:bg-red-900 text-white font-semibold text-sm px-8 py-3 rounded-xl cursor-pointer transition-colors';
        } else {
            btn.disabled = true;
            btn.className = 'bg-red-700 text-white font-semibold text-sm px-8 py-3 rounded-xl opacity-50 cursor-not-allowed transition-colors';
        }
    }

    function nextStep() {
        // Tampilkan centang di circle 1
        document.getElementById('circle1-number').style.display = 'none';
        document.getElementById('circle1-check').style.display  = 'flex';

        // Aktifkan step 2
        document.getElementById('circle2').classList.remove('bg-gray-300');
        document.getElementById('circle2').classList.add('bg-red-700');
        document.getElementById('label2').classList.remove('text-gray-400');
        document.getElementById('label2').classList.add('font-bold', 'text-red-700');

        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.remove('hidden');
    }

    function prevStep() {
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step1').classList.remove('hidden');

        document.getElementById('circle2').classList.add('bg-gray-300');
        document.getElementById('circle2').classList.remove('bg-red-700');
        document.getElementById('label2').classList.add('text-gray-400');
        document.getElementById('label2').classList.remove('font-bold', 'text-red-700');
    }

    // Inisialisasi saat halaman load
    checkStep1();
</script>

</body>
</html>