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

    public function kelolaUser()
    {
        $totalUsers        = User::count();
        $totalRestaurants  = Restaurant::count();
        $totalReservations = Reservation::count();

        return view('Admin/kelola_user', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations'
        ));
    }

    public function laporan()
    {
        $totalUsers        = User::count();
        $totalRestaurants  = Restaurant::count();
        $totalReservations = Reservation::count();

        return view('Admin/beranda_admin', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations'
        ));
    }
}
