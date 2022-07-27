<?php

namespace Modules\Applicants\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Applicants\Entities\Applicant;

class ApplicantPolicy
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
        return $user->hasPermissionTo('create_applicants');
    }

    public function update(User $user, Applicant $model = null): bool
    {
        return $user->hasPermissionTo('update_applicants')
            && ((int) $user->currentTeam->id === (int) $model->job->team_id);
    }

    public function edit(User $user, Applicant $model): bool
    {
        return $user->hasPermissionTo('edit_applicants')
            && ((int) $user->currentTeam->id === (int) $model->job->team_id);
    }

    public function delete(User $user, Applicant $model): bool
    {
        return $user->hasPermissionTo('delete_applicants')
            && ((int) $user->currentTeam->id === (int) $model->job->team_id);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_applicants');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_applicants');
    }
}
