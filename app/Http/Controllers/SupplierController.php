<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SupplierController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $supplier = DB::table('suppliers')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('supplier.index', compact('supplier'));
    }
}
