<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 18.11.18
 * Time: 15:17.
 */
namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Where.
 */
class Where
{
    /**
     * Where constructor.
     */
    public function __construct(private readonly string $column, private readonly string $value)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        return $model->where($this->column, $this->value);
    }
}
