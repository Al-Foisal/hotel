<?php

namespace App\Http\Controllers;

use App\Models\RoomOrApartmet;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function create()
    {
        $data = [];
        $data['room_type'] = RoomType::get();
        return view('room-reservation.create', $data);
    }
    public function store(Request $request)
    {
        dd($request->all());
    }

    public function getROAByType(Request $request)
    {
        $data = RoomOrApartmet::where('type', $request->type)->with('roomType')->get();
        return $data;
    }
    public function getSingleRoomDetails(Request $request)
    {
        $data = RoomOrApartmet::where('id', $request->roomId)->first();
        return $data;
    }
}
