<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function beranda()
    {
        $totalUsers       = User::count();
        $totalRestaurants = Restaurant::count();
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
        $users             = User::with('restaurant')->latest()->get();

        return view('Admin/kelola_user', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations', 'users'
        ));
    }

    public function laporan()
    {
        $totalUsers        = User::count();
        $totalRestaurants  = Restaurant::count();
        $totalReservations = Reservation::count();

        return view('Admin/laporan', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations'
        ));
    }

    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        abort_if($user->role === 'admin', 403);

        $user->update(['is_active' => true]);

        return redirect('/kelola_user')->with('success', 'User berhasil diaktifkan.');
    }

    public function banUser($id)
    {
        $user = User::findOrFail($id);
        abort_if($user->role === 'admin', 403);

        $user->update(['is_active' => false]);

        return redirect('/kelola_user')->with('success', 'User berhasil dinonaktifkan.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        abort_if($user->role === 'admin', 403);

        $user->delete();

        return redirect('/kelola_user')->with('success', 'User berhasil dihapus.');
    }
}