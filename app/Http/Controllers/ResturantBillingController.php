<?php

namespace App\Http\Controllers;

use App\Models\ResturantMenuItemCategory;
use Illuminate\Http\Request;

class ResturantBillingController extends Controller
{
    public function index()
    {
        return view('resturant.billing.index');
    }

    public function create()
    {
        $data = [];
        $data['categories'] = ResturantMenuItemCategory::with([
            'menuItems' => function ($query) {
                $query->where('status', 'active');
            }
        ])->get();
        return view('resturant.billing.create', $data);
    }

    public function show($id)
    {
        return view('resturant.billing.show', compact('id'));
    }

    /*
        * @param Request $request
        * @return \Illuminate\Http\JsonResponse
        */
    public function getMenuItem(Request $request)
    {
        $search = $request->input('search');

        $categories = ResturantMenuItemCategory::orWhereAny([
            'name'
        ], 'like', '%' . $search . '%')
            ->whereHas(
                'menuItems',
                function ($query) use ($search) {
                    $query->where('status', 'active');
                    if ($search) {
                        $query->whereAny([
                            'name'
                        ], 'like', '%' . $search . '%');
                    }
                }
            )->get();
            // dd($categories);    
        return view('resturant.billing.menu_items', compact('categories'));
    }
}
