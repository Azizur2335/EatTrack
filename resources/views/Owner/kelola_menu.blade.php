<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<title>Dashboard</title>
	<style>
		.unbound{
			font-family: "Unbounded", sans-serif;
		}
		body{
			font-family: "Inter", sans-serif;
		}
	</style>
</head>
<body>
	<main class="flex min-h-screen">
		<x-sidebar></x-sidebar>
		<main class="flex-1 p-8 bg-red-700 min-h-screen">
			<div class="unbound text-2xl text-white py-6">
				Kelola Menu
			</div>

			@if(session('success'))
			<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 flex justify-between items-center" id="success-alert">
				<span class="text-sm font-semibold">{{ session('success') }}</span>
				<button onclick="document.getElementById('success-alert').remove()" class="text-green-700 hover:text-green-950 font-bold cursor-pointer">&times;</button>
			</div>
			@endif

			@if($errors->any())
			<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4" id="error-alert">
				<ul class="list-disc pl-5 text-sm font-semibold">
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<div class="rounded-xl p-6 bg-white shadow-xl">
				<div class="flex justify-between items-center">
					<p class="unbound text-lg font-bold text-gray-800">Daftar Menu</p>
					<button onclick="document.getElementById('modalTambahMenu').classList.remove('hidden')" class="rounded-full bg-red-700 hover:bg-red-800 px-4 py-2 text-white text-sm font-semibold transition shadow-md cursor-pointer">+Tambah</button>
				</div>
				<table class="w-full text-left border-collapse mt-6">
                    <thead>
                        <tr class="bg-[#F2C4C4] text-gray-800 font-bold">
                            <th class="p-3 w-12 text-center">
                                <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </th>
                            <th class="p-3">Nama Menu</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium">
                        @forelse($menus as $menu)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-3 text-center">
                                <input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </td>
                            <td class="p-3 font-semibold text-gray-800">{{ $menu->name }}</td>
                            <td class="p-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    {{ ucfirst($menu->category) }}
                                </span>
                            </td>
                            <td class="p-3 truncate max-w-[200px]">{{ $menu->description ?? '-' }}</td>
                            <td class="p-3">
                                @if($menu->is_available)
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Tersedia</span>
                                @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Habis</span>
                                @endif
                            </td>
                            <td class="p-3 flex justify-center space-x-2 items-center">
                                <button onclick="openEditModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }}, '{{ $menu->category }}', '{{ addslashes($menu->description ?? '') }}', {{ $menu->is_available ? 'true' : 'false' }})" class="bg-blue-600 hover:bg-blue-700 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Edit</button>

                                @if($menu->is_available)
                                <form action="/kelola_menu/{{ $menu->id }}/deactivate" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetel menu ini sebagai Habis?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Habis</button>
                                </form>
                                @else
                                <form action="/kelola_menu/{{ $menu->id }}/activate" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyetel menu ini sebagai Tersedia?')">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Tersedia</button>
                                </form>
                                @endif

                                <form action="/kelola_menu/{{ $menu->id }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center p-6 text-gray-400">Belum ada menu</td></tr>
                        @endforelse
                    </tbody>
                </table>
			</div>
		</main>
	</main>

    <!-- MODAL TAMBAH MENU -->
	<div id="modalTambahMenu" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
		<div class="bg-white rounded-2xl p-8 w-[500px] shadow-xl mx-4">
			<div class="flex justify-between items-center mb-6">
				<h2 class="unbound text-lg font-bold text-gray-800">Tambah Menu</h2>
				<button onclick="document.getElementById('modalTambahMenu').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold cursor-pointer">&times;</button>
			</div>
			<form action="/kelola_menu" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
					<input type="text" name="name" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition" placeholder="Nama menu...">
				</div>
				<div class="grid grid-cols-2 gap-4 mb-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
						<input type="number" name="price" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition" placeholder="15000">
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
						<select name="category" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition bg-white">
							<option value="">Pilih Kategori</option>
							<option value="makanan">Makanan</option>
							<option value="minuman">Minuman</option>
							<option value="dessert">Dessert</option>
							<option value="lainnya">Lainnya</option>
						</select>
					</div>
				</div>
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
					<textarea name="description" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition resize-none" placeholder="Deskripsi menu..."></textarea>
				</div>
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Status Ketersediaan</label>
					<select name="is_available" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition bg-white">
						<option value="1">Tersedia</option>
						<option value="0">Habis</option>
					</select>
				</div>
				<div class="mb-6">
					<label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
					<input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
				</div>
				<div class="flex gap-3">
					<button type="button" onclick="document.getElementById('modalTambahMenu').classList.add('hidden')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition cursor-pointer">Batal</button>
					<button type="submit" class="flex-1 py-3 rounded-xl bg-red-700 text-white font-bold text-sm hover:bg-red-800 transition cursor-pointer">Simpan</button>
				</div>
			</form>
		</div>
	</div>

    <!-- MODAL EDIT MENU -->
	<div id="modalEditMenu" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
		<div class="bg-white rounded-2xl p-8 w-[500px] shadow-xl mx-4">
			<div class="flex justify-between items-center mb-6">
				<h2 class="unbound text-lg font-bold text-gray-800">Edit Menu</h2>
				<button onclick="document.getElementById('modalEditMenu').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold cursor-pointer">&times;</button>
			</div>
			<form id="formEditMenu" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
					<input type="text" name="name" id="editName" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition">
				</div>
				<div class="grid grid-cols-2 gap-4 mb-4">
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
						<input type="number" name="price" id="editPrice" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition">
					</div>
					<div>
						<label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
						<select name="category" id="editCategory" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition bg-white">
							<option value="makanan">Makanan</option>
							<option value="minuman">Minuman</option>
							<option value="dessert">Dessert</option>
							<option value="lainnya">Lainnya</option>
						</select>
					</div>
				</div>
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
					<textarea name="description" id="editDescription" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition resize-none"></textarea>
				</div>
				<div class="mb-4">
					<label class="block text-sm font-medium text-gray-700 mb-1">Status Ketersediaan</label>
					<select name="is_available" id="editAvailable" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 transition bg-white">
						<option value="1">Tersedia</option>
						<option value="0">Habis</option>
					</select>
				</div>
				<div class="mb-6">
					<label class="block text-sm font-medium text-gray-700 mb-1">Foto Baru (Opsional)</label>
					<input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
				</div>
				<div class="flex gap-3">
					<button type="button" onclick="document.getElementById('modalEditMenu').classList.add('hidden')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition cursor-pointer">Batal</button>
					<button type="submit" class="flex-1 py-3 rounded-xl bg-red-700 text-white font-bold text-sm hover:bg-red-800 transition cursor-pointer">Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<script>
        function openEditModal(id, name, price, category, description, isAvailable) {
            document.getElementById('formEditMenu').action = '/kelola_menu/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editCategory').value = category;
            document.getElementById('editDescription').value = description;
            document.getElementById('editAvailable').value = isAvailable ? '1' : '0';
            document.getElementById('modalEditMenu').classList.remove('hidden');
        }
        const selectAllCheckbox = document.getElementById('selectAll');
        const itemCheckboxes = document.querySelectorAll('.menu-checkbox');

        // Ketika checkbox utama di-klik
        selectAllCheckbox.addEventListener('change', function() {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Opsi tambahan: Jika salah satu item dicentang lepas, matikan centang di checkbox utama
        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(itemCheckboxes).every(item => item.checked);
                selectAllCheckbox.checked = allChecked;
            });
        });
    </script>
</body>
</html>