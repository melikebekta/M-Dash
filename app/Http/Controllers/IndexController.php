<?php

namespace App\Http\Controllers;

use App\Models\InvoiceModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $total = InvoiceModel::sum('total_price');
        $user_sum = InvoiceModel::count('id');

        return view('index', compact('total','user_sum'));
    }
}
