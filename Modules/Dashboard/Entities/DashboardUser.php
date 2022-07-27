<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DashboardUser extends Pivot
{
    protected $guarded = [];

    public $incrementing = true;

    protected $appends = [
        'i',
    ];

    public function getIAttribute()
    {
        return $this->id;
    }
}
