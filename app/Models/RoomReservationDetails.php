<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomReservationDetails extends Model
{
    protected $guarded = [];

    public function singleRoom()
    {
        return $this->belongsTo(RoomOrApartmet::class, 'room_or_apartment_id', 'id');
    }
}
