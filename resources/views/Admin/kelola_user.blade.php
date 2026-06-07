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
		<x-sidebar></x-sidebar>
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
                        <tr class="border-b border-transparent hover:bg-gray-300/50">
                            <td class="p-3 text-center">
                                <input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </td>
                            <td class="p-3">Muhammad Tegar Bijanta</td>
                            <td class="p-3">MightyBoy</td>
                            <td class="p-3">tegar@</td>
                            <td class="p-3">081111111</td>
                            <td class="p-3"><p class="px-2 w-fit rounded-full bg-yellow-400">customer</p></td>
                            <td class="p-3 flex justify-center space-x-3 items-center">
                                <button class="bg-[#F4D03F] p-1.5 rounded text-gray-800 hover:bg-yellow-500 transition shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <button class="text-[#B82B19] p-1.5 rounded hover:bg-red-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-transparent hover:bg-gray-300/50">
                            <td class="p-3 text-center">
                                <input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </td>
                            <td class="p-3">Gembus</td>
                            <td class="p-3">Pak Gembus</td>
                            <td class="p-3">gembus@</td>
                            <td class="p-3">08111111</td>
                            <td class="p-3"><p class="px-2 w-fit rounded-full bg-red-700 text-white">owner</p></td>
                            <td class="p-3 flex justify-center space-x-3 items-center">
                                <button class="bg-[#F4D03F] p-1.5 rounded text-gray-800 hover:bg-yellow-500 transition shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <button class="text-[#B82B19] p-1.5 rounded hover:bg-red-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
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