<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function get_all_invoice()
    {
        $invoices = Invoice::with("customer")->orderBy("id","DESC")->get();
        return response()->json($invoices);
    }
}
