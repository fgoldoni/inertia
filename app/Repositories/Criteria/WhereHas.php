<?php
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WhereHas.
 */
class WhereHas
{
    /**
     * WhereHas constructor.
     *
     * @param $closure
     */
    public function __construct(private readonly string $relation, private $closure)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->whereHas($this->relation, $this->closure);
    }
}
