<?php

namespace App\Services;

use App\Repositories\RepositoryAbstract;
use App\Services\Contracts\ServiceInterface;

/**
 * Class ServiceAbstract.
 */
abstract class ServiceAbstract implements ServiceInterface
{
    protected $repository;

    public function __construct()
    {
        $this->repository = $this->resolveRepository();
    }


    abstract protected function repository();

    protected function resolveRepository()
    {
        $repository = app()->make($this->repository());

        if (!$repository instanceof RepositoryAbstract) {
            throw new Exception("Class {$this->repository()} must be an instance of App\\Repositories\\RepositoryAbstract");
        }

        return $repository;
    }
}
