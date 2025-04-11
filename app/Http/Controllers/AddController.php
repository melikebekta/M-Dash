<?php

namespace App\Http\Controllers;

use App\Models\InvoiceModel;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function index()
    {
        return view('invoiceAdd');
    }
    public function store(Request $request)
    {
        $request->validate([
            'doc_name' => 'required',
            'doc_number' => 'required',
            'doc_date' => 'required|date',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_address' => 'required',
            'customer_phone' => 'required',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'total_price' => 'required|numeric',
            'status' => 'required',
        ]);

        $userId = auth()->user()->id;

        InvoiceModel::create([
            'user_id' => $userId,
            'doc_name' => $request->doc_name,
            'doc_number' => $request->doc_number,
            'doc_date' => $request->doc_date,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_address' => $request->customer_address,
            'customer_phone' => $request->customer_phone,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'status' => $request->status,
        ]);

        return redirect()->route('add')->with('success', 'Fatura başarıyla oluşturuldu!')->withErrors([]);
    }
}
