<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function index(Request $request){
      
        $owner_id = Auth::user()->id;
        $query = DB::table('designations')->where('owner_id', $owner_id);

        if ($request->has('q')) {
            $search = '%' . $request->q . '%';
            $query->where(function ($q) use ($search) {
            $q->Where('name', 'like', $search);
            });
        }

        $data['items'] = $query->get();

        return view('designation.index', $data);
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
            $owner_id = Auth::user()->id;
            $designation = DB::table('designations')
                                ->insertGetId([
                                'owner_id'=>$owner_id,
                                'name'=>ucwords($request->name)
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
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::beginTransaction();
        try {
            $item = DB::table('designations')->where('id', $id)->first();
            if (!$item) {
                return back()->withToastError('No data found');
            }

            $updated = DB::table('designations')
                        ->where('id', $id)
                        ->update(['name'=> ucwords($request->name)]);

            DB::commit();
            return back()->withToastSuccess('Data updated successfully');
        } catch (Exception $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }


    public function delete(Request $request, $id)
    {
        $item = DB::table('designations')->where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        DB::table('designations')->where('id', $id)->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
