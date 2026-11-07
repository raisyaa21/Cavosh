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
        $input = $request->username;
        $name = str_contains($input, '@') ? explode('@', $input)[0] : $input;
        $email = str_contains($input, '@') ? $input : $input . '@gmail.com';

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $loginInput = $request->username;
        $email = str_contains($loginInput, '@') ? $loginInput : $loginInput . '@gmail.com';

        $credentials = [
            'email' => $email,
            'password' => $request->password
        ];

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
