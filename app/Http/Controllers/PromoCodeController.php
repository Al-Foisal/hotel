<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $data = [];
        $roa = PromoCode::orWhereAny([
            'promo_code'
        ], 'like', '%' . $q . '%')
            ->get();

        $data['items'] = $roa;

        return view('promo-code.index', $data);
    }

    public function create()
    {

        return view('promo-code.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'promo_code' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::beginTransaction();

        try {


            $data = PromoCode::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'promo_code' => $request->promo_code,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'discounted_by' => $request->discounted_by,
                'note' => $request->note,
                'status' => $request->status,
                'created_by'=>session('auth_id')
            ]);

            DB::commit();
            return back()->withToastSuccess('Data created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = [];

        $data['item'] = $item = PromoCode::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }
        return view('promo-code.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'promo_code' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        DB::beginTransaction();

        try {

            $data = PromoCode::where('id', $id)->first();
            if (!$data) {
                return back()->withToastError('No data found');
            }


            $data->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'promo_code' => $request->promo_code,
                'discount' => $request->discount,
                'discount_type' => $request->discount_type,
                'discounted_by' => $request->discounted_by,
                'note' => $request->note,
                'status' => $request->status,
            ]);


            DB::commit();
            return to_route('promoCode.index')->withToastSuccess('Data created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function status(Request $request, $id)
    {
        $item = PromoCode::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }

        $item->status = $item->status == 'Active'?'Inactive':'Active';
        $item->save();
        return back()->withToastSuccess('Status updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $data = PromoCode::where('id', $id)->first();
        if (!$data) {
            return back()->withToastError('No data found');
        }

        $data->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
