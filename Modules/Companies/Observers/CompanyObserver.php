<?php

namespace Modules\Companies\Observers;

use Modules\Companies\Entities\Company;

class CompanyObserver
{
    public function creating(Company $company)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('create', $company),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function updating(Company $company)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('update', $company),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function deleting(Company $company)
    {
        abort_if(
            auth()->user()->cannot('delete', $company),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function restoring(Company $company)
    {
        abort_if(
            auth()->user()->cannot('restore', Company::class),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function forceDeleted(Company $company)
    {
        abort_if(
            auth()->user()->cannot('forceDelete', Company::class),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }
}
