<?php
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WhereIn.
 */
class WhereIn
{
    public function __construct(private readonly string $column, private readonly ?array $values = null)
    {
    }

    public function apply($model): Builder
    {
        return null === $this->values ? $model->newQuery() : $model->whereIn($this->column, $this->values);
    }
}
