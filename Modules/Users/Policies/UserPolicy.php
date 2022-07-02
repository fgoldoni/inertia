<?php
namespace Modules\Users\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->hasPermissionTo('create_users');
    }

    public function update(User $user, User $model = null): bool
    {
        return ($user->hasPermissionTo('update_users')
            && !$model->hasRole(config('app.system.users.roles.administrator')))
            || ((int) $user->id === (int) $model->id);
    }

    public function edit(User $user, User $model): bool
    {
        return $user->hasPermissionTo('edit_users') || ((int) $user->id === (int) $model->id);
    }

    public function delete(User $user, User $model): bool
    {
        return ($user->hasPermissionTo('delete_users')
                && !$model->hasRole(config('app.system.users.roles.administrator')))
            || ((int) $user->id === (int) $model->id);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_users');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_users');
    }
}
