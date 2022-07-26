<?php

namespace App\Scopes;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TeamScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        static::teamGuard();

        if (! auth()->user()->hasRole(config('app.system.users.roles.administrator'))) {
            $builder->where($builder->getQuery()->from.'.team_id', auth()->user()->currentTeam->getKey());
        }
    }

    protected static function teamGuard()
    {
        if (auth()->guest() || ! auth()->user()->currentTeam) {
            dd(auth()->user());
            throw new Exception('No authenticated user with selected team present.');
        }
    }
}
