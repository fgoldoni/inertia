<?php

/**
 * Created by PhpStorm.
 * User: Goldoni
 * Date: 10/11/2018
 * Time: 02:14.
 */
namespace Modules\Tags\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Modules\Tags\Entities\Tag;

/**
 * Class TaggableTrait.
 */
trait TaggableTrait
{

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function saveTags($tags): self
    {
        $tags = array_filter(
            array_unique(
                array_map(
                    fn($item) => trim((string)$item),
                    $tags
                )
            ),
            fn($item) => !empty($item)
        );

        $persistedTags = Tag::whereIn('name', $tags)->get();
        $tagsToCreate = array_diff($tags, $persistedTags->pluck('name')->all());
        $tagsToCreate = array_map(fn($tag) => ['name' => $tag, 'slug' => Str::slug($tag)], $tagsToCreate);

        $createdTags = $this->tags()->createMany($tagsToCreate);
        $persistedTags = $persistedTags->merge($createdTags);
        $this->tags()->sync($persistedTags);

        return $this;
    }
}
