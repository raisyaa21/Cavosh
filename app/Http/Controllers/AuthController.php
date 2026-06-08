<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        User::create([

            'name' => $request->username,

            'email' => $request->username . '@gmail.com',

            'password' => Hash::make($request->password)

        ]);

        return redirect('/');
    }

    public function login(Request $request)
    {
     $credentials = [
            'email' => $request->username . '@gmail.com',
            'password' => $request->password
        ];

     if (Auth::attempt($credentials)) {
    $request->session()->regenerate();

    if (Auth::user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/dashboard');
}

       if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

    if (Auth::user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/dashboard');
}

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}