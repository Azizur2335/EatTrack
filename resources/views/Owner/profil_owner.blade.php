<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .unbounded { font-family: 'Unbounded', sans-serif; }
    </style>
</head>
<body class="bg-orange-700 min-h-screen m-0 p-0">
    <div class="flex min-h-screen">
        <x-sidebar></x-sidebar>

        <div class="px-40 pt-10 pb-14">
            <div class="px-20 py-10">

                <!-- DATA OWNER -->
                <form action="/profil_owner/user" method="POST" enctype="multipart/form-data" id="ownerForm">
                    @csrf
                <div class="bg-white rounded-xl p-8 shadow-lg mb-8">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="unbounded text-2xl font-bold">
                            Data Owner
                        </h2>

                        <button
                            type="button"
                            id="editBtn"
                            class="px-5 py-2 bg-[#B92C10] text-white rounded-lg hover:bg-red-800 transition">
                            Edit Profil
                        </button>
                    </div>

                    @if(session('success_user'))
                        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg text-sm">
                            {{ session('success_user') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg text-sm">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="flex flex-col items-center mb-8">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 border-4 border-gray-100 shadow">
                                @if($user->avatar)
                                    <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img id="avatarPreview" src="" class="w-full h-full object-cover hidden">
                                    <div id="avatarPlaceholder" class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-400 to-red-500 text-white text-4xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <label id="avatarLabel" class="hidden absolute inset-0 rounded-full bg-black/40 flex items-center justify-center cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
                            </label>
                        </div>
                        <p id="avatarHint" class="hidden text-xs text-gray-500 mt-2">Klik foto untuk mengganti (maks 2MB)</p>
                    </div>

                    <div class="grid grid-cols-2 gap-5">

                        <div>
                            <label class="font-semibold text-sm">Nama Lengkap</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ $user->name }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Email</label>
                            <input
                                type="email"
                                value="{{ $user->email }}"
                                class="w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100 text-gray-500 cursor-not-allowed"
                                readonly disabled>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Nomor HP</label>
                            <input
                                type="text"
                                name="phone"
                                value="{{ $user->phone }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Password Baru</label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Kosongkan jika tidak ingin ganti"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                    </div>
                    <div
                        id="actionButtons"
                        class="hidden justify-end gap-3 mt-8">

                        <button
                            type="button"
                            id="cancelBtn"
                            class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Simpan Perubahan
                        </button>

                    </div>
                </div>
                </form>

                <!-- DATA RESTORAN -->
                <div class="bg-white rounded-xl p-8 shadow-lg">

                    <h2 class="unbounded text-2xl font-bold mb-6">
                        Data Restoran
                    </h2>

                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($restaurant)
                    <form action="/profil_owner" method="POST" enctype="multipart/form-data" id="restoForm">
                        @csrf

                        <div class="grid grid-cols-2 gap-5">

                            <div>
                                <label class="font-semibold text-sm">Nama Restoran</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ $restaurant->name }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Kategori</label>
                                <input
                                    type="text"
                                    name="category"
                                    value="{{ $restaurant->category }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Kota / Kecamatan</label>
                                <input
                                    type="text"
                                    name="city"
                                    value="{{ $restaurant->city }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Jam Buka</label>
                                <input
                                    type="time"
                                    name="open_time"
                                    value="{{ $restaurant->open_time }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Jam Tutup</label>
                                <input
                                    type="time"
                                    name="close_time"
                                    value="{{ $restaurant->close_time }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                        </div>

                        <div class="mt-5">
                            <label class="font-semibold text-sm">
                                Alamat Restoran
                            </label>

                            <textarea
                                name="address"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                rows="3"
                                readonly>{{ $restaurant->address }}</textarea>
                        </div>

                        <div class="mt-5">
                            <label class="font-semibold text-sm">
                                Deskripsi Restoran
                            </label>

                            <textarea
                                name="description"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                rows="4"
                                readonly>{{ $restaurant->description }}</textarea>
                        </div>

                        <div class="mt-5">
                            <label class="font-semibold text-sm">
                                Link Google Maps
                            </label>
                            <input
                                type="text"
                                name="maps_link"
                                value="{{ $restaurant->maps_link }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                            @if($restaurant->latitude && $restaurant->longitude)
                                <p class="text-xs text-green-600 mt-1">✓ Koordinat tersimpan: {{ $restaurant->latitude }}, {{ $restaurant->longitude }}</p>
                            @else
                                <p class="text-xs text-red-400 mt-1">⚠ Koordinat belum tersimpan. Klik Edit Profil lalu Simpan untuk mengisi otomatis dari link maps.</p>
                            @endif
                        </div>

                        <div class="flex justify-end gap-3 mt-6 resto-action-buttons hidden">
                            <button type="button" id="cancelRestoBtn"
                                class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                    @else

                        <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-6">

                            <div class="flex items-center gap-3 mb-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z"
                                        clip-rule="evenodd" />
                                </svg>

                                <h3 class="font-bold text-yellow-700">
                                    Restoran Belum Terdaftar
                                </h3>
                            </div>

                            <p class="text-gray-600 text-sm">
                                Akun owner ini belum memiliki data restoran.
                                Silakan tambahkan data restoran terlebih dahulu.
                            </p>

                            <a href="/register-owner"
                                class="inline-block mt-4 px-5 py-3 bg-[#B92C10] text-white rounded-lg hover:bg-red-800">
                                Tambah Restoran
                            </a>

                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

</body>
</html>

<script>
    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const inputs = document.querySelectorAll('.profile-input');
    const actionButtons = document.getElementById('actionButtons');
    const avatarLabel = document.getElementById('avatarLabel');
    const avatarHint = document.getElementById('avatarHint');
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarPlaceholder = document.getElementById('avatarPlaceholder');

    editBtn.addEventListener('click', () => {
        inputs.forEach(input => {
            input.removeAttribute('readonly');
            input.classList.remove('bg-gray-100');
            input.classList.add('bg-white');
        });

        actionButtons.classList.remove('hidden');
        actionButtons.classList.add('flex');

        // Tampilkan avatar upload overlay & hint
        if (avatarLabel) {
            avatarLabel.classList.remove('hidden');
            avatarLabel.classList.add('flex');
        }
        if (avatarHint) avatarHint.classList.remove('hidden');

        // Aktifkan juga form restoran
        document.querySelectorAll('.resto-action-buttons').forEach(el => {
            el.classList.remove('hidden');
        });

        editBtn.classList.add('hidden');
    });

    // Avatar preview on file select
    if (avatarInput) {
        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    avatarPreview.src = ev.target.result;
                    avatarPreview.classList.remove('hidden');
                    if (avatarPlaceholder) avatarPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    cancelBtn.addEventListener('click', () => {
        location.reload();
    });

    const cancelRestoBtn = document.getElementById('cancelRestoBtn');
    if (cancelRestoBtn) {
        cancelRestoBtn.addEventListener('click', () => {
            location.reload();
        });
    }
</script>