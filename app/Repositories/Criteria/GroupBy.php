<?php


namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class GroupBy
 *
 * @package \App\Repositories\Criteria
 */
class GroupBy
{

    public function __construct(private ?string $column = null)
    {
    }

    public function apply($model): Builder
    {
        return $model->when($this->column, fn ($query) => $query->groupBy($this->column));
    }
}