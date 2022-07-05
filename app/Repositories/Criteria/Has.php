<?php
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Has.
 */
class Has
{
    /**
     * Has constructor.
     *
     * @param $relation
     */
    public function __construct(private $relation)
    {
    }

    /**
     * Check if entity has relation.
     *
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->has($this->relation);
    }
}
