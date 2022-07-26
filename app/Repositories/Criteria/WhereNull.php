<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 20.11.18
 * Time: 17:08.
 */

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class WhereNull.
 */
class WhereNull
{
    /**
     * WhereNull constructor.
     */
    public function __construct(private readonly string $column)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->whereNull($this->column);
    }
}
