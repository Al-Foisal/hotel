<?php

namespace App\Http\Controllers;

use App\Models\BedType;
use App\Models\Floor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BedTypeController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = BedType::orWhereAny([
            'name',
        ], 'like', '%' . $request->q . '%')->get();

        return view('bed-type.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $user = BedType::create([
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
            $item = BedType::where('id', $id)->first();
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
