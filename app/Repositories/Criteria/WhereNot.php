<?php


namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WhereNot
 *
 * @package \App\Repositories\Criteria
 */
class WhereNot
{
    /**
     * Where constructor.
     */
    public function __construct(private readonly string $column, private readonly string $value) {}


    public function apply($model): Builder
    {
        return $model->when($this->value, fn ($query, $value) => $query->whereNot($this->column, $this->value));
    }
}
