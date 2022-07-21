<?php
namespace Modules\Categories\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CategoriesRepository
{
    public function industries($columns = ['*']): Collection;
}
