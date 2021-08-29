<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Transaction;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['store_import', 'product'])->orderBy('id','desc')->paginate();

//        return response()->json($transactions);

        return view('Dashboard.Invoices.index', [
            'transactions' => $transactions
        ]);
    }
}
