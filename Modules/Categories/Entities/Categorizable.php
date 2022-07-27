<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorizable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categorizable()
    {
        return $this->morphTo();
    }
}
