<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = Supplier::orWhereAny([
            'name',
            'phone',
            'contact_person_name',
            'contact_person_phone'
        ], 'like', '%' . $request->q . '%')->paginate();

        return view('supplier.index', $data);
    }
    public function create()
    {
        $data = [];
        return view('supplier.create', $data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $item = Supplier::create([
                'name' => ucwords($request->name),
                'phone' => $request->phone,
                'address' => $request->address,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_phone' => $request->contact_person_phone,
            ]);

            if (
                $request->payment_type &&
                $request->account_name &&
                $request->branch &&
                $request->account_number
            ) {
                foreach ($request->payment_type as $key => $type) {
                    SupplierPayment::create([
                        'supplier_id' => $item->id,
                        'payment_type' => $type,
                        'account_name' => $request->account_name[$key],
                        'branch' => $request->branch[$key],
                        'account_number' => $request->account_number[$key],
                    ]);
                }
            }

            DB::commit();
            return back()->withToastSuccess('Data created successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function show($id)
    {
        $item = Supplier::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        return view('supplier.show', compact('item'));
    }
    public function edit($id)
    {
        $item = Supplier::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        return view('supplier.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $item = Supplier::where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }

            $item->update([
                'name' => ucwords($request->name),
                'phone' => $request->phone,
                'address' => $request->address,
                'contact_person_name' => $request->contact_person_name,
                'contact_person_phone' => $request->contact_person_phone,
            ]);

            $item->supplierPayments()->delete();

            if (
                $request->payment_type &&
                $request->account_name &&
                $request->branch &&
                $request->account_number
            ) {
                foreach ($request->payment_type as $key => $type) {
                    if (
                        $type &&
                        $request->account_name[$key] &&
                        $request->branch[$key] &&
                        $request->account_number[$key]
                    ) {
                        SupplierPayment::create([
                            'supplier_id' => $item->id,
                            'payment_type' => $type,
                            'account_name' => $request->account_name[$key],
                            'branch' => $request->branch[$key],
                            'account_number' => $request->account_number[$key],
                        ]);
                    }
                }
            }

            DB::commit();
            return back()->withToastSuccess('Data updated successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }
    public function delete(Request $request, $id)
    {
        $item = Supplier::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }
        $item->supplierPayments()->delete();

        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
