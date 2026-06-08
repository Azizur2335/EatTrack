<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - EatTrack</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        *{
            font-family: 'Inter', sans-serif;
        }

        h1{
            font-family: 'Unbounded', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-xl bg-gray-100 px-12 py-10">

    <!-- Logo -->
    <div class="pb-4">
        <img src="{{ asset('img/logoWEB.png') }}"
             alt="EatTrack"
             class="h-12">
    </div>

    <hr class="border-gray-300 mb-8">

    <!-- Title -->
    <h1 class="text-2xl text-red-700 mb-2">
        Lupa Password
    </h1>

    <p class="text-gray-600 mb-8">
        Masukkan email akun Anda. Kami akan mengirimkan link untuk mengatur ulang password.
    </p>

    <!-- Success Message -->
    @if(session('status'))
        <div class="bg-green-50 border border-green-300 text-green-700 rounded-lg p-4 mb-6">
            {{ session('status') }}
        </div>
    @endif

    <!-- Error -->
    @error('email')
        <div class="bg-red-50 border border-red-300 text-red-600 rounded-lg p-4 mb-6">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label class="block text-sm font-bold text-gray-800 mb-2">
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            placeholder="Masukkan Email"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-sm focus:outline-none focus:border-red-400 bg-white mb-6">

        <button
            type="submit"
            class="w-full bg-red-700 hover:bg-red-900 text-white font-semibold py-3 rounded-xl transition">
            Kirim Link Reset Password
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="/login"
            class="text-red-700 font-semibold hover:underline">
            ← Kembali ke Login
        </a>
    </div>

</div>

</body>
</html>