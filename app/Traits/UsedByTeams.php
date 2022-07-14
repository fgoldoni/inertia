<?php
namespace App\Traits;

use App\Models\Team;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait UsedByTeams
{
    protected static function bootUsedByTeams()
    {
        static::addGlobalScope('team', function (Builder $builder) {
            static::teamGuard();

            if (!auth()->user()?->hasRole(config('app.system.users.roles.administrator'))) {
                $builder->where(
                    $builder->getQuery()->from . '.team_id',
                    session()->get('team-id', auth()->user()?->currentTeam->getKey())
                );
            }
        });

        static::saving(function (Model $model) {
            if (!isset($model->team_id)) {
                static::teamGuard();

                $model->team_id = session()->get('team-id', auth()->user()->currentTeam->getKey());
            }
        });
    }

    public function scopeAllTeams(Builder $query): Builder
    {
        return $query->withoutGlobalScope('team');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    protected static function teamGuard()
    {
        if ((auth()->guest() || !auth()->user()?->currentTeam) && !session()->has('team-id')) {
            throw new Exception('No authenticated user with selected team present.');
        }
    }
}
