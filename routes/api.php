<?php

use App\Models\WsAbout;
use App\Models\WsSetup;
use App\Models\WsTestimonial;
use App\Models\Facility;
use App\Models\WsContact;
use App\Models\RoomOrApartmet;
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
Route::get('/room-or-apartments', function () {
    return RoomOrApartmet::where('status', 1)->with('roomType')->get();
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
