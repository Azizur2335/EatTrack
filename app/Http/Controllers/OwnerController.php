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
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/beranda_owner', compact('restaurant'));
    }

    public function kelolaMenu()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->get();
        $menus = $restaurant ? Menu::where('restaurant_id', $restaurant->id)->get() : collect();
        return view('Owner/kelola_menu', compact('restaurant', 'menus'));
    }
}
