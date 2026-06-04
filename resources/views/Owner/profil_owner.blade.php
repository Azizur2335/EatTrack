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
<body class="bg-red-700 min-h-screen m-0 p-0">
    <div class="flex min-h-screen">
        <x-sidebar></x-sidebar>

        <div class="px-40 pt-10 pb-14">
            <div class="px-20 py-10">

                <!-- DATA OWNER -->
                <div class="bg-white rounded-xl p-8 shadow-lg mb-8">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="unbounded text-2xl font-bold">
                            Data Owner
                        </h2>

                        <button
                            type="button"
                            id="editBtn"
                            class="px-5 py-2 bg-[#B92C10] text-white rounded-lg">
                            Edit Profil
                        </button>
                    </div>

                    <div class="flex justify-center mb-8">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200">
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">

                        <div>
                            <label class="font-semibold text-sm">Nama Lengkap</label>
                            <input
                                type="text"
                                value="{{ auth()->user()->name }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Email</label>
                            <input
                                type="email"
                                value="{{ auth()->user()->email }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Nomor HP</label>
                            <input
                                type="text"
                                value="{{ auth()->user()->phone }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

                        <div>
                            <label class="font-semibold text-sm">Password</label>
                            <input
                                type="password"
                                value="password"
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
                            class="px-6 py-3 border-2 border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Simpan Perubahan
                        </button>

                    </div>
                </div>

                <!-- DATA RESTORAN -->
                <div class="bg-white rounded-xl p-8 shadow-lg">

                    <h2 class="unbounded text-2xl font-bold mb-6">
                        Data Restoran
                    </h2>

                    @if($restaurant)

                        <div class="grid grid-cols-2 gap-5">

                            <div>
                                <label class="font-semibold text-sm">Nama Restoran</label>
                                <input
                                    type="text"
                                    value="{{ $restaurant->name }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Kategori</label>
                                <input
                                    type="text"
                                    value="{{ $restaurant->category }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Kota / Kecamatan</label>
                                <input
                                    type="text"
                                    value="{{ $restaurant->city }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Jam Buka</label>
                                <input
                                    type="text"
                                    value="{{ $restaurant->open_time }}"
                                    class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                    readonly>
                            </div>

                            <div>
                                <label class="font-semibold text-sm">Jam Tutup</label>
                                <input
                                    type="text"
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
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                rows="3"
                                readonly>{{ $restaurant->address }}</textarea>
                        </div>

                        <div class="mt-5">
                            <label class="font-semibold text-sm">
                                Deskripsi Restoran
                            </label>

                            <textarea
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
                                value="{{ $restaurant->maps_link }}"
                                class="profile-input w-full mt-2 border rounded-lg px-4 py-3 bg-gray-100"
                                readonly>
                        </div>

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

	editBtn.addEventListener('click', () => {

		inputs.forEach(input => {
			input.removeAttribute('readonly');
			input.classList.remove('bg-gray-100');
			input.classList.add('bg-white');
		});

		actionButtons.classList.remove('hidden');
		actionButtons.classList.add('flex');

		editBtn.classList.add('hidden');
	});

	cancelBtn.addEventListener('click', () => {
		location.reload();
	});
</script>