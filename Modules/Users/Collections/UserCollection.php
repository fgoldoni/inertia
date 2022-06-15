<?php


namespace Modules\Users\Collections;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserCollection
 *
 * @package \Modules\Users\Collections
 */
class UserCollection extends Collection
{
    public function groupByLetter()
    {
        return $this->map(fn ($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->profile_photo_url,
        ])->sortBy('name')->groupBy(function($item) {
            return $item['name'][0];
        });
    }
}
