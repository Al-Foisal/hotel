<?php

namespace App\Models;

use App\Traits\GlobalOwnerIdentityScopeTrait;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use GlobalOwnerIdentityScopeTrait;
    protected $guarded=[];
}
