<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservations;
use App\Models\Table;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        if(auth()->check()){
            return match (auth()->user()->role){
                'owner' => redirect('/dashboard_owner'),
                'admin' => redirect('/dashboard_admin'),
                default => redirect('/beranda'),
            };
        }
        return view('login_page');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        
        $credentials = [
            $loginField => $request->username, 'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Akun kamu telah dinonaktifkan. Hubungi admin.',
                ]);
            }

            $request->session()->regenerate();
            return match(Auth::user()->role) {
                'owner' => redirect('/dashboard_owner'),
                'admin' => redirect('/dashboard_admin'),
                default => redirect('/beranda'),
            };
        }
        return back()->withErrors([
            'username' => 'Username/email atau password salah.',
        ])->withInput();
    }

    public function showRegister()
    {
        if(auth()->check()){
            return redirect('/beranda');
        }
        return view('register_page');
    }

    public function showRegisterCustomer()
    {
        if(auth()->check()){
            return redirect('/beranda');
        }
        return view('register_as_customer');
    }

    public function showRegisterOwner()
    {
        if(auth()->check()){
            return redirect('/beranda');
        }
        return view('register_as_owner');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string|max:15',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:customer,owner',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        Auth::login($user);
        return match($user->role){
            'owner' => redirect('/dashboard_owner'),
            default => redirect('/beranda'), 
        };
    }

    public function registerOwner(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users',
            'phone'           => 'required|string|max:15',
            'password'        => 'required|min:8|confirmed',
            'restaurant_name' => 'required|string|max:255',
            'address'         => 'required|string',
            'category'        => 'required|string',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'owner',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('restaurants', 'public');
        }

        $restaurant = Restaurant::create([
            'owner_id'    => $user->id,
            'name'        => $request->restaurant_name,
            'address'     => $request->address,
            'city'        => $request->city,
            'description' => $request->description,
            'phone'       => $request->phone,
            'category'    => $request->category,
            'maps_link'   => $request->maps_link,
            'open_time'   => $request->open_time,
            'close_time'  => $request->close_time,
            'image'       => $imagePath,
            'status'      => 'active',
        ]);

        for ($i = 1; $i <= $request->capacity; $i++) {
            \App\Models\Table::create([
                'restaurant_id' => $restaurant->id,
                'table_number'  => 'Meja ' . $i,
                'capacity'      => 4,
                'status'        => 'available',
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard_owner');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/loginPage');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                return redirect('/loginPage')
                    ->withErrors(['email' => 'Email ini sudah terdaftar. Silakan login dengan password.']);
            }

            $user = User::create([
                'name'      => $googleUser->name,
                'email'     => $googleUser->email,
                'google_id' => $googleUser->id,
                'password'  => Hash::make(str()->random(32)),
                'role'      => 'customer',
                'phone'     => null,
            ]);
        }

        Auth::login($user);

        return match($user->role) {
            'owner' => redirect('/dashboard_owner'),
            'admin' => redirect('/dashboard_admin'),
            default => redirect('/beranda'),
        };
    }
}
