<?php

namespace App\Http\Controllers;

use App\Models\AccountCategory;
use Illuminate\Http\Request;
use App\Models\AccountVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AccountVoucherController extends Controller
{
    public function index()
    {
        $vouchers = AccountVoucher::paginate();
        return view('account.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        $data = [];
        $data['categories'] = AccountCategory::orderBy('name', 'asc')->orderBy('type', 'asc')->get();
        return view('account.voucher.create', $data);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'voucher_number' => 'required|unique:account_vouchers,voucher_number',
            'voucher_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('voucher', $file_name);
        }

        AccountVoucher::create([
            'account_category_id' => $request->account_category_id,
            'user_id' => Auth::id(),
            'voucher_number' => $request->voucher_number,
            'voucher_date' => $request->voucher_date,
            'description' => $request->description,
            'amount' => $request->amount,
            'image' => $image,
        ]);

        return back()->with('success', 'Voucher created successfully.');
    }

    public function edit($id)
    {
        $item = AccountVoucher::findOrFail($id);
        $categories = AccountCategory::orderBy('name', 'asc')->orderBy('type', 'asc')->get();
        return view('account.voucher.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'voucher_number' => 'required|unique:account_vouchers,voucher_number,' . $id,
            'voucher_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        $data = AccountVoucher::findOrFail($id);

        $image = null;
        if ($request->hasFile('image')) {
            $file_name = $request->file('image');
            $image = uploadImage('roa', $file_name);

            $image_path = public_path($data->image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $data->update(['image' => $image]);
        }

        $data->update([
            'account_category_id' => $request->account_category_id,
            'voucher_number' => $request->voucher_number,
            'voucher_date' => $request->voucher_date,
            'description' => $request->description,
            'amount' => $request->amount,
        ]);

        return back()->with('success', 'Voucher updated successfully.');
    }

    public function delete($id)
    {
        $voucher = AccountVoucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('account.voucher.index')->with('success', 'Voucher deleted successfully.');
    }
}
