<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function beranda()
    {
        $periode = request('periode', 'day');
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/beranda_owner', compact('restaurant', 'periode'));
    }

    public function kelolaMenu()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        $menus = $restaurant ? Menu::where('restaurant_id', $restaurant->id)->get() : collect();
        return view('Owner/kelola_menu', compact('restaurant', 'menus'));
    }

    public function konfirmasiBook()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        $reservasi = $restaurant ? Reservation::where('restaurant_id', $restaurant->id)->get() : collect();
        return view('Owner/konfirmasi_book', compact('restaurant', 'reservasi'));
    }

    public function promo()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/promo_owner', compact('restaurant'));
    }

    public function profil()
    {
        $user = auth()->user();
        return view('Owner/profil_owner', compact('user'));
    }
}
