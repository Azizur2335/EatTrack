<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
            $request->session()->regenerate();
            return match(Auth::user()->role){
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
        $user = User::where('email', $googleUser->email)->first();

        if (!$user){
            $user = User::create([
                'name'     => $googleUser->name,
                'email'    => $googleUser->email,
                'password' => Hash::make(str()->random(16)),
                'role'     => 'customer',
                'phone'    => null,
            ]);
        }

        Auth::login($user);

        return match($user->role){
            'owner' => redirect('/dashboard_owner'),
            'admin' => redirect('/dashboard_admin'),
            default => redirect('/beranda'),
        };
    }
}
