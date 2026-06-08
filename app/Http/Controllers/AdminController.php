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
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $newRestoThisMonth = Restaurant::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $newResvThisMonth  = Reservation::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Data chart 6 bulan terakhir
        $chartLabels = [];
        $chartData   = [];
        for ($i = 5; $i >= 0; $i--) {
            $chartLabels[] = now()->subMonths($i)->translatedFormat('M');
            $chartData[]   = Reservation::whereMonth('created_at', now()->subMonths($i)->month)
                                ->whereYear('created_at', now()->subMonths($i)->year)
                                ->count();
        }

        return view('Admin/beranda_admin', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations',
            'newUsersThisMonth', 'newRestoThisMonth', 'newResvThisMonth',
            'chartLabels', 'chartData'
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

        $statusMap = [
            'menunggu'     => 'pending',
            'dikonfirmasi' => 'confirmed',
            'ditolak'      => 'cancelled',
            'selesai'      => 'completed',
        ];

        $filterLabel = request('status', 'semua');
        $filterDb    = $statusMap[$filterLabel] ?? null;

        $query = Reservation::with(['customer', 'restaurant', 'table'])->latest();
        if ($filterDb) {
            $query->where('status', $filterDb);
        }

        $reservasi = $query->get();

        return view('Admin/laporan', compact(
            'totalUsers', 'totalRestaurants', 'totalReservations', 'reservasi'
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