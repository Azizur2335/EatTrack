<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Services\ReservationService;
use App\Http\Requests\StoreReservationRequest;

class CustomerController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function beranda()
    {
        $restaurants = Restaurant::where('status', 'active')
            ->with('menus')
            ->get();
        return view('Customer/Beranda_Customer', compact('restaurants'));
    }

    public function map()
    {
        $restaurants = Restaurant::where('status', 'active') -> select('id', 'name', 'address', 'latitude', 'longitude')->get();
        return view('Customer/Map', compact('restaurants'));
    }

    public function reservasi()
    {
        $reservations = Reservation::where('customer_id', auth()->id())
            ->with('restaurant', 'table')
            ->latest()
            ->get();
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

    public function storeReservasi(StoreReservationRequest $request)
    {
        if ($this->reservationService->checkConflict($request->table_id, $request->date, $request->time)) {
            return back()
                ->withErrors(['table_id' => 'Meja ini sudah dipesan pada waktu tersebut.'])
                ->withInput();
        }

        $this->reservationService->store([
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

        $this->reservationService->cancel($reservation);

        return redirect('/reservasi')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
