<?php

namespace Modules\Users\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRestoredNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly User $user)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Restore User',
            'msg' => 'User '.$this->user->name.' has been successfully restored',
            'url' => '#',
            'icon' => 'CheckCircleIcon',
            'time' => $this->user->created_at->format('c'),
            'category' => 'primary',
        ];
    }
}
