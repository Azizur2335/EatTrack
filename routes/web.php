<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/loginPage', function () {
    return view('login_page');
});

Route::get('/register_page', function () {
    return view('register_page');
});

Route::get('/register_as_customer', function () {
    return view('register_as_customer');
});

Route::get('/map', function () {
    return view('Customer/Map');
});

Route::get('/beranda', function () {
    return view('Customer/Beranda_Customer');
});

Route::get('/reservasi', function () {
    return view('Customer/Reservasi');
});

Route::get('/dashboard_owner', function () {
    return view('Owner/beranda_owner');
});

Route::get('/dashboard_admin', function () {
    return view('Admin/beranda_admin');
});

Route::get('/kelola_menu', function () {
    return view('Owner/kelola_menu');
});
