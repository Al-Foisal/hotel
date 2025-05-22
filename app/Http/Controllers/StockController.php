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
        $search = $request->input('q');
        $query = Stock::query();
        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $query = $query->select('product_id', DB::raw('SUM(quantity) as total_quantity'), 'expired_date')
            ->groupBy('product_id')
            ->groupBy('expired_date');
        $stocks = $query->join('products', 'stocks.product_id', '=', 'products.id')
            ->orderBy('products.name', 'asc')
            ->orderBy('expired_date', 'asc')
            ->get();


        return view('stock.index', compact('stocks'));
    }
}
