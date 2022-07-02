<?php
namespace Modules\Jobs\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Jobs\Entities\Job;

class JobPolicy
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

    public function update(User $user, Job $model = null): bool
    {
        return $user->hasPermissionTo('update_jobs') && ((int)$user->id === (int)$model->user_id);
    }

    public function edit(User $user, Job $model): bool
    {
        return $user->hasPermissionTo('edit_jobs') && ((int) $user->id === (int) $model->user_id);
    }

    public function delete(User $user, Job $model): bool
    {
        return $user->hasPermissionTo('delete_jobs') && ((int) $user->id === (int) $model->user_id);
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
