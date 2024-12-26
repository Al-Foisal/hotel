<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Floor;
use App\Models\RoomOrApartmentFacility;
use App\Models\RoomOrApartmet;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomOrApartmentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $data = [];
        $roa = Floor::query();
        if (!isOperator()) {
            if ($q) {
                $roa = $roa
                    ->orWhereAny([
                        'name'
                    ], 'like', '%' . $q . '%')
                    ->orWhereHas('roa', function ($query) use ($q) {
                        $query->whereAny([
                            'type',
                            'room_number',
                            'price',
                            'capacity',
                            'diameter',
                            'wifi_password',
                            'note',
                        ], 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('roa.facilities.facility', function ($query) use ($q) {
                        $query->whereAny([
                            'name',
                        ], 'like', '%' . $q . '%');
                    })
                    ->get();
            } else {
                $roa = $roa->get();
            }
        } else {
            if ($q) {
                $roa = $roa
                    ->where('status', 1)
                    ->orWhereAny([
                        'name'
                    ], 'like', '%' . $q . '%')
                    ->orWhereHas('roa', function ($query) use ($q) {
                        $query->whereAny([
                            'type',
                            'room_number',
                            'price',
                            'capacity',
                            'diameter',
                            'wifi_password',
                            'note',
                        ], 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('roa.facilities.facility', function ($query) use ($q) {
                        $query->whereAny([
                            'name',
                        ], 'like', '%' . $q . '%');
                    })
                    ->get();
            } else {
                $roa = $roa->where('status', 1)->get();
            }
        }

        $data['roa'] = $roa;

        return view('roa.index', $data);
    }

    public function create()
    {
        $data = [];
        $data['facility'] = Facility::orderBy('name', 'asc')->get();
        $data['room_type'] = RoomType::orderBy('name', 'asc')->get();
        $data['floor'] = Floor::orderBy('name', 'asc')->get();

        return view('roa.create', $data);
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

    public function edit($id)
    {
        $data = [];

        $item = RoomOrApartmet::where('id', $id)->first();
        if (!$item) {
            return back()->withToastError('No data found');
        }
        $data['item'] = $item;
        $data['facility'] = Facility::orderBy('name', 'asc')->get();
        $data['room_type'] = RoomType::orderBy('name', 'asc')->get();
        $data['floor'] = Floor::orderBy('name', 'asc')->get();



        return view('roa.edit', $data);
    }

    public function update(Request $request, $id)
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

            $data = RoomOrApartmet::where('id', $id)->first();
            if (!$data) {
                return back()->withToastError('No data found');
            }
            $image = null;
            if ($request->hasFile('image')) {
                $file_name = $request->file('image');
                $image = uploadImage('roa', $file_name);
            }

            if ($request->hasFile('image')) {
                $data->update(['image' => $image]);
            }

            $data->update([
                'type' => $request->type,
                'room_type_id' => $request->room_type_id,
                'floor_id' => $request->floor_id,
                'room_number' => $request->room_number,
                'price' => $request->price,
                'capacity' => $request->capacity,
                'diameter' => $request->diameter,
                'wifi_password' => $request->wifi_password,
                'note' => $request->note,
            ]);

            $data->facilities()->delete();

            if ($request->facility_id != null) {
                foreach ($request->facility_id as $facility) {
                    if ($facility) {
                        RoomOrApartmentFacility::create([
                            'room_or_apartment_id' => $data->id,
                            'facility_id' => $facility
                        ]);
                    }
                }
            }
            DB::commit();
            return to_route('rrs.roa.index')->withToastSuccess('Data created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withToastError($th->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        $data = RoomOrApartmet::where('id', $id)->first();
        if (!$data) {
            return back()->withToastError('No data found');
        }
        $data->facilities()->delete();
        $data->delete();
        return back()->withToastSuccess('Data deleted successfully');
    }
}
