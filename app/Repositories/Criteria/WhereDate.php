<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 17.11.18
 * Time: 23:53.
 */
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WhereDate.
 */
class WhereDate
{
    /**
     * WhereDate constructor.
     *
     * @param $value
     */
    public function __construct(private readonly string $column, private readonly string $op, private $value)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->whereDate($this->column, $this->op, $this->value);
    }
}
