<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - EatTrack</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> * { font-family: 'Inter', sans-serif; } .unbounded { font-family: 'Unbounded', sans-serif; } </style>
</head>
<body class="bg-[#B92C10] min-h-screen">
    <x-navbar></x-navbar>

    <div class="max-w-[1000px] mx-auto px-6 py-8">

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">{{ session('success') }}</div>
        @endif

        <!-- FORM KIRIM LAPORAN -->
        <div class="bg-white rounded-3xl p-8 mb-8">
            <h1 class="unbounded text-2xl font-bold text-[#B92C10] mb-6">Kirim Laporan</h1>
            <form method="POST" action="/laporan" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700">
                            <option value="">Pilih Kategori</option>
                            <option value="bug">Bug</option>
                            <option value="saran">Saran</option>
                            <option value="keluhan">Keluhan</option>
                            <option value="pertanyaan">Pertanyaan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" required placeholder="Judul laporan..." class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700">
                    </div>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan</label>
                    <textarea name="message" required rows="4" placeholder="Jelaskan laporanmu..." class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700 resize-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Terkait Reservasi (Opsional)</label>
                        <select name="reservation_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700">
                            <option value="">Tidak ada</option>
                            @foreach($reservations as $r)
                            <option value="{{ $r->id }}">{{ $r->restaurant->name ?? '-' }} — {{ \Carbon\Carbon::parse($r->date)->format('d/m/Y') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Terkait Restoran (Opsional)</label>
                        <select name="restaurant_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-red-700">
                            <option value="">Tidak ada</option>
                            @foreach($restaurants as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Screenshot (Opsional)</label>
                    <input type="file" name="screenshot" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
                <button type="submit" class="w-full py-3.5 rounded-xl bg-[#B92C10] text-white font-bold text-sm hover:bg-red-800 transition">Kirim Laporan</button>
            </form>
        </div>

        <!-- RIWAYAT LAPORAN SAYA -->
        <div class="bg-white rounded-3xl p-8">
            <h2 class="unbounded text-lg font-bold text-[#B92C10] mb-6">Riwayat Laporan Saya</h2>
            @forelse($myReports as $report)
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
            <div class="border border-gray-100 rounded-2xl p-5 mb-4 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <span class="text-xs px-2 py-1 rounded-full font-medium {{ $catColor }}">{{ ucfirst($report->category) }}</span>
                        <span class="text-xs px-2 py-1 rounded-full font-medium {{ $statColor }}">{{ ucfirst(str_replace('_', ' ', $report->status)) }}</span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $report->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">{{ $report->title }}</h3>
                <p class="text-sm text-gray-500">{{ $report->message }}</p>
                @if($report->admin_note)
                <div class="mt-3 bg-blue-50 border border-blue-100 rounded-xl p-3 text-sm text-blue-700">
                    <strong>Catatan Admin:</strong> {{ $report->admin_note }}
                </div>
                @endif
            </div>
            @empty
            <p class="text-center text-gray-400 text-sm py-8">Belum ada laporan yang dikirim.</p>
            @endforelse
        </div>

    </div>
</body>
</html>