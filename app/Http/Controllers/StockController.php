<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class StockController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $stock = DB::table('stocks')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('stock.index', compact('stock'));
    }
}
