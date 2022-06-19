<?php

namespace Modules\Companies\Entities;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Categories\Enums\CategoryType;
use Modules\Companies\Database\factories\CompanyFactory;
use Modules\Jobs\Entities\Job;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use HasFactory, HasSlug, BelongsToUser, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'online' => 'boolean',
    ];

    protected static function newFactory(): CompanyFactory
    {
        return CompanyFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
