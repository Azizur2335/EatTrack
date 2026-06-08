<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Promo;
use Illuminate\Http\Request;
use App\Services\ReservationService;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\StorePromoRequest;

class OwnerController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function beranda()
    {
        $periode = request('periode', 'day');
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();

        $query = $restaurant
            ? Reservation::where('restaurant_id', $restaurant->id)->with('customer', 'tableData')
            : Reservation::whereNull('id');

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
        $reservasiSelesai      = (clone $query)->where('status', 'completed')->count();
        $menungguKonfirmasi    = $reservasiPending;

        $reservasiTerbaru = $restaurant
            ? Reservation::where('restaurant_id', $restaurant->id)
                ->with('customer', 'tableData')
                ->latest()
                ->take(5)
                ->get()
            : collect();

        return view('Owner/beranda_owner', compact(
            'restaurant', 'periode',
            'totalReservasi', 'reservasiDikonfirmasi',
            'reservasiPending', 'reservasiDibatalkan',
            'reservasiSelesai', 'menungguKonfirmasi',
            'reservasiTerbaru'
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

        $promos           = $restaurant ? Promo::where('restaurant_id', $restaurant->id)->latest()->get() : collect();
        $promoAktifCount  = $promos->where('status', 'active')->where('end_date', '>=', today())->count();
        $promoBerakirCount = $promos->where('end_date', '<', today())->count();

        return view('Owner/promo_owner', compact('restaurant', 'promos', 'promoAktifCount', 'promoBerakirCount'));
    }

    public function tambah_promo()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->first();
        return view('Owner/tambahpromo_owner', compact('restaurant'));
    }

    public function storePromo(StorePromoRequest $request)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();

        Promo::create([
            'restaurant_id' => $restaurant->id,
            'title'         => $request->title,
            'description'   => $request->description,
            'discount'      => $request->discount,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'status'        => 'active',
        ]);

        return redirect('/promo_owner')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function profil()
    {
        $user = auth()->user();

        $restaurant = $user->restaurant;
        return view('Owner/profil_owner', compact('user', 'restaurant'));
    }

    public function storeMenu(StoreMenuRequest $request)
    {
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

        $statusMap = [
            'menunggu'     => 'pending',
            'dikonfirmasi' => 'confirmed',
            'ditolak'      => 'cancelled',
        ];

        $filterLabel = request('status', 'semua');
        $filterDb    = $statusMap[$filterLabel] ?? null;

        $query = $restaurant
            ? Reservation::where('restaurant_id', $restaurant->id)->with('customer', 'tableData')->latest()
            : Reservation::whereNull('id');

        if ($filterDb) {
            $query->where('status', $filterDb);
        }

        $reservasi = $query->get();

        return view('Owner/konfirmasi_book', compact('restaurant', 'reservasi', 'filterLabel'));
    }

    public function konfirmasiReservasi($id)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();
        $reservasi  = Reservation::where('id', $id)
                        ->where('restaurant_id', $restaurant->id)
                        ->with('tableData')
                        ->firstOrFail();

        $this->reservationService->confirm($reservasi);

        return redirect('/konfirmasi_book')->with('success', 'Reservasi dikonfirmasi.');
    }

    public function tolakReservasi($id)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();
        $reservasi  = Reservation::where('id', $id)
                        ->where('restaurant_id', $restaurant->id)
                        ->with('tableData')
                        ->firstOrFail();

        $this->reservationService->cancel($reservasi);

        return redirect('/konfirmasi_book')->with('success', 'Reservasi ditolak.');
    }

    public function updateProfil(Request $request)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())->firstOrFail();

        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string',
            'city'        => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:15',
            'description' => 'nullable|string',
            'category'    => 'required|string',
            'open_time'   => 'nullable|date_format:H:i',
            'close_time'  => 'nullable|date_format:H:i|after:open_time',
            'maps_link'   => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $imagePath = $restaurant->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
        }

        // Extract latitude & longitude dari Google Maps link
        $latitude = $restaurant->latitude;
        $longitude = $restaurant->longitude;
        if ($request->maps_link) {
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $request->maps_link, $m)) {
                $latitude  = $m[1];
                $longitude = $m[2];
            }
            elseif (preg_match('/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/', $request->maps_link, $m)) {
                $latitude  = $m[1];
                $longitude = $m[2];
            }
            elseif (preg_match('/ll=(-?\d+\.\d+),(-?\d+\.\d+)/', $request->maps_link, $m)) {
                $latitude  = $m[1];
                $longitude = $m[2];
            }
        }

        $restaurant->update([
            'name'        => $request->name,
            'address'     => $request->address,
            'city'        => $request->city,
            'phone'       => $request->phone,
            'description' => $request->description,
            'category'    => $request->category,
            'open_time'   => $request->open_time,
            'close_time'  => $request->close_time,
            'maps_link'   => $request->maps_link,
            'latitude'    => $latitude,
            'longitude'   => $longitude,
            'image'       => $imagePath,
        ]);

        return redirect('/profil_owner')->with('success', 'Profil restoran berhasil diperbarui.');
    }
}
