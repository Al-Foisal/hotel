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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
