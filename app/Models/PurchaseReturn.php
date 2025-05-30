<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function returnDetails()
    {
        return $this->hasMany(PurchaseReturn::class);
    }
}
