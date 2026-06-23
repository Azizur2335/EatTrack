<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;

// Public

Route::get('/', [IndexController::class, 'index']);

// Auth
Route::get('/loginPage', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register_page', [AuthController::class, 'showRegister']);
Route::get('/register_as_customer', [AuthController::class, 'showRegisterCustomer']);
Route::get('/register_as_owner', [AuthController::class, 'showRegisterOwner']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('/register-owner', [AuthController::class, 'registerOwner']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/beranda', [CustomerController::class, 'beranda']);
    Route::get('/map', [CustomerController::class, 'map']);
    Route::get('/reservasi', [CustomerController::class, 'reservasi']);
    Route::get('/promo', [CustomerController::class, 'promo']);
    Route::get('/katalog/{resto_id}', [CustomerController::class, 'detail_resto']);
    Route::get('/api/available-tables/{resto_id}', [CustomerController::class, 'availableTables']);
    Route::post('/reservasi', [CustomerController::class, 'storeReservasi']);
    Route::get('/profile', [CustomerController::class, 'showProfile']);
    Route::delete('/reservasi/{id}', [CustomerController::class, 'cancelReservasi'])->name('reservasi.cancel');
    Route::get('/laporan', [CustomerController::class, 'laporanPage'])->name('customer.laporan');
    Route::post('/laporan', [CustomerController::class, 'storeLaporan']);
    Route::post('/promo/{id}/klaim', [CustomerController::class, 'klaimPromo'])->name('promo.klaim');
});

// Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard_owner', [OwnerController::class, 'beranda']);
    Route::get('/kelola_menu', [OwnerController::class, 'kelolaMenu']);
    Route::post('/kelola_menu', [OwnerController::class, 'storeMenu']);
    Route::put('/kelola_menu/{id}', [OwnerController::class, 'updateMenu']);
    Route::delete('/kelola_menu/{id}', [OwnerController::class, 'destroyMenu']);
    Route::patch('/kelola_menu/{id}/activate', [OwnerController::class, 'activateMenu']);
    Route::patch('/kelola_menu/{id}/deactivate', [OwnerController::class, 'deactivateMenu']);
    Route::get('/konfirmasi_book', [OwnerController::class, 'konfirmasiBook']);
    Route::get('/promo_owner', [OwnerController::class, 'promo']);
    Route::get('/tambah_promo', [OwnerController::class, 'tambah_promo']);
    Route::get('/profil_owner', [OwnerController::class, 'profil']);
    Route::patch('/konfirmasi_book/{id}/konfirmasi', [OwnerController::class, 'konfirmasiReservasi']);
    Route::patch('/konfirmasi_book/{id}/tolak', [OwnerController::class, 'tolakReservasi']);
    Route::post('/promo_owner', [OwnerController::class, 'storePromo']);
    Route::get('/tambah_promo/{id}/edit', [OwnerController::class, 'editPromo']);
    Route::patch('/promo_owner/{id}', [OwnerController::class, 'updatePromo']);
    Route::patch('/promo_owner/{id}/nonaktifkan', [OwnerController::class, 'nonaktifkanPromo']);
    Route::delete('/promo_owner/{id}', [OwnerController::class, 'destroyPromo']);
    Route::post('/profil_owner', [OwnerController::class, 'updateProfil']);
    Route::post('/profil_owner/user', [OwnerController::class, 'updateUserProfil']);
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'beranda']);
    Route::get('/kelola_user', [AdminController::class, 'kelolaUser']);
    Route::post('/kelola_user', [AdminController::class, 'storeUser']);
    Route::get('/laporan_admin', [AdminController::class, 'laporan']);
    Route::patch('/kelola_user/{id}/activate', [AdminController::class, 'activateUser']);
    Route::patch('/kelola_user/{id}/ban', [AdminController::class, 'banUser']);
    Route::delete('/kelola_user/{id}', [AdminController::class, 'destroyUser']);
    Route::patch('/laporan_admin/{id}/status', [AdminController::class, 'updateStatusLaporan']);
});

// API
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/restaurants', function () {
        $restaurants = \App\Models\Restaurant::where('status', 'active')->get();
        return \App\Http\Resources\RestaurantResource::collection($restaurants);
    });

    Route::get('/reservations', function () {
        $reservations = \App\Models\Reservation::where('customer_id', auth()->id())
            ->with('restaurant', 'table')
            ->latest()
            ->get();
        return \App\Http\Resources\ReservationResource::collection($reservations);
    });
});

