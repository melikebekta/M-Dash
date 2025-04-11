<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    protected $table = "invoices";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'doc_name',
        'doc_number',
        'doc_date',
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_phone',
        'quantity',
        'unit_price',
        'total_price',
        'paid_amount',
        'status',
        'created_at',
    ];
}
