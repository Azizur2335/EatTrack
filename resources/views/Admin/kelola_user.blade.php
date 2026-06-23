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
		<div class="flex-1 bg-red-700 min-h-screen p-6">
			<div class="unbound text-2xl text-white py-6">
				Kelola Pengguna
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
					<p class="unbound text-lg font-bold text-gray-800">Daftar Pengguna</p>
					<button onclick="toggleModal(true)" class="rounded-full bg-red-700 hover:bg-red-800 px-4 py-2 text-white text-sm font-semibold transition shadow-md cursor-pointer">+Tambah</button>
				</div>
				<table class="w-full text-left border-collapse mt-6">
                    <thead>
                        <tr class="table-auto bg-[#F2C4C4] text-gray-800 font-bold">
                            <th class="p-3 w-12 text-center">
                                <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </th>
                            <th class="p-3">Nama Lengkap</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Nomor Hp</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium">
                        @forelse($users as $user)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-3 text-center">
                                <input type="checkbox" class="menu-checkbox w-5 h-5 rounded border-gray-400 accent-red-700 cursor-pointer">
                            </td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->phone ?? '-' }}</td>
                            <td class="p-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'owner' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="p-3">
                                @if($user->is_active)
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Aktif</span>
                                @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-3 flex justify-center space-x-2 items-center">
                                @if($user->role !== 'admin')
                                    @if($user->is_active)
                                    <form action="/kelola_user/{{ $user->id }}/ban" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan pengguna ini?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Nonaktifkan</button>
                                    </form>
                                    @else
                                    <form action="/kelola_user/{{ $user->id }}/activate" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengaktifkan pengguna ini?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Aktifkan</button>
                                    </form>
                                    @endif

                                    <form action="/kelola_user/{{ $user->id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-2.5 py-1 rounded-lg text-xs font-semibold transition cursor-pointer">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic font-normal">Tidak ada aksi</span>
                                @endif
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

	<!-- MODAL TAMBAH USER -->
	<div id="tambahUserModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
		<div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl relative mx-4">
			<div class="flex justify-between items-center mb-6">
				<h3 class="unbound text-lg font-bold text-gray-800 font-bold">Tambah Pengguna Baru</h3>
				<button onclick="toggleModal(false)" class="text-gray-400 hover:text-gray-600 text-2xl font-bold cursor-pointer">&times;</button>
			</div>
			<form action="/kelola_user" method="POST" class="space-y-4">
				@csrf
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nama Lengkap</label>
					<input type="text" name="name" required placeholder="Contoh: Ahmad Subardjo" 
						class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
				</div>
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Email</label>
					<input type="email" name="email" required placeholder="ahmad@example.com" 
						class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
				</div>
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nomor Hp (Telepon)</label>
					<input type="text" name="phone" placeholder="08123456789" 
						class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
				</div>
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Password</label>
					<input type="password" name="password" required placeholder="Minimal 8 karakter" 
						class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
				</div>
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Role / Peran</label>
					<select name="role" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-200">
						<option value="customer">Customer (Pelanggan)</option>
						<option value="owner">Owner (Pemilik Resto)</option>
						<option value="admin">Admin (Administrator)</option>
					</select>
				</div>
				<div>
					<label class="block text-xs font-bold text-gray-600 uppercase mb-1">Status Akun</label>
					<select name="is_active" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-200">
						<option value="1">Aktif</option>
						<option value="0">Nonaktif</option>
					</select>
				</div>
				<div class="flex justify-end space-x-3 pt-4">
					<button type="button" onclick="toggleModal(false)" 
						class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition cursor-pointer">Batal</button>
					<button type="submit" 
						class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white rounded-lg text-sm font-semibold transition shadow-md cursor-pointer">Simpan</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		function toggleModal(show) {
			const modal = document.getElementById('tambahUserModal');
			if (show) {
				modal.classList.remove('hidden');
			} else {
				modal.classList.add('hidden');
			}
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