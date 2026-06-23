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
        $filterKategori = request('category');
        $filterStatus   = request('status');

        $query = \App\Models\Report::with(['customer', 'reservation', 'restaurant'])->latest();

        if ($filterKategori) $query->where('category', $filterKategori);
        if ($filterStatus)   $query->where('status', $filterStatus);

        $reports        = $query->get();
        $totalUnread    = \App\Models\Report::where('status', 'belum_dibaca')->count();
        $totalReports   = \App\Models\Report::count();

        return view('Admin/laporan', compact('reports', 'totalUnread', 'totalReports'));
    }

    public function updateStatusLaporan($id)
    {
        $report = \App\Models\Report::findOrFail($id);
        request()->validate(['status' => 'required|in:belum_dibaca,dibaca,ditindaklanjuti,ditutup']);
        $report->update([
            'status'     => request('status'),
            'admin_note' => request('admin_note'),
        ]);
        return back()->with('success', 'Status laporan diperbarui.');
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

    public function storeUser(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:15',
            'password'  => 'required|string|min:8',
            'role'      => 'required|in:customer,owner,admin',
            'is_active' => 'required|boolean',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => \Illuminate\Support\Facades\Hash::make($request->password),
            'role'      => $request->role,
            'is_active' => $request->is_active,
        ]);

        return redirect('/kelola_user')->with('success', 'User berhasil ditambahkan.');
    }
}