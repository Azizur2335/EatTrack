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
		<main class="flex-1 p-8 bg-red-700">
			<div class="unbound text-2xl text-white py-6 ">
				Kelola Menu
			</div>
			<div class="rounded-xl p-6 bg-white">
				<div class="flex justify-between">
					<p class="unbound text-lg font-bold">Daftar Menu</p>
					<button onclick="document.getElementById('modalTambahMenu').classList.remove('hidden')" class="rounded-full bg-red-700 px-4 py-2 text-white">+Tambah</button>
				</div>
				<table class="table-fixed w-full text-left border-collapse mt-6">
                    <thead>
                        <tr class="bg-[#F2C4C4] text-gray-800 font-bold">
                            <th class="p-3 w-12 text-center">
                                <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </th>
                            <th class="p-3 ">Nama Menu</th>
                            <th class="p-3 ">Harga</th>
                            <th class="p-3 ">Kategori</th>
                            <th class="p-3 ">Deskripsi</th>
                            <th cjlass="p-3 w-24 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium">
                        @forelse($menus as $menu)
                        <tr class="border-b border-transparent hover:bg-gray-300/50">
                            <td class="p-3 text-center"><input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer"></td>
                            <td class="p-3">{{ $menu->name }}</td>
                            <td class="p-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $menu->category }}</td>
                            <td class="p-3 truncate">{{ $menu->description }}</td>
                            <td class="p-3 flex justify-center space-x-3 items-center">
                                {{-- tombol edit & hapus sudah ada, sesuaikan action-nya --}}
                                <button onclick="openEditModal({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }}, '{{ $menu->category }}', '{{ addslashes($menu->description ?? '') }}')" class="text-blue-600 p-1.5 rounded hover:bg-blue-100 transition">Edit</button>
                                <form action="/kelola_menu/{{ $menu->id }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">@csrf @method('DELETE')
                                    <button type="submit" class="text-[#B82B19] p-1.5 rounded hover:bg-red-100 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center p-6 text-gray-400">Belum ada menu</td></tr>
                        @endforelse
                    </tbody>
                </table>
			</div>
		</main>
	</main>
    <!-- MODAL TAMBAH MENU -->
	<div id="modalTambahMenu" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
		<div class="bg-white rounded-2xl p-8 w-[500px] shadow-xl">
			<div class="flex justify-between items-center mb-6">
				<h2 class="unbound text-lg font-bold">Tambah Menu</h2>
				<button onclick="document.getElementById('modalTambahMenu').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
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
				<div class="mb-6">
					<label class="block text-sm font-medium text-gray-700 mb-1">Foto (Opsional)</label>
					<input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
				</div>
				<div class="flex gap-3">
					<button type="button" onclick="document.getElementById('modalTambahMenu').classList.add('hidden')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">Batal</button>
					<button type="submit" class="flex-1 py-3 rounded-xl bg-red-700 text-white font-bold text-sm hover:bg-red-800 transition">Simpan</button>
				</div>
			</form>
		</div>
	</div>
    <!-- MODAL EDIT MENU -->
	<div id="modalEditMenu" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
		<div class="bg-white rounded-2xl p-8 w-[500px] shadow-xl">
			<div class="flex justify-between items-center mb-6">
				<h2 class="unbound text-lg font-bold">Edit Menu</h2>
				<button onclick="document.getElementById('modalEditMenu').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
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
				<div class="mb-6">
					<label class="block text-sm font-medium text-gray-700 mb-1">Foto Baru (Opsional)</label>
					<input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
				</div>
				<div class="flex gap-3">
					<button type="button" onclick="document.getElementById('modalEditMenu').classList.add('hidden')" class="flex-1 py-3 rounded-xl border-2 border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">Batal</button>
					<button type="submit" class="flex-1 py-3 rounded-xl bg-red-700 text-white font-bold text-sm hover:bg-red-800 transition">Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<script>
        function openEditModal(id, name, price, category, description) {
            document.getElementById('formEditMenu').action = '/kelola_menu/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editCategory').value = category;
            document.getElementById('editDescription').value = description;
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