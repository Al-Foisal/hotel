<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResturantBilling extends Model
{
    protected $guarded = [];

    public function itemDetails()
    {
        return $this->hasMany(ResturantBillingDetails::class);
    }
    public function table()
    {
        return $this->belongsTo(ResturantTableSetup::class, 'table_id', 'id');
    }
    public function roomOrApartment()
    {
        return $this->belongsTo(RoomOrApartmet::class, 'room_or_apartment_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
