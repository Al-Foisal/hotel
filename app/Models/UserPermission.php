<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'permission' => 'json',
        ];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->owner_id = session('owner_id');
        });
    }
}
