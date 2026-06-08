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
				Kelola Pengguna
			</div>
			<div class="rounded-xl p-6 bg-white">
				<div class="flex justify-between">
					<p class="unbound text-lg font-bold">Daftar Menu</p>
					<button class="rounded-full bg-red-700 px-4 py-2 text-white">+Tambah</button>
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
                                <form action="/kelola_menu/{{ $menu->id }}" method="POST">@csrf @method('DELETE')
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
	<script>
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