<?php
namespace Modules\Roles\Entities;

use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            Cache::forget(config('gjob.system.cache.keys.roles'));
        });
    }

    public function isAdministrator(): bool
    {
        return $this->name === config('gjob.system.users.roles.administrator');
    }
}
