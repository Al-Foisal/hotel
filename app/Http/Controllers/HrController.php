<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class HrController extends Controller
{
    public function index(Request $request){
      
        $owner_id = Auth::user()->id;

        $query = DB::table('employees')
                    ->leftJoin('designations','employees.designation_id','designations.id')
                    ->select('employees.*','designations.name as designation')
                    ->where('employees.owner_id', $owner_id);

        $employee_list = DB::table('employees')
                            ->select('full_name')
                            ->where('owner_id', $owner_id)
                            ->get();

        if ($request->has('q')) {
            $search = '%' . $request->q . '%';
            $query->where(function ($q) use ($search) {
            $q->Where('full_name', 'like', $search);
            });
        }

        $data['items'] = $query->get();

        return view('employee.index', $data, compact('employee_list'));
    }



    public function create()
    {
       
        $owner_id = Auth::user()->id;
        $designations = DB::table('designations')->where('owner_id',$owner_id)->get();

        return view('employee.create', compact('designations'));
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'room_type_id' => 'required',
            'floor_id' => 'required',
            'room_number' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::beginTransaction();

        try {

            $image = null;
            if ($request->hasFile('image')) {
                $file_name = $request->file('image');
                $image = uploadImage('roa', $file_name);
            }

            $data = RoomOrApartmet::create([
                'type' => $request->type,
                'room_type_id' => $request->room_type_id,
                'floor_id' => $request->floor_id,
                'room_number' => $request->room_number,
                'price' => $request->price,
                'capacity' => $request->capacity,
                'diameter' => $request->diameter,
                'wifi_password' => $request->wifi_password,
                'image' => $image,
                'note' => $request->note,
            ]);

            if ($request->facility_id != null) {
                foreach ($request->facility_id as $facility) {
                    RoomOrApartmentFacility::create([
                        'room_or_apartment_id' => $data->id,
                        'facility_id' => $facility
                    ]);
                }
            }
            DB::commit();
            return back()->withToastSuccess('Data created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

}
