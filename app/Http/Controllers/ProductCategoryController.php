<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ProductCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $product_category = DB::table('product_categories')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('product-category.index', compact('product_category'));
    }
}
