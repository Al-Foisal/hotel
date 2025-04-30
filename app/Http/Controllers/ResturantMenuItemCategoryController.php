<?php

namespace App\Http\Controllers;

use App\Models\ResturantMenuItemCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResturantMenuItemCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['items'] = ResturantMenuItemCategory::orWhereAny([
            'name',
        ], 'like', '%' . $request->q . '%')->get();

        return view('resturant.menu-item-category.index', $data);
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
            $user = ResturantMenuItemCategory::create([
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
            $item = ResturantMenuItemCategory::where('id', $id)->first();
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
    public function delete(Request $request, $id)
    {
        $item = ResturantMenuItemCategory::where('id', $id)->first();
        if (!$item || $item->owner_id == $item->id) {
            return back()->withToastError('No data found');
        }

        $item->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
    
}
