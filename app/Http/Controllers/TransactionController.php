<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        // 1. Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja masih kosong!');
        }

        // 2. Hitung total belanjaan secara otomatis dari session cart
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Validasi metode pembayaran (Cash / QRIS)
        $request->validate([
            'payment_method' => 'required|in:Cash,QRIS',
        ]);

        // 4. Simpan transaksi ke database
        Transaction::create([
            'user_id'        => Auth::id() ?? 1, // Mengikat transaksi ke user yang sedang login
            'total'          => $total,
            'payment_method' => $request->payment_method,
        ]);

        // 5. Kurangi stok menu di database
        foreach ($cart as $id => $item) {
            $menu = Menu::find($id);
            if ($menu) {
                $menu->stock = max(0, $menu->stock - $item['quantity']);
                $menu->save();
            }
        }

        // 6. Kosongkan keranjang belanja setelah checkout berhasil
        session()->forget('cart');

        return redirect('/history')->with('success', 'Checkout berhasil menggunakan ' . $request->payment_method . '!');
    }
}
