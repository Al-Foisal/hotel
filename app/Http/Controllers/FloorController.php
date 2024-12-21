<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FloorController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = Floor::orWhereAny([
            'name',
            'number_of_room',
            'room_number_starts',
            'note'
        ], 'like', '%' . $request->q . '%')->get();

        return view('floor.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number_of_room' => 'required',
            'room_number_starts' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            Floor::create([
                'name' => ucwords($request->name),
                'number_of_room' => $request->number_of_room,
                'room_number_starts' => $request->room_number_starts,
                'note' => $request->note,
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
            'number_of_room' => 'required',
            'room_number_starts' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }


        DB::beginTransaction();

        try {
            $item = Floor::where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }

            $item->update([
                'name' => ucwords($request->name),
                'number_of_room' => $request->number_of_room,
                'room_number_starts' => $request->room_number_starts,
                'note' => $request->note,
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
        $item = Floor::where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
