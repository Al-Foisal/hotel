<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PurchaseController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $purchase = DB::table('purchases')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('purchase.index', compact('purchase'));
    }
}
