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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/beranda', [CustomerController::class, 'beranda']);
    Route::get('/map', [CustomerController::class, 'map']);
    Route::get('/reservasi', [CustomerController::class, 'reservasi']);
});

// Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard_owner', [OwnerController::class, 'beranda']);
    Route::get('/kelola_menu', [OwnerController::class, 'kelolaMenu']);
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'beranda']);
});

