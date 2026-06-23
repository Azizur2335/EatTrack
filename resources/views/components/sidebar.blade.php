<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    li{
        font-family: "Unbounded", sans-serif;
    }
</style>
<nav class="w-sm bg-white">
    <div class="flex px-6 py-2 mt-6 mb-12">
        <div class="rounded-full overflow-hidden size-16 bg-gray-200">
            @if(auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-orange-400 to-red-500 text-white text-xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <div class="px-6 py-2">
            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
    <ul>
        <li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/dashboard_owner">Dashboard</a></li>
        <li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/kelola_menu">Kelola Menu</a></li>
        <li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/konfirmasi_book">Konfirmasi Booking</a></li>
        <li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/promo_owner">Promo</a></li>
        <li class="p-6 text-black hover:text-red-700 hover:bg-red-200 hover:font-bold text-xl"><a href="/profil_owner">Profile</a></li>
    </ul>
    <form method="POST" action="/logout" class="px-6 mt-8">
        @csrf
        <button type="submit" class="text-red-600 font-medium text-xl hover:underline hover:font-bold cursor-pointer">Log Out</button>
    </form>
</nav>