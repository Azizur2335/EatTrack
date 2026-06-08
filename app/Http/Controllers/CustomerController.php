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

    public function beranda(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $now = now()->format('H:i:s');

        $query = Restaurant::where('status', 'active')->with('menus');

        if ($filter === 'terlaris') {
            $query->withCount('reservations')->orderByDesc('reservations_count');
        } elseif ($filter === 'buka') {
            $query->where('open_time', '<=', $now)->where('close_time', '>=', $now);
        } elseif ($filter === 'rating') {
            $query->withCount('menus')->orderByDesc('menus_count');
        }

        $restaurants = $query->get();

        if ($filter === 'terdekat' && $request->filled('lat') && $request->filled('lng')) {
            $userLat = (float) $request->query('lat');
            $userLng = (float) $request->query('lng');
            $restaurants = $restaurants->sortBy(function ($r) use ($userLat, $userLng) {
                $lat = $r->latitude ?? -8.583333;
                $lng = $r->longitude ?? 116.116667;
                return sqrt(pow($lat - $userLat, 2) + pow($lng - $userLng, 2));
            })->values();
        }

        $promos = \App\Models\Promo::where('status', 'active')
            ->where('end_date', '>=', now())
            ->with('restaurant')
            ->latest()
            ->take(5)
            ->get();
        return view('Customer/Beranda_Customer', compact('restaurants', 'promos', 'filter'));
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
        $promos = \App\Models\Promo::where('status', 'active')
            ->where('end_date', '>=', now())
            ->with(['restaurant', 'claimedBy'])
            ->latest()
            ->get();

        $claimedPromos = \App\Models\ClaimedPromo::where('customer_id', auth()->id())
            ->with(['promo.restaurant'])
            ->latest()
            ->get();

        return view('Customer/Promo', compact('promos', 'claimedPromos'));
    }
    
    public function detail_resto(Request $request, $resto_id)
    {
        $restaurant = Restaurant::with(['menus', 'tables', 'promos', 'reviews'])
            ->where('id', $resto_id)
            ->where('status', 'active')
            ->firstOrFail();

        return view('Customer/DetailResto', compact('restaurant'));
    }
    public function showProfile()
    {
        $reservations = Reservation::where('customer_id', auth()->id())->latest()->get();
        return view('Customer/Profile_customer');
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

    public function klaimPromo($id)
    {
        $promo = \App\Models\Promo::where('id', $id)
            ->where('status', 'active')
            ->where('end_date', '>=', today())
            ->firstOrFail();

        $sudahKlaim = \App\Models\ClaimedPromo::where('promo_id', $id)
            ->where('customer_id', auth()->id())
            ->exists();

        if ($sudahKlaim) {
            return back()->with('error', 'Kamu sudah mengklaim promo ini.');
        }

        if ($promo->kuota_total && $promo->claimedBy()->count() >= $promo->kuota_total) {
            return back()->with('error', 'Kuota promo sudah habis.');
        }

        \App\Models\ClaimedPromo::create([
            'promo_id'    => $id,
            'customer_id' => auth()->id(),
        ]);

        return back()->with('success', 'Promo berhasil diklaim!');
    }

    public function laporanPage()
    {
        $reservations = Reservation::where('customer_id', auth()->id())->latest()->get();
        $restaurants  = \App\Models\Restaurant::where('status', 'active')->get();
        $myReports    = \App\Models\Report::where('customer_id', auth()->id())->latest()->get();
        return view('Customer/Laporan', compact('reservations', 'restaurants', 'myReports'));
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'category'       => 'required|in:bug,saran,keluhan,pertanyaan',
            'title'          => 'required|string|max:255',
            'message'        => 'required|string',
            'screenshot'     => 'nullable|image|max:2048',
            'reservation_id' => 'nullable|exists:reservations,id',
            'restaurant_id'  => 'nullable|exists:restaurants,id',
        ]);

        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $screenshotPath = $request->file('screenshot')->store('reports', 'public');
        }

        \App\Models\Report::create([
            'customer_id'    => auth()->id(),
            'category'       => $request->category,
            'title'          => $request->title,
            'message'        => $request->message,
            'screenshot'     => $screenshotPath,
            'reservation_id' => $request->reservation_id,
            'restaurant_id'  => $request->restaurant_id,
            'status'         => 'belum_dibaca',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim.');
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
