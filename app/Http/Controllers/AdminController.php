<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function beranda()
    {
        $totalUsers        = User::count();
        $totalRestaurants  = Restaurant::count();
        $totalReservations = Reservation::count();

        return view('Admin/beranda_admin', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations'
        ));
    }
}
