<?php
namespace Modules\Users\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreatedNotification extends Notification
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
            'title' => 'New User',
            'msg' => 'User ' . $this->user->name . ' has been successfully created',
            'url' => '#',
            'icon' => 'GiftIcon',
            'time' => $this->user->created_at->format('c'),
            'category' => 'primary',
        ];
    }
}
