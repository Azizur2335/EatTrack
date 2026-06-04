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

        $query = $restaurant
            ? Reservation::where('restaurant_id', $restaurant->id)
            : Reservation::whereNull('id'); // query kosong jika belum punya restoran

        // Filter berdasarkan periode
        $query = match($periode) {
            'week'  => $query->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]),
            'month' => $query->whereMonth('date', now()->month)->whereYear('date', now()->year),
            default => $query->whereDate('date', today()), // 'day'
        };

        $totalReservasi        = (clone $query)->count();
        $reservasiDikonfirmasi = (clone $query)->where('status', 'confirmed')->count();
        $reservasiPending      = (clone $query)->where('status', 'pending')->count();
        $reservasiDibatalkan   = (clone $query)->where('status', 'cancelled')->count();

        return view('Owner/beranda_owner', compact(
            'restaurant', 'periode',
            'totalReservasi', 'reservasiDikonfirmasi',
            'reservasiPending', 'reservasiDibatalkan'
        ));
    }

    public function kelolaMenu()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        $menus = $restaurant ? Menu::where('restaurant_id', $restaurant->id)->get() : collect();
        return view('Owner/kelola_menu', compact('restaurant', 'menus'));
    }

    public function promo()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/promo_owner', compact('restaurant'));
    }
    public function tambah_promo()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/tambahpromo_owner', compact('restaurant'));
    }

    public function profil()
    {
        $user = auth()->user();
        return view('Owner/profil_owner', compact('user'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'category'    => 'required|in:makanan,minuman,dessert,lainnya',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'restaurant_id' => $restaurant->id,
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'category'      => $request->category,
            'image'         => $imagePath,
            'is_available'  => $request->has('is_available'),
        ]);

        return redirect('/kelola_menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();

        // Pastikan menu milik restoran ini
        abort_if($menu->restaurant_id !== $restaurant->id, 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'price'    => 'required|numeric',
            'category' => 'required|in:makanan,minuman,dessert,lainnya',
            'image'    => 'nullable|image|max:2048',
        ]);

        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        $menu->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'category'     => $request->category,
            'image'        => $imagePath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect('/kelola_menu')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();

        abort_if($menu->restaurant_id !== $restaurant->id, 403);

        $menu->delete();

        return redirect('/kelola_menu')->with('success', 'Menu berhasil dihapus.');
    }

    public function konfirmasiBook()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        $reservasi = $restaurant
            ? Reservation::where('restaurant_id', $restaurant->id)
                        ->where('status', 'pending')
                        ->latest()
                        ->get()
            : collect();
        return view('Owner/konfirmasi_book', compact('restaurant', 'reservasi'));
    }

    public function konfirmasiReservasi($id)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();
        $reservasi = Reservation::where('id', $id)
                        ->where('restaurant_id', $restaurant->id)
                        ->firstOrFail();

        $reservasi->update(['status' => 'confirmed']);

        return redirect('/konfirmasi_book')->with('success', 'Reservasi dikonfirmasi.');
    }

    public function tolakReservasi($id)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();
        $reservasi = Reservation::where('id', $id)
                        ->where('restaurant_id', $restaurant->id)
                        ->firstOrFail();

        $reservasi->update(['status' => 'cancelled']);

        return redirect('/konfirmasi_book')->with('success', 'Reservasi ditolak.');
    }
}
