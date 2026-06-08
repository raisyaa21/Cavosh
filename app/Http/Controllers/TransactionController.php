<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\OrderItem;
use App\Models\Menu;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $transaction = Transaction::create([

            'total' => $request->total,

            'payment_method' => $request->payment_method

        ]);

        foreach($request->items as $item){

            OrderItem::create([

                'transaction_id' => $transaction->id,

                'menu_id' => $item['menu_id'],

                'qty' => $item['qty'],

                'subtotal' => $item['subtotal']

            ]);

            $menu = Menu::find($item['menu_id']);

            $menu->stock -= $item['qty'];

            $menu->save();
        }

        return response()->json([
            'message' => 'Checkout berhasil'
        ]);
    }
}