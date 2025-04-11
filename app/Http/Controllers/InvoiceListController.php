<?php

namespace App\Http\Controllers;

use App\Models\InvoiceModel;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceListController extends Controller
{
    // public function index()
    // {
    //     return view('invoiceList');
    // }
    public function index()
    {
        $invoices = InvoiceModel::paginate(10);
        return view("invoiceList", compact("invoices"));
    }

    public function delete(Request $request)
    {
        $invoiceIds = $request->input('invoiceid');
        if (is_array($invoiceIds) && count($invoiceIds) > 0) {
            InvoiceModel::whereIn('id', $invoiceIds)->delete();
        }
        return redirect()->back()->with('success', 'Invoices deleted successfully');
    }
}
