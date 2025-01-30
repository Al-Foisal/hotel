<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function create()
    {
        $data = [];
        return view('room-reservation.create', $data);
    }
}
