<?php
namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorizable extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categorizable()
    {
        return $this->morphTo();
    }
}
