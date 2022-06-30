<?php
namespace Modules\Users\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserDeletedEvent extends Notification
{
    use Queueable;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        if ($this->user?->isForceDeleting()) {
            return [
                'title'    => 'Delete User Permanently',
                'msg'      => 'Event ' . $this->user?->name . ' has been deleted permanently by ' . auth()->user()?->name,
                'url'      => '#',
                'icon'     => 'InfoIcon',
                'time'     => $this->user?->created_at->format('c'),
                'category' => 'danger',
            ];
        }

        return [
            'title'    => 'Delete User',
            'msg'      => 'User ' . $this->user?->name . ' has been Deleted by ' . auth()->user()?->name,
            'url'      => '#',
            'icon'     => 'InfoIcon',
            'time'     => $this->user?->created_at->format('c'),
            'category' => 'warning',
        ];
    }
}
