<?php
namespace Modules\Companies\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Companies\Entities\Company;

class CompanyPolicy
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
        return $user->hasPermissionTo('create_companies');
    }

    public function update(User $user, Company $model = null): bool
    {
        return $user->hasPermissionTo('update_companies') && ((int)$user->currentTeam->id === (int)$model->team_id);
    }

    public function edit(User $user, Company $model): bool
    {
        return $user->hasPermissionTo('edit_companies') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function delete(User $user, Company $model): bool
    {
        return $user->hasPermissionTo('delete_companies') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_companies');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_companies');
    }
}
