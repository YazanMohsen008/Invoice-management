<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function get_all_invoice()
    {
        $invoices = Invoice::with("customer")->orderBy("id", "DESC")->get();
        return response()->json($invoices);
    }

    function add_invoice(Request $request)
    {
        $invoice = $request->all();
        $createdInvoice=Invoice::create($invoice);
        $invoiceItems =json_decode( $invoice["invoice_items"]);
        foreach ($invoiceItems as $item) {
            $invoiceItem["invoice_id"]=$createdInvoice->id;
            $invoiceItem["product_id"]=$item->id;
            $invoiceItem["unit_price"]=$item->unit_price;
            $invoiceItem["quantity"]=$item->quantity;
            InvoiceItems::create($invoiceItem);
        }
        return response()->json();
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
        return response()->json($invoices);

    }
}
