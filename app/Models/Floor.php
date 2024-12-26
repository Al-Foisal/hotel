<?php

namespace App\Models;

use App\Traits\GlobalOwnerIdentityScopeTrait;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
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

    public function roa()
    {
        return $this->hasMany(RoomOrApartmet::class);
    }
}
