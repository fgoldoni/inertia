<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole(config('app.system.users.roles.administrator'))) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('browse_teams');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view(User $user, Team $team)
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create_teams');
    }

    public function update(User $user, Team $team)
    {
        return  $user->hasPermissionTo('update_teams') && $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can add team members.
     *
     * @return mixed
     */
    public function addTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can update team member permissions.
     *
     * @return mixed
     */
    public function updateTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     *
     * @return mixed
     */
    public function removeTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    public function delete(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('delete_teams') && $user->ownsTeam($model);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_teams');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_teams');
    }
}
