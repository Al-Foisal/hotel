<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Validator;


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
            'full_name' => 'required',
            'designation_id' => 'required',
            'joining_date' => 'required',
            'monthly_salary' => 'required',
            'emergency_contact_name_one' => 'required',
            'emergency_contact_number_one' => 'required',
            'emergency_contact_relation_one' => 'required',
            'emergency_contact_name_two' => 'required',
            'emergency_contact_number_two' => 'required',
            'emergency_contact_relation_two' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::beginTransaction();
        try {

            $image = null;
            if ($request->hasFile('image')) {
                $file_name = $request->file('image');
                $image = uploadImage('emp', $file_name);
            }

            $owner_id = Auth::user()->id;
            $employee = DB::table('employees')
                                ->insertGetId([
                                'owner_id'=>$owner_id,
                                'designation_id'=>$request->designation_id,
                                'joining_date'=>$request->joining_date,
                                'monthly_salary'=>$request->monthly_salary,
                                'profile_pic'=>$image,
                                'full_name'=>ucwords($request->full_name),
                                'father_name'=>ucwords($request->father_name),
                                'mother_name'=>ucwords($request->mother_name),
                                'mobile_number'=>$request->mobile_number,
                                'nid_number'=>$request->nid_number,
                                'present_address'=>$request->present_address,
                                'permanent_address'=>$request->permanent_address,
                                'birth_date'=>$request->birth_date,
                                'blood_group'=>$request->blood_group,
                                'nationality'=>$request->nationality,
                                'marital_status'=>$request->marital_status,
                                'religion'=>$request->religion,
                                'gender'=>$request->gender,
                                'emergency_contact_name_one'=>ucwords($request->emergency_contact_name_one),
                                'emergency_contact_number_one'=>$request->emergency_contact_number_one,
                                'emergency_contact_relation_one'=>$request->emergency_contact_relation_one,
                                'emergency_contact_name_two'=>ucwords($request->emergency_contact_name_two),
                                'emergency_contact_number_two'=>$request->emergency_contact_number_two,
                                'emergency_contact_relation_two'=>$request->emergency_contact_relation_two,
                                'emergency_contact_name_three'=>ucwords($request->emergency_contact_name_three),
                                'emergency_contact_number_three'=>$request->emergency_contact_number_three,
                                'emergency_contact_relation_three'=>$request->emergency_contact_relation_three
                                ]);

            DB::commit();
            return back()->withToastSuccess('Data created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

}
