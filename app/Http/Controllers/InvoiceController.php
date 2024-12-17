<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function get_all_invoice()
    {
        $invoices = Invoice::with("customer")->orderBy("id", "DESC")->get();
        return response()->json($invoices);
    }

    function search_invoice(Request $request)
    {
        $search = $request->get("s");
        if ($search == null)
            $invoices = Invoice::with("customer")->orderBy("id", "DESC")->get();
        else
        $invoices = Invoice::with("customer")->orderBy("id", "DESC")
            ->where("id", "LIKE", "%$search%")
            ->get();
        error_log($invoices);
        return response()->json($invoices);

    }
}
