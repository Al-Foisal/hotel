<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = Facility::orWhereAny([
            'name',
        ], 'like', '%' . $request->q . '%')->get();

        return view('facility.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:facilities',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $user = Facility::create([
                'name' => ucwords($request->name),
            ]);

            DB::commit();
            return back()->withToastSuccess('Data created successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $item = Facility::where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }

            $item->update([
                'name' => $request->name,
            ]);

            DB::commit();
            return back()->withToastSuccess('Data updated successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }
    
}
