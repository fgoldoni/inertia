<?php
namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends \Khsing\World\Models\Division
{
    use HasFactory;

    protected $fillable = ['name'];
}
