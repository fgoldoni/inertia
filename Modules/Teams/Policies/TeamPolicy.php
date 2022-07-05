<?php
namespace Modules\Teams\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Teams\Entities\Team;

class TeamPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole(config('app.system.users.roles.administrator'))) {
            return true;
        }
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_jobs');
    }

    public function update(User $user, Team $model = null): bool
    {
        return $user->hasPermissionTo('update_jobs') && ((int)$user->currentTeam->id === (int)$model->team_id);
    }

    public function edit(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('edit_jobs') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function delete(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('delete_jobs') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_jobs');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_jobs');
    }
}
