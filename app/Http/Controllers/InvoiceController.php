<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItems;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function add(Request $request)
    {
        $invoice = $request->all();
        $createdInvoice = Invoice::create($invoice);
        $invoiceItems = json_decode($invoice["invoice_items"]);
        foreach ($invoiceItems as $item) {
            $invoiceItem["invoice_id"] = $createdInvoice->id;
            $invoiceItem["product_id"] = $item->id;
            $invoiceItem["unit_price"] = $item->unit_price;
            $invoiceItem["quantity"] = $item->quantity;
            InvoiceItems::create($invoiceItem);
        }
        return response()->json();
    }

    function update(Request $request)
    {
        $invoiceId = $request->only("id");
        $invoice = Invoice::find($invoiceId)->first();
        $invoice->update( $request->all());
        $invoice->items()->delete();
        $invoiceItems = json_decode($request["invoice_items"]);
        foreach ($invoiceItems as $item) {
            $invoiceItem["invoice_id"] = $invoice->id;
            $invoiceItem["product_id"] = $item->product->id;
            $invoiceItem["unit_price"] = $item->unit_price;
            $invoiceItem["quantity"] = $item->quantity;
            InvoiceItems::create($invoiceItem);
        }
        return response()->json();
    }
    function all()
    {
        $invoices = Invoice::with("customer")->orderBy("id", "DESC")->get();
        return response()->json($invoices);
    }

    function byId($id)
    {
        $invoices = Invoice::with(["customer", "items.product"])->find($id);
        return response()->json($invoices);
    }


    function search(Request $request)
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
    function delete($id)
    {
        $invoices = Invoice::with(["items"])->find($id);
        $invoices->items()->delete();
        $invoices->delete();
        return response()->json($invoices);
    }

}
