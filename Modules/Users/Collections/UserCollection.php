<?php

namespace Modules\Users\Collections;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserCollection
 */
class UserCollection extends Collection
{
    public function groupByLetter(): UserCollection|\Illuminate\Support\Collection
    {
        return $this->sortBy('name')->groupBy(fn ($item) => $item['name'][0]);
    }
}
