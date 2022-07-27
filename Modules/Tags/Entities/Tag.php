<?php

namespace Modules\Tags\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Jobs\Entities\Job;
use Modules\Tags\Database\factories\TagFactory;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class);
    }
}
