<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('purchase.index');
    }

    public function create(Request $request)
    {
        $data = [];
        $data['suppliers'] = Supplier::all();
        $data['products'] = Product::all();
        return view('purchase.create', $data);
    }
}
