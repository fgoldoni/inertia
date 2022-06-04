<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 22:40.
 */
namespace App\Repositories\Criteria;

use App\Flag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class ByUser.
 */
class ByUser implements CriterionInterface
{
    /**
     * ByUser constructor.
     */
    public function __construct(private readonly int $userId)
    {
    }

    /**
     * @param $model
     */
    public function apply($model): Builder
    {
        if (Auth::user()->hasPermissionTo(Flag::PERMISSION_ADMIN)) {
            return $model->newQuery();
        }

        return $model->where('user_id', $this->userId);
    }
}
