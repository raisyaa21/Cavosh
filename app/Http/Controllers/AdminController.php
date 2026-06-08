<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function index()
{
    $menu = Menu::count();

    $user = User::count();

    $transaction = Transaction::count();

    $income = Transaction::sum('total');

    return view('admin.dashboard', compact(
        'menu',
        'user',
        'transaction',
        'income'
    ));
}
}