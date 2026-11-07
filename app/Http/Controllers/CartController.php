<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $dashboardController = new DashboardController();
        return $dashboardController->addToCart($id);
    }

    public function add($id)
    {
        return $this->addToCart($id);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}
