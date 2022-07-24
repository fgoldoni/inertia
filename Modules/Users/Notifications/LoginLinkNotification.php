<?php
namespace Modules\Users\Notifications;

use App\Models\Team;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\NewAccessToken;

class LoginLinkNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Team $team,
        private readonly User $user,
        private readonly NewAccessToken $token,
        private readonly string $host
    ) {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = $this->host . '/token/' . $this->token->plainTextToken;

        return (new MailMessage())
            ->subject('Welcome to ' . env('APP_NAME', 'Wedo 37'))
            ->view('emails.users.created', ['homeUrl' => $this->host, 'team' => $this->team, 'url' => $url]);
    }
}
