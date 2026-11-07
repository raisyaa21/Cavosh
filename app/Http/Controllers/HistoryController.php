<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika login sebagai Admin, tampilkan SELURUH transaksi
        // Jika login sebagai User biasa, hanya tampilkan transaksi milik user tersebut
        if ($user->role === 'admin') {
            $transactions = Transaction::with('user')->latest()->get();
        } else {
            $transactions = Transaction::where('user_id', $user->id)->latest()->get();
        }

        return view('history', compact('transactions'));
    }
}