<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResturantBillingDetails extends Model
{
    protected $guarded = [];

    public function billing()
    {
        return $this->belongsTo(ResturantBilling::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(ResturantMenuItem::class, 'resturant_menu_item_id');
    }
}
