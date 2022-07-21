<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */
namespace Modules\Categories\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Collection;
use Modules\Categories\Entities\Category;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentCategoriesRepository extends RepositoryAbstract implements CategoriesRepository
{
    public function model(): string
    {
        return Category::class;
    }

    public function industries($columns = ['*']): Collection
    {
        return $this->model->industry()->get($columns);
    }
}
