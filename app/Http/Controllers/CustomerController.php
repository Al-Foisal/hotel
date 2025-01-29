<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = Customer::orWhereAny([
            'name',
            'email',
            'phone',
            'country',
            'state',
            'city',
            'identity_type',
            'identity_number',
        ], 'like', '%' . $request->q . '%')->paginate();

        return view('customer.index', $data);
    }

    public function create()
    {
        return view('customer.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $identity_image = null;
            if ($request->hasFile('identity_image')) {
                $file_name = $request->file('identity_image');
                $identity_image = uploadImage('customer', $file_name);
            }

            Customer::create([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'gender' => $request->gender,
                'age' => $request->age,
                'identity_type' => $request->identity_type,
                'identity_number' => $request->identity_number,
                'identity_image' => $identity_image,
            ]);

            DB::commit();
            return to_route('customer.index')->withToastSuccess('Data created successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function edit($id)
    {
        $item = Customer::where('id', $id)->first();

        if (!$item) {
            return back()->withToastError('No data found');
        }

        return view('customer.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {

            $item = Customer::where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }
            $identity_image = null;
            if ($request->hasFile('identity_image')) {
                $image_path = public_path($item->identity_image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $file_name = $request->file('identity_image');
                $identity_image = uploadImage('customer', $file_name);

                $item->update(['identity_image' => $identity_image]);
            }

            $item->update([
                'name' => ucwords($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'gender' => $request->gender,
                'age' => $request->age,
                'identity_type' => $request->identity_type,
                'identity_number' => $request->identity_number,
            ]);

            DB::commit();
            return to_route('customer.index')->withToastSuccess('Data created successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }
    public function delete(Request $request, $id)
    {
        $item = Customer::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        $image_path = public_path($item->identity_image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
