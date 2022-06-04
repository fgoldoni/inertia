<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 23:02.
 */
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class OrderBy.
 */
class OrderBy implements CriterionInterface
{
    public function __construct(private readonly string $column, private readonly string $dir = 'asc')
    {
    }

    public function apply($model): Builder
    {
        return $model->orderBy($this->column, $this->dir);
    }
}
