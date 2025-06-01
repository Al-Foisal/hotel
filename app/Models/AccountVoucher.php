<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountVoucher extends Model
{
    protected $guarded = [];

    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class, 'account_category_id');
    }
}
