<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Laporan - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@200..900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <style> .unbound { font-family: "Unbounded", sans-serif; } body { font-family: "Inter", sans-serif; } </style>
</head>
<body class="bg-[#C52F0F] min-h-screen">
<div class="flex min-h-screen">
    <x-sidebar_admin></x-sidebar_admin>

    <main class="flex-1 p-8">
        <!-- HEADER -->
        <div class="flex justify-between items-start mb-8">
            <div>
                <h1 class="unbound text-3xl text-white font-bold">Laporan Masuk</h1>
                <p class="text-white/80 mt-1 text-sm">{{ $totalUnread }} belum dibaca · {{ $totalReports }} total</p>
            </div>
            <!-- FILTER -->
            <div class="flex gap-3">
                <select onchange="window.location.href='?category='+this.value+'&status={{ request('status') }}'"
                    class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 focus:outline-none">
                    <option value="">Semua Kategori</option>
                    <option value="bug"        {{ request('category') == 'bug'        ? 'selected' : '' }}>Bug</option>
                    <option value="saran"      {{ request('category') == 'saran'      ? 'selected' : '' }}>Saran</option>
                    <option value="keluhan"    {{ request('category') == 'keluhan'    ? 'selected' : '' }}>Keluhan</option>
                    <option value="pertanyaan" {{ request('category') == 'pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                </select>
                <select onchange="window.location.href='?category={{ request('category') }}&status='+this.value"
                    class="bg-white px-4 py-2 rounded-lg text-sm text-gray-700 focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="belum_dibaca"    {{ request('status') == 'belum_dibaca'    ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="dibaca"          {{ request('status') == 'dibaca'          ? 'selected' : '' }}>Dibaca</option>
                    <option value="ditindaklanjuti" {{ request('status') == 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                    <option value="ditutup"         {{ request('status') == 'ditutup'         ? 'selected' : '' }}>Ditutup</option>
                </select>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">{{ session('success') }}</div>
        @endif

        <!-- LIST LAPORAN -->
        <div class="space-y-4">
            @forelse($reports as $report)
            @php
                $catColor = match($report->category) {
                    'bug'        => 'bg-red-100 text-red-600',
                    'keluhan'    => 'bg-orange-100 text-orange-600',
                    'saran'      => 'bg-blue-100 text-blue-600',
                    'pertanyaan' => 'bg-purple-100 text-purple-600',
                    default      => 'bg-gray-100 text-gray-600',
                };
                $statColor = match($report->status) {
                    'belum_dibaca'    => 'bg-gray-100 text-gray-500',
                    'dibaca'          => 'bg-blue-100 text-blue-600',
                    'ditindaklanjuti' => 'bg-yellow-100 text-yellow-600',
                    'ditutup'         => 'bg-green-100 text-green-600',
                    default           => 'bg-gray-100 text-gray-500',
                };
            @endphp
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs px-2 py-1 rounded-full font-medium {{ $catColor }}">{{ ucfirst($report->category) }}</span>
                            <span class="text-xs px-2 py-1 rounded-full font-medium {{ $statColor }}">{{ ucfirst(str_replace('_', ' ', $report->status)) }}</span>
                            <span class="text-xs text-gray-400">{{ $report->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="font-bold text-gray-800">{{ $report->title }}</h3>
                        <p class="text-sm text-gray-500 mt-1">dari <strong>{{ $report->customer->name }}</strong> · {{ $report->customer->email }}</p>
                    </div>
                    @if($report->screenshot)
                    <a href="{{ asset('storage/' . $report->screenshot) }}" target="_blank" class="text-xs text-blue-500 hover:underline">Lihat Screenshot</a>
                    @endif
                </div>
                <p class="text-sm text-gray-700 bg-gray-50 rounded-xl p-4 mb-4">{{ $report->message }}</p>
                @if($report->reservation)
                <p class="text-xs text-gray-400 mb-1">Reservasi: #{{ $report->reservation_id }} — {{ $report->reservation->restaurant->name ?? '-' }} {{ \Carbon\Carbon::parse($report->reservation->date)->format('d/m/Y') }}</p>
                @endif
                @if($report->restaurant)
                <p class="text-xs text-gray-400 mb-3">Restoran: {{ $report->restaurant->name }}</p>
                @endif

                <!-- UPDATE STATUS -->
                <form method="POST" action="/laporan_admin/{{ $report->id }}/status" class="flex gap-3 items-end">
                    @csrf @method('PATCH')
                    <div class="flex-1">
                        <label class="block text-xs text-gray-500 mb-1">Catatan Admin</label>
                        <input type="text" name="admin_note" value="{{ $report->admin_note }}" placeholder="Tulis catatan..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Status</label>
                        <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none">
                            <option value="belum_dibaca"    {{ $report->status == 'belum_dibaca'    ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="dibaca"          {{ $report->status == 'dibaca'          ? 'selected' : '' }}>Dibaca</option>
                            <option value="ditindaklanjuti" {{ $report->status == 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                            <option value="ditutup"         {{ $report->status == 'ditutup'         ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-[#C52F0F] text-white rounded-lg text-sm font-semibold hover:bg-red-800 transition">Simpan</button>
                </form>
            </div>
            @empty
            <div class="text-center py-16 text-white/60">
                <p class="text-sm">Belum ada laporan masuk.</p>
            </div>
            @endforelse
        </div>
    </main>
</div>
</body>
</html>