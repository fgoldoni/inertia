<?php
namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Categories\Builders\CategoryBuilder;
use Modules\Categories\Database\factories\CategoryFactory;
use Modules\Categories\Enums\CategoryType;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory, HasSlug, HasTranslations, HasRecursiveRelationships;

    protected $guarded = [];

    public array $translatable = ['name'];

    protected $casts = [
        'slug' => 'string',
        'online' => 'boolean',
        'deleted_at' => 'datetime',
        'type' => CategoryType::class,
    ];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function entries(string $class): MorphToMany
    {
        return $this->morphedByMany($class, 'categorizable', 'categorizables', 'category_id', 'categorizable_id', 'id', 'id');
    }

    public function getSlugOptions() : SlugOptions
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

    protected static function boot()
    {
        parent::boot();

        Category::creating(function ($model) {
            $model->position = Category::max('position') + 1;
        });
    }

    public function newEloquentBuilder($query): Builder
    {
        return new CategoryBuilder($query);
    }
}
