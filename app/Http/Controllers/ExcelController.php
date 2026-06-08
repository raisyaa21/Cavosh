<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(
            new TransactionsExport,
            'laporan.xlsx'
        );
    }
}