<?php

use App\Models\WsAbout;
use App\Models\WsSetup;
use App\Models\WsTestimonial;
use App\Models\Facility;
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
Route::get('/hotel-facilities',function(){
    return Facility::get();
});
Route::get('/room-or-apartments',function(){
    return RoomOrApartmet::where('status',1)->with('roomType')->get();
});