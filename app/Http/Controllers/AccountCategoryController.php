<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountCategory;

class AccountCategoryController extends Controller
{
    public function index(Request $request)
    {
        $items = AccountCategory::orWhereAny([
            'name',
            'type'
        ], 'like', '%' . $request->q . '%')->get();
        return view('account.category.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Income,Expense'
        ]);
        $category = AccountCategory::create($validated);
        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Income,Expense'
        ]);
        $category = AccountCategory::findOrFail($id);
        $category->update($validated);
        return back()->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = AccountCategory::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
