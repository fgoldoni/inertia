<?php

namespace Modules\Applicants\Notifications;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Applicants\Entities\Applicant;
use Modules\Users\Repositories\Contracts\UsersRepository;

class ApplicantCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Applicant $applicant, private readonly Team $team)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $token = app()->make(UsersRepository::class)->createToken($notifiable)->plainTextToken;

        [$homeUrl, $url] = $this->urls($token);

        return (new MailMessage())
            ->from(env('MAIL_FROM_ADDRESS'), $this->team->display_name)
            ->subject(
                __(
                    'Welcome to :team! Your application request was successfully created.',
                    ['team' => $this->team->display_name]
                )
            )
            ->view('emails.applicants.created', [
                'team' => $this->team, 'applicant' => $this->applicant, 'homeUrl' => $homeUrl, 'url' => $url,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    private function urls(string $token): array
    {
        $baseUrl = $this->url($token);

        $homeUrl = $baseUrl.'/token/'.$token;

        $to = $baseUrl.'/applicants/'.$this->applicant->id;

        $url = $homeUrl.'?'.http_build_query(['to' => $to]);

        return [$homeUrl, $url];
    }

    private function url($token): string
    {
        return  env('FRONTEND_HTTP').$this->team->subdomain.env('FRONTEND_DOMAIN');
    }
}
