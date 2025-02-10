<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $product = DB::table('products')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('product.index', compact('product'));
    }
}
