<?php

namespace App\Traits;

use App\Models\Scopes\OwnerIdentityScope;

trait GlobalOwnerIdentityScopeTrait
{
    protected static function booted(): void
    {
        static::addGlobalScope(new OwnerIdentityScope);
    }
}
