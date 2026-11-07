<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data menu dari database
        $menus = Menu::all();

        // 2. Kirim variabel $menus ke view
        return view('dashboard', compact('menus'));
    }

    public function addToCart($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->stock <= 0) {
            return redirect()->back()->with('error', 'Stok ' . $menu->name . ' sedang habis!');
        }

        // Ambil data keranjang dari Session
        $cart = session()->get('cart', []);

        // Jika item sudah ada di cart, tambahkan jumlahnya
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $menu->stock) {
                return redirect()->back()->with('error', 'Stok ' . $menu->name . ' tidak mencukupi!');
            }
            $cart[$id]['quantity']++;
        } else {
            // Jika belum ada, masukkan item baru
            $cart[$id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}
