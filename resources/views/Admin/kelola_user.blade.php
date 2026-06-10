<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style>
		li{
			font-family: "Unbounded", sans-serif;
		}
		.unbound{
			font-family: "Unbounded", sans-serif;
		}
		body{
			font-family: "Inter", sans-serif;
		}
	</style>
	<title>Dashboard</title>
</head>
<body>
	<div class="flex min-h-screen">
		<x-sidebar_admin></x-sidebar_admin>
		<div class="bg-red-700 h-screen w-screen p-6">
			<div class="unbound text-2xl text-white py-6 ">
				Kelola Pengguna
			</div>
			<div class="rounded-xl p-6 bg-white">
				<div class="flex justify-between">
					<p class="unbound text-lg font-bold">Daftar Menu</p>
					<button class="rounded-full bg-red-700 px-4 py-2 text-white">+Tambah</button>
				</div>
				<table class="w-full text-left border-collapse mt-6">
                    <thead>
                        <tr class="table-auto bg-[#F2C4C4] text-gray-800 font-bold">
                            <th class="p-3 w-12 text-center">
                                <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </th>
                            <th class="p-3 ">Nama Lengkap</th>
                            <th class="p-3 ">Username</th>
                            <th class="p-3 ">Email</th>
                            <th class="p-3 ">Nomor Hp</th>
                            <th class="p-3 ">Role</th>
                            <th class="p-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium">
                        @forelse($users as $user)
                        <tr class="border-b border-transparent hover:bg-gray-300/50">
                            <td class="p-3 text-center"><input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer"></td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->phone ?? '-' }}</td>
                            <td class="p-3"><span class="px-2 w-fit rounded-full bg-yellow-400">{{ $user->role }}</span></td>
                            <td class="p-3 flex justify-center space-x-3 items-center">
                                <form action="/kelola_user/{{ $user->id }}" method="POST">@csrf @method('DELETE')
                                    <button type="submit" class="text-red-700 px-2 py-1 rounded text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center p-6 text-gray-400">Belum ada pengguna</td></tr>
                        @endforelse
                    </tbody>
                </table>
			</div>
		</div>
	</div>

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