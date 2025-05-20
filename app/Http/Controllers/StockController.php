<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //
    public function index(Request $request)
    {
        $stocks = Stock::select('product_id', DB::raw('SUM(quantity) as total_quantity'), 'expired_date')
            ->groupBy('product_id')
            ->groupBy('expired_date')
            ->get();


        return view('stock.index', compact('stocks'));
    }
}
