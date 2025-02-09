<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    
    public function index(){
        dd('henlo');
    }
    
    
    public function create(){

        // $owner_id = Auth::user()->id;
        $owner_id = Session::get('owner_id');
        $employees = DB::table('employees')
                        ->select('id','full_name')
                        ->where('owner_id', $owner_id)
                        ->get();

        return view('payroll.create',compact('employees'));
    }


    public function payroll_show_data(){
        dd('hi test');
    }
}
