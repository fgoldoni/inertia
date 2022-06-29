<?php
namespace Modules\Users\Notifications;

use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminSendCredentials extends Notification
{
    use Queueable;

    public function __construct(public string $password)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(__('Welcome to GJob'))
            ->greeting("Hello {$notifiable->name}")
            ->line(__('An account has been created for you as Administrator on the website: ') . url('/'))
            ->line("Email: {$notifiable->email} - Password: {$this->password}")
            ->line(__('You can use the following link to login:'))
            ->action('Login', PasswordlessLogin::forUser($notifiable)->generate())
            ->line(__('After logging in you need to change your password by clicking on your name in the upper right corner of the admin area'));
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
}
