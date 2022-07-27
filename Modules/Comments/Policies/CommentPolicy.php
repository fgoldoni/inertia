<?php

namespace Modules\Comments\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Comments\Entities\Comment;

class CommentPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole(config('app.system.users.roles.administrator'))) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('browse_comments');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_comments');
    }

    public function update(User $user, Comment $model = null): bool
    {
        return $user->hasPermissionTo('update_comments') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function edit(User $user, Comment $model): bool
    {
        return $user->hasPermissionTo('edit_comments') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function delete(User $user, Comment $model): bool
    {
        return $user->hasPermissionTo('delete_comments') && ((int) $user->currentTeam->id === (int) $model->team_id);
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo('force_delete_comments');
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo('restore_comments');
    }
}
