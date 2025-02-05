<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SupplierPaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $supplier_payment = DB::table('supplier_payments')
            ->get();
        return view('supplier-payment.index', compact('supplier_payment'));
    }
}
