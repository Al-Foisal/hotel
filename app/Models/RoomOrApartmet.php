<?php

namespace App\Models;

use App\Traits\GlobalOwnerIdentityScopeTrait;
use Illuminate\Database\Eloquent\Model;

class RoomOrApartmet extends Model
{
    //use GlobalOwnerIdentityScopeTrait;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->owner_id = session('owner_id');
        });
    }
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function facilities()
    {
        return $this->hasMany(RoomOrApartmentFacility::class, 'room_or_apartment_id', 'id');
    }
}
