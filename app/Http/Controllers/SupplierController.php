<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SupplierController extends Controller
{
    //
    public function index(Request $request)
    {
        $user_owner_id = Auth::user()->owner_id;

        $supplier = DB::table('suppliers')
            ->where('owner_id',$user_owner_id)
            ->get();
        return view('supplier.index', compact('supplier'));
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
