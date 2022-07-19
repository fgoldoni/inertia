<?php
namespace Modules\Applicants\Observers;

use Modules\Applicants\Entities\Applicant;

class ApplicantObserver
{
    public function creating(Applicant $applicant)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('create', $applicant),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function updating(Applicant $applicant)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('update', $applicant),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function deleting(Applicant $applicant)
    {
        abort_if(
            auth()->user()->cannot('delete', $applicant),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function restoring(Applicant $applicant)
    {
        abort_if(
            auth()->user()->cannot('restore', Applicant::class),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function forceDeleted(Applicant $applicant)
    {
        abort_if(
            auth()->user()->cannot('forceDelete', Applicant::class),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }
}
