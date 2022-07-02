<?php
namespace Modules\Users\Observers;

use App\Models\User;

/**
 * Class UsersObserver.
 */
class UserObserver
{
    public function creating(User $user)
    {
        if (auth()->check()) {
            abort_if(auth()->user()->cannot('create', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
        }
    }

    public function updating(User $user)
    {
        if (auth()->check()) {
            abort_if(auth()->user()->cannot('update', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
        }
    }

    public function deleting(User $user)
    {
        abort_if(auth()->user()->cannot('delete', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }

    public function restoring(User $user)
    {
        abort_if(auth()->user()->cannot('restore', User::class), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }

    public function forceDeleted(User $user)
    {
        abort_if(auth()->user()->cannot('forceDelete', User::class), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }
}
