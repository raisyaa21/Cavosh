<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        $menus = Menu::all();

        return view('dashboard', compact('menus'));
    }
}