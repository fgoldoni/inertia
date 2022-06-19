<?php

namespace Modules\Jobs\Entities;

use App\Models\Company;
use App\Traits\BelongsToUser;
use App\Traits\Categorizable;
use App\Traits\HasAvatar;
use App\Traits\HasTeams;
use App\Traits\JobAttribute;
use App\Traits\WithinDays;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Modules\Countries\Entities\Division;
use Modules\Jobs\Database\factories\JobFactory;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Job extends Model
{
    use HasFactory, HasSlug, HasTranslations, Categorizable, BelongsToUser, SoftDeletes, WithinDays, JobAttribute;


    protected $guarded = [];

    public array $translatable = ['name'];

    protected static function newFactory(): JobFactory
    {
        return JobFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function toArray(): array
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withDefault();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->withDefault(['name' => '']);
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class)->withDefault(['name' => '']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->withDefault(['name' => '']);
    }

}
