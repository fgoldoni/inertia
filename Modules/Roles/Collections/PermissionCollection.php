<?php
namespace Modules\Roles\Collections;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class PermissionCollection
 *
 * @package \Modules\Roles\Collections
 */
class PermissionCollection extends Collection
{
    public function groupByName()
    {
        return $this->groupBy('group_name');
    }
}
