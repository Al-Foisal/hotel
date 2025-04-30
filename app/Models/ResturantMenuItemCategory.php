<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResturantMenuItemCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function menuItems()
    {
        return $this->hasMany(ResturantMenuItem::class, 'resturant_menu_item_category_id', 'id');
    }
}
