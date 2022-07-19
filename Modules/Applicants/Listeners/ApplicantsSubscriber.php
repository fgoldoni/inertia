<?php
namespace Modules\Applicants\Listeners;

use App\Models\User;
use Modules\Applicants\Entities\Applicant;
use Illuminate\Support\Facades\Notification;
use Modules\Applicants\Notifications\ApplicantCreatedNotification;
use Modules\Applicants\Notifications\ApplicantDeletedNotification;
use Modules\Applicants\Notifications\ApplicantRestoredNotification;

class ApplicantsSubscriber
{
    public function __construct(private readonly Applicant $applicant)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Applicant::class, $this->handleApplicantCreated(...));
        $events->listen('eloquent.deleting: ' . Applicant::class, $this->handleApplicantDeleted(...));
        $events->listen('eloquent.restored: ' . Applicant::class, $this->handleApplicantRestored(...));
    }

    public function handleApplicantCreated(Applicant $applicant)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new ApplicantCreatedNotification($applicant));
    }

    public function handleApplicantDeleted(Applicant $applicant)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new ApplicantDeletedNotification($applicant));
    }

    public function handleApplicantRestored(Applicant $applicant)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new ApplicantRestoredNotification($applicant));
    }

    public function fetchByRole(string $role)
    {
        return User::role($role)->get();
    }
}
