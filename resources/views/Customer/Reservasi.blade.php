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
<body class="bg-[#B92C10] min-h-screen m-0 p-0">

    <x-navbar></x-navbar>

    {{-- Main Content --}}
    <div class="px-6 py-8 max-w-[1400px] mx-auto">

        {{-- Card Utama --}}
        <div class="bg-[#F1F1F1] rounded-[21px] px-10 py-8">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="unbounded font-bold text-[32px] text-[#B92C10] leading-tight">Reservasi Saya</h1>
                <p class="text-[#272727] text-[18px] mt-1">Pantau status reservasi yang kamu lakukan</p>
            </div>

            {{-- Divider --}}
            <div class="border-t-2 border-[#ABABAB] mb-6"></div>

            {{-- List Reservasi --}}
            <div class="flex flex-col gap-5">

                @forelse($reservations as $reservation)

                {{-- Tentukan warna status --}}
                @php
                    $statusColor = match($reservation->status) {
                        'confirmed'  => '#058C00',
                        'pending'    => '#D9911C',
                        'cancelled'  => '#B92C10',
                        default      => '#737373',
                    };
                    $statusLabel = match($reservation->status) {
                        'confirmed'  => 'Dikonfirmasi',
                        'pending'    => 'Menunggu',
                        'cancelled'  => 'Dibatalkan',
                        default      => ucfirst($reservation->status),
                    };
                    $statusIcon = match($reservation->status) {
                        'confirmed'  => '✓',
                        'pending'    => '⏳',
                        'cancelled'  => '✕',
                        default      => '',
                    };
                @endphp

                {{-- Card Reservasi --}}
                <div class="rounded-[16px] border border-[#272727] overflow-hidden">

                    {{-- Header Card (Warna Status) --}}
                    <div class="flex items-center justify-between px-6 py-4" style="background-color: {{ $statusColor }};">
                        <h2 class="unbounded font-bold text-[18px] text-white">{{ $reservation->restaurant->name ?? 'Nama Restoran' }}</h2>
                        <div class="flex items-center gap-2 bg-white/30 rounded-[9.5px] px-4 py-2">
                            <span class="font-bold text-[15px] text-white">{{ $statusLabel }}</span>
                            <span class="text-white text-[15px]">{{ $statusIcon }}</span>
                        </div>
                    </div>

                    {{-- Detail Card --}}
                    <div class="bg-[#F1F1F1] px-6 py-5">
                        <div class="grid grid-cols-4 gap-4">

                            {{-- Tanggal --}}
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1.5 text-[#737373] text-[14px]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    Tanggal
                                </div>
                                <p class="font-bold text-[20px] text-[#272727]">
                                    {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                </p>
                            </div>

                            {{-- Waktu --}}
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1.5 text-[#737373] text-[14px]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    Waktu
                                </div>
                                <p class="font-bold text-[20px] text-[#272727]">
                                    {{ \Carbon\Carbon::parse($reservation->time)->format('H.i') }} WITA
                                </p>
                            </div>

                            {{-- Tamu --}}
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-1.5 text-[#737373] text-[14px]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    Tamu
                                </div>
                                <p class="font-bold text-[20px] text-[#272727]">
                                    {{ $reservation->guest_count }} Orang
                                </p>
                            </div>

                            {{-- Meja --}}
                            <div class="flex flex-col gap-1">
                                <span class="text-[#737373] text-[14px]">Meja</span>
                                <p class="font-bold text-[20px] text-[#272727]">
                                    {{ $reservation->tableData->name ?? 'No. ' . ($reservation->table_id ?? '-') }}
                                </p>
                            </div>

                        </div>

                        {{-- Tombol Batalkan (hanya untuk pending) --}}
                        @if($reservation->status === 'pending')
                        <div class="mt-5 border-t border-[#e0e0e0] pt-4">
                            <form action="/reservasi/{{ $reservation->id }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-3 border-2 border-[#272727] rounded-[9.5px] text-[#B92C10] font-bold text-[18px] bg-transparent hover:bg-[#B92C10] hover:text-white hover:border-[#B92C10] transition-all duration-200 cursor-pointer">
                                    Batalkan Booking
                                </button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>

                @empty

                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="w-16 h-16 rounded-full bg-[#e5e5e5] flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[#aaa]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <p class="text-[#737373] text-[16px] font-medium">Belum ada reservasi</p>
                    <p class="text-[#aaa] text-[14px] mt-1">Yuk buat reservasi pertamamu!</p>
                    <a href="/katalog" class="inline-block mt-4 bg-[#B92C10] text-white px-6 py-3 rounded-[10px] font-semibold text-[14px] hover:bg-[#9a2209] transition-colors">
                        Cari Restoran
                    </a>
                </div>

                @endforelse

            </div>
        </div>
    </div>

</body>
</html>