<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    use HasFactory;
    protected $fillable=[
        "invoice_id",
        "product_id",
        "unit_price",
        "quantity",
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
