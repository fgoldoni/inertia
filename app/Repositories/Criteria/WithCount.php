<?php
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WithCount.
 */
class WithCount
{
    /**
     * WithCount constructor.
     */
    public function __construct(private readonly string $relations)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->withCount($this->relations);
    }
}
