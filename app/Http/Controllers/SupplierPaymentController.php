<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierPaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('supplier-payment.index');
    }
}
