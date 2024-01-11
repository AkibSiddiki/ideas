<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.registration');
    }

    public function store()
    {
        // dump(request()->all());
        $vali = request()->validate([
            "name" => "required|min:2|max:60",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed"
        ]);


        User::create([
            'name' => $vali['name'],
            'email' => $vali['email'],
            'password' => Hash::make($vali['password']),
        ]);

        return redirect()->route('home')->with('success', 'User created Successfully!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction()
    {
        // dd(request()->all());
        $vali = request()->validate([
            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        if (auth()->attempt($vali)) {
            request()->session()->regenerate();
            return redirect()->route('home')->with('success', 'You are Successfully Login!');
        } else {
            return redirect()->route('auth.login')->with('success', 'Given Email & password does not match!!');
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'You are Successfully Logout!');;
    }
}
