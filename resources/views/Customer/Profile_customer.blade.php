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
        * { font-family: 'Inter', sans-serif; }
        .unbounded { font-family: 'Unbounded', sans-serif; }
    </style>
</head>
<body class="bg-red-700 min-h-screen m-0 p-0">

    <x-navbar></x-navbar>

	<div class="px-90 pt-10 pb-14">
		<div class="rounded-xl bg-white p-8">
			<div class="unbounded font-bold text-2xl text-black mb-6">
				Profile Saya
			</div>
			<div class="flex flex-col items-center mb-8">
				<div class="w-28 h-28 rounded-full overflow-hidden bg-gray-200">
					@if(auth()->user()?->avatar)
						<img src="{{ asset('storage/' . auth()->user()->avatar) }}"
							class="w-full h-full object-cover">
					@else
                        <div class="w-full h-full bg-[#D9D9D9] flex items-center justify-center">
                            <svg class="w-9 h-9 text-[#999]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                        </div>
					@endif
				</div>

				<button
					type="button"
					id="editBtn"
					class="mt-4 px-5 py-2 bg-[#B92C10] text-white rounded-lg hover:bg-[#a1260e]">
					Edit Profil
				</button>
			</div>

			<form>

				<!-- Nama -->
				<div class="mb-5">
					<label class="block text-sm font-semibold text-gray-700 mb-2">
						Nama Lengkap
					</label>

					<input
						type="text"
						value="{{ auth()->user()->name }}"
						class="profile-input w-full border rounded-lg px-4 py-3 bg-gray-100"
						readonly>
				</div>

				<!-- Email -->
				<div class="mb-5">
					<label class="block text-sm font-semibold text-gray-700 mb-2">
						Email
					</label>

					<input
						type="email"
						value="{{ auth()->user()->email }}"
						class="profile-input w-full border rounded-lg px-4 py-3 bg-gray-100"
						readonly>
				</div>

				<!-- Nomor HP -->
				<div class="mb-5">
					<label class="block text-sm font-semibold text-gray-700 mb-2">
						Nomor HP
					</label>

					<input
						type="text"
						value="{{ auth()->user()->phone }}"
						class="profile-input w-full border rounded-lg px-4 py-3 bg-gray-100"
						readonly>
				</div>

				<!-- Password -->
				<div class="mb-8">
					<label class="block text-sm font-semibold text-gray-700 mb-2">
						Password
					</label>

					<input
						type="password"
						value="password"
						class="profile-input w-full border rounded-lg px-4 py-3 bg-gray-100"
						readonly>
				</div>

				<!-- Tombol Simpan -->
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

			</form>

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