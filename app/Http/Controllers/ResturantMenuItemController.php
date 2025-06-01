<?php

namespace App\Http\Controllers;

use App\Models\ResturantMenuItem;
use App\Models\ResturantMenuItemCategory;
use Illuminate\Http\Request;

class ResturantMenuItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = ResturantMenuItemCategory::with(['menuItems' => function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }
        }])->get();

        return view('resturant.menu-item.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $image = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('menu-item', $file_name);
        }

        ResturantMenuItem::create([
            'resturant_menu_item_category_id' => $request->resturant_menu_item_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'formation_duration' => $request->formation_duration,
            'status' => $request->status,
            'image' => $image,
        ]);
        return back();
    }



    public function update(Request $request, $id)
    {


        $product = ResturantMenuItem::findOrFail($id);
        if (!$product) {
            return back()->withErrors(['error' => 'Product not found']);
        }
        $image = $product->image;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('menu-item', $file_name);
        }

        $product->update([
            'resturant_menu_item_category_id' => $request->resturant_menu_item_category_id,
            'name' => $request->name,
            'price' => $request->price,
            'formation_duration' => $request->formation_duration,
            'status' => $request->status,
            'image' => $image,
        ]);

        return back();
    }

    public function delete($id)
    {
        $product = ResturantMenuItem::findOrFail($id);
        if (!$product) {
            return back()->withErrors(['error' => 'Product not found']);
        }
        $product->delete();
        return back();
    }
}
