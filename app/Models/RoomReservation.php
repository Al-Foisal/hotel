<?php

namespace App\Models;

use App\Traits\GlobalOwnerIdentityScopeTrait;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    use GlobalOwnerIdentityScopeTrait;

    protected $guarded = [];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = session('auth_id');
            $model->owner_id = session('owner_id');
        });

        self::updating(function ($model) {
            $model->updated_by = session('auth_id');
        });
    }

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function rooms(){
        return $this->hasMany(RoomReservationDetails::class);
    }

    public function roomPersonDetails(){
        return $this->hasMany(RoomReservationOtherPersonDetails::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
