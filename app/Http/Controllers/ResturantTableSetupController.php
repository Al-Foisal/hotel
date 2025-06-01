<?php

namespace App\Http\Controllers;

use App\Models\ResturantTableSetup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResturantTableSetupController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = ResturantTableSetup::orWhereAny([
            'table_number',
            'capacity',
            'status',
            'table_position'
        ], 'like', '%' . $request->q . '%')->get();

        return view('resturant.table-setup.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_number' => 'required',
            'capacity' => 'required|integer',
            'status' => 'required|in:Available,Reserved,Occupied',
            'table_position' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            ResturantTableSetup::create([
                'table_number' => $request->table_number,
                'capacity' => $request->capacity,
                'status' => $request->status,
                'table_position' => $request->table_position,
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
            'table_number' => 'required',
            'capacity' => 'required|integer',
            'status' => 'required|in:Available,Reserved,Occupied',
            'table_position' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $item = ResturantTableSetup::where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }

            $item->update([
                'table_number' => $request->table_number,
                'capacity' => $request->capacity,
                'status' => $request->status,
                'table_position' => $request->table_position,
            ]);

            DB::commit();
            return back()->withToastSuccess('Data updated successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }
    public function delete(Request $request, $id)
    {
        $item = ResturantTableSetup::where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
