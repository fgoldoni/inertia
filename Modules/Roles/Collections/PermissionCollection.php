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
        return $this->map(fn($permission) => [
            'id' => $permission->id,
            'name' => $permission->name,
            'display_name' => $permission->display_name,
            'group_name' => $permission->group_name,
            'can_be_removed' => $permission->can_be_removed,
            'created_at' => $permission->created_at?->formatLocalized('%b %d'),
        ])->groupBy('group_name');
    }
}
