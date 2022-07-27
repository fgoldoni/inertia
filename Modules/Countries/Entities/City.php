<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends \Khsing\World\Models\City
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Countries\Database\factories\CityFactory::new();
    }
}
