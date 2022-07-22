<?php
namespace Modules\Applicants\Notifications;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Applicants\Entities\Applicant;
use Modules\Users\Repositories\Contracts\UsersRepository;

class ApplicantCreatedNotification extends Notification
{
    use Queueable;

    /**
     * @var \Modules\Applicants\Entities\Applicant
     */
    private Applicant $applicant;
    /**
     * @var \App\Models\Team
     */
    private Team $team;


    public function __construct(Applicant $applicant, Team $team)
    {
        $this->applicant = $applicant;
        $this->team = $team;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $token = app()->make(UsersRepository::class)->createToken($notifiable)->plainTextToken;

        $url = $this->url($token);

        return (new MailMessage())
            ->from(env('MAIL_FROM_ADDRESS'), $this->team->display_name)
            ->subject(
                __(
                    'Welcome to the :team! Your application request was successfully created.',
                    ['team' => $this->team->display_name]
                )
            )
            ->view('emails.users.created', ['homeUrl' => $url, 'url' => $url]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    private function url($token): string
    {
        return  env('FRONTEND_HTTP') . $this->team->subdomain . env('FRONTEND_DOMAIN') . '/token/' . $token;
    }
}
