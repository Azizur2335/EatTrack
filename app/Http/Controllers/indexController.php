<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class IndexController extends Controller
{
	// Controller
	public function index() {
		return view('index', [
			'totalUsers'       => User::count(),
			'totalRestaurants' => Restaurant::count(),
			'totalReservations' => Reservation::count(),
		]);
	}
}
