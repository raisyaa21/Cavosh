<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $transactions = Transaction::query()

            ->when($search,function($query) use ($search){

                $query->where('id','like',"%$search%");
            })

            ->latest()

            ->get();

        return view(
            'admin.report',
            compact('transactions')
        );
    }
}