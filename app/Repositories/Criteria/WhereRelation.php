<?php


namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class whereRelation
 *
 * @package \App\Repositories\Criteria
 */
class WhereRelation
{
    public function __construct(private readonly string $relation, private string $column, private string $op, private string $value)
    {
    }

    public function apply($model): Builder
    {
        return $model->whereRelation($this->relation, $this->column, $this->op, $this->value);
    }

}
