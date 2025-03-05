<?php

use App\Models\WsAbout;
use App\Models\WsSetup;
use App\Models\WsTestimonial;
use App\Models\Facility;
use App\Models\WsContact;
use App\Models\RoomOrApartmet;
use App\Models\RoomReservation;
use App\Models\RoomReservationDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ws-about', function () {
    return WsAbout::where('status', 1)->get();
});
Route::get('/ws-testimonial', function () {
    return WsTestimonial::where('status', 1)->get();
});
Route::get('/ws-setup', function () {
    return WsSetup::find(1);
});
Route::get('/hotel-facilities', function () {
    return Facility::get();
});
Route::get('/room-or-apartments', function (Request $request) {
        return RoomOrApartmet::where('status', 1)->with('roomCategory')->get();
    
    $from_date=json_encode($request->from_date);
    $to_date=json_encode($request->to_date);
    // return $from_date;
    if(!$from_date && !$to_date){
        return RoomOrApartmet::where('status', 1)->with('roomCategory')->get();
    } else {
        $booked_room=RoomReservation::whereDate('check_in','>=',$from_date)->whereDate('check_out','<=',$form_date)->pluck('id')->toArray();

        $room_id=RoomReservationDetails::whereIn('room_reservation_id',$booked_room)->pluck('room_or_apartment_id')->toArray();
        $rooms=RoomOrApartmet::whereIn('id',$room_id)->get();
        return $rooms;
    }
});
Route::get('/room-or-apartment-details/{id}', function ($id) {
    return RoomOrApartmet::where('status', 1)->where('id',$id)->with('roomCategory','facilities')->first();
});
Route::post('/save-message', function (Request $request) {
    // return $request['name'];
    $item = WsContact::create([
        'name' => $request['name'],
        'phone' => $request['phone'],
        'email' => $request['email'],
        'message' => $request['message'],
    ]);

    return response()->json(['message' => 'Data saved successfully!', 'item' => $item], 200);
});
