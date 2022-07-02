<?php
namespace Modules\Jobs\Observers;

use Modules\Jobs\Entities\Job;

class JobObserver
{
    public function creating(Job $job)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('create', $job),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function updating(Job $job)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('update', $job),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function deleting(Job $job)
    {
        abort_if(auth()->user()->cannot('delete', $job), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }

    public function restoring(Job $job)
    {
        abort_if(auth()->user()->cannot('restore', Job::class), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }

    public function forceDeleted(Job $job)
    {
        abort_if(auth()->user()->cannot('forceDelete', Job::class), 403, 'The user does not have the right permissions to perform an action. Please contact your Support');
    }
}
