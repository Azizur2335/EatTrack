<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Table;

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
    
    public function detail_resto(Request $request)
    {
        $restaurant = Restaurant::with(['menus', 'tables'])
            ->where('id', $request->restaurant_id)
            ->where('status', 'active')
            ->firstOrFail();

        return view('Customer/DetailResto', compact('restaurant'));
    }

    public function storeReservasi(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id'      => 'required|exists:tables,id',
            'date'          => 'required|date|after_or_equal:today',
            'time'          => 'required',
            'guest_count'   => 'required|integer|min:1',
            'notes'         => 'nullable|string',
        ]);

        $conflict = Reservation::where('table_id', $request->table_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors(['table_id' => 'Meja ini sudah dipesan pada waktu tersebut. Silakan pilih meja atau waktu lain.'])
                ->withInput();
        }

        Reservation::create([
            'customer_id'   => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'table_id'      => $request->table_id,
            'date'          => $request->date,
            'time'          => $request->time,
            'guest_count'   => $request->guest_count,
            'notes'         => $request->notes,
            'status'        => 'pending',
        ]);

        return redirect('/reservasi')->with('success', 'Reservasi berhasil dibuat, menunggu konfirmasi.');
    }

    public function cancelReservasi($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('customer_id', auth()->id())
            ->where('status', 'pending')
            ->with('table')
            ->firstOrFail();

        $reservation->update(['status' => 'cancelled']);
        $reservation->table->update(['status' => 'available']);

        return redirect('/reservasi')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
