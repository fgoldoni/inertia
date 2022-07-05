<?php
namespace Modules\Teams\Observers;

use App\Models\Team;

class TeamObserver
{
    public function creating(Team $team)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('create', $team),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function updating(Team $team)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('update', $team),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function deleting(Team $team)
    {
        abort_if(auth()->user()->cannot('delete', $team), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }

    public function restoring(Team $team)
    {
        abort_if(auth()->user()->cannot('restore', Team::class), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }

    public function forceDeleted(Team $team)
    {
        abort_if(auth()->user()->cannot('forceDelete', Team::class), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }
}
