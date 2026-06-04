<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;

// Public

Route::get('/', function () {
    return view('index');
});

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

// Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/beranda', [CustomerController::class, 'beranda']);
    Route::get('/map', [CustomerController::class, 'map']);
    Route::get('/reservasi', [CustomerController::class, 'reservasi']);
    Route::get('/promo', [CustomerController::class, 'promo']);
    Route::get('/detail_resto', [CustomerController::class, 'detail_resto']);
    Route::post('/reservasi', [CustomerController::class, 'storeReservasi']);
    Route::patch('/reservasi/{id}/cancel', [CustomerController::class, 'cancelReservasi']);
});

// Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard_owner', [OwnerController::class, 'beranda']);
    Route::get('/kelola_menu', [OwnerController::class, 'kelolaMenu']);
    Route::post('/kelola_menu', [OwnerController::class, 'storeMenu']);
    Route::put('/kelola_menu/{id}', [OwnerController::class, 'updateMenu']);
    Route::delete('/kelola_menu/{id}', [OwnerController::class, 'destroyMenu']);
    Route::get('/konfirmasi_book', [OwnerController::class, 'konfirmasiBook']);
    Route::get('/promo_owner', [OwnerController::class, 'promo']);
    Route::get('/tambah_promo', [OwnerController::class, 'tambah_promo']);
    Route::get('/profil_owner', [OwnerController::class, 'profil']);
    Route::patch('/konfirmasi_book/{id}/konfirmasi', [OwnerController::class, 'konfirmasiReservasi']);
    Route::patch('/konfirmasi_book/{id}/tolak', [OwnerController::class, 'tolakReservasi']);
    Route::post('/promo_owner', [OwnerController::class, 'storePromo']);
    Route::put('/profil_owner', [OwnerController::class, 'updateProfil']);
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'beranda']);
    Route::get('/kelola_user', [AdminController::class, 'kelolaUser']);
    Route::get('/laporan', [AdminController::class, 'laporan']);
    Route::patch('/kelola_user/{id}/activate', [AdminController::class, 'activateUser']);
    Route::patch('/kelola_user/{id}/ban', [AdminController::class, 'banUser']);
    Route::delete('/kelola_user/{id}', [AdminController::class, 'destroyUser']);
});

