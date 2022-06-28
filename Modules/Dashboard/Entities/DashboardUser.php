<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DashboardUser extends Pivot
{
    protected $guarded = [];

    public $incrementing = true;
}
