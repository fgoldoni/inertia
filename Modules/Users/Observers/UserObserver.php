<?php
namespace Modules\Users\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersObserver.
 */
class UserObserver
{
    public function creating(User $user)
    {
        if (Auth::check()) {
            abort_if(Auth::user()->cannot('create', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
        }
    }

    public function updating(User $user)
    {
        abort_if(Auth::user()->cannot('update', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }

    public function deleting(User $user)
    {
        abort_if(Auth::user()->cannot('delete', $user), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }

    public function restoring(User $user)
    {
        abort_if(Auth::user()->cannot('restore', User::class), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }

    public function forceDeleted(User $user)
    {
        abort_if(Auth::user()->cannot('forceDelete', User::class), 403, 'Forbidden. The user is authenticated, but does not have the permissions to perform an action. Please contact your Support');
    }
}
