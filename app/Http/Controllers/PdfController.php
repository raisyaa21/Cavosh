<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;

class PdfController extends Controller
{
    public function export()
    {
        $transactions = Transaction::all();

        $pdf = Pdf::loadView(
            'admin.pdf',
            compact('transactions')
        );

        return $pdf->download('laporan.pdf');
    }
}