<?php

namespace Modules\Companies\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Companies\Entities\Company;
use Modules\Companies\Notifications\CompanyCreatedNotification;
use Modules\Companies\Notifications\CompanyDeletedNotification;
use Modules\Companies\Notifications\CompanyRestoredNotification;

class CompaniesSubscriber
{
    public function __construct(private readonly Company $company)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: '.Company::class, $this->handleCompanyCreated(...));
        $events->listen('eloquent.deleting: '.Company::class, $this->handleCompanyDeleted(...));
        $events->listen('eloquent.restored: '.Company::class, $this->handleCompanyRestored(...));
    }

    public function handleCompanyCreated(Company $company)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CompanyCreatedNotification($company));
    }

    public function handleCompanyDeleted(Company $company)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CompanyDeletedNotification($company));
    }

    public function handleCompanyRestored(Company $company)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CompanyRestoredNotification($company));
    }

    public function fetchByRole(string $role)
    {
        return User::role($role)->get();
    }
}
