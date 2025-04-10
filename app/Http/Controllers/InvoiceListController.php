<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceListController extends Controller
{
    public function index()
    {
        return view('invoiceList');
    }
}
