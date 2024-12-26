<?php

namespace App\Models;

use App\Traits\GlobalOwnerIdentityScopeTrait;
use Illuminate\Database\Eloquent\Model;

class RoomOrApartmentFacility extends Model
{
    use GlobalOwnerIdentityScopeTrait;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->owner_id = session('owner_id');
        });
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
