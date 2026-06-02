<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function beranda()
    {
        $restaurants = Restaurant::where('status', 'active')->get();
        return view('Customer/Beranda_Customer', compact('restaurants'));
    }

    public function map()
    {
        $restaurants = Restaurant::where('status', 'active') -> select('id', 'name', 'address', 'latitude', 'longitude')->get();
        return view('Customer/Map', compact('restaurants'));
    }

    public function reservasi()
    {
        $reservations = Reservation::where('customer_id', auth()->id())->latest()->get();
        return view('Customer/Reservasi', compact('reservations'));
    }

    public function promo()
    {
        $reservations = Reservation::where('customer_id', auth()->id())->latest()->get();
        return view('Customer/Promo', compact('reservations'));
    }
    public function detail_resto()
    {
        $reservations = Reservation::where('customer_id', auth()->id())->latest()->get();
        return view('Customer/DetailResto', compact('reservations'));
    }
}
