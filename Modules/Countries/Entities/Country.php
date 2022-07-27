<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends \Khsing\World\Models\Country
{
    use HasFactory;

    protected $fillable = ['name'];
}
