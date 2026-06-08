<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class HistoryController extends Controller
{
    public function index()
    {
        $transactions =
        Transaction::latest()->get();

        return view(
            'history',
            compact('transactions')
        );
    }
}