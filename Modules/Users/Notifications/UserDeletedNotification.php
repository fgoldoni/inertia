<?php
namespace Modules\Users\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserDeletedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly User $user)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        if ($this->user?->isForceDeleting()) {
            return [
                'title' => 'Delete User Permanently',
                'msg' => 'User ' . $this->user?->name . ' has been deleted permanently by ' . auth()->user()?->name,
                'url' => '#',
                'icon' => 'InfoIcon',
                'time' => $this->user?->created_at->format('c'),
                'category' => 'danger',
            ];
        }

        return [
            'title' => 'Delete User',
            'msg' => 'User ' . $this->user?->name . ' has been Deleted by ' . auth()->user()?->name,
            'url' => '#',
            'icon' => 'InfoIcon',
            'time' => $this->user?->created_at->format('c'),
            'category' => 'warning',
        ];
    }
}
