<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('product-category.index');
    }
}
