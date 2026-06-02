<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    li{
        font-family: "Unbounded", sans-serif;
    }
</style>
<nav class="w-md bg-white">
    <div class="flex px-6 py-2 mt-6 mb-12">
        <div class="rounded-full overflow-hidden size-16">
            <img src="img/profile.jpg" alt="" class="w-full h-full object-cover">
        </div>
        <div class="px-6 py-2">
            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
    <ul>
        <li class="..."><a href="/dashboard_owner">Dashboard</a></li>
        <li class="..."><a href="/kelola_menu">Kelola Menu</a></li>
        <li class="..."><a href="/konfirmasi_book">Konfirmasi Booking</a></li>
        <li class="..."><a href="/promo_owner">Promo</a></li>
        <li class="..."><a href="/profil_owner">Profile</a></li>
    </ul>
    <form method="POST" action="/logout" class="px-6 mt-8">
        @csrf
        <button type="submit" class="text-red-600 font-medium">Log Out</button>
    </form>
</nav>