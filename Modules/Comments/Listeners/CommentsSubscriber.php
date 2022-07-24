<?php

namespace Modules\Comments\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Notifications\CommentCreatedNotification;
use Modules\Comments\Notifications\CommentDeletedNotification;
use Modules\Comments\Notifications\CommentRestoredNotification;

class CommentsSubscriber
{
    public function __construct(private readonly Comment $comment)
    {
    }

    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Comment::class, $this->handleCommentCreated(...));
        $events->listen('eloquent.deleting: ' . Comment::class, $this->handleCommentDeleted(...));
        $events->listen('eloquent.restored: ' . Comment::class, $this->handleCommentRestored(...));
    }

    public function handleCommentCreated(Comment $comment)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CommentCreatedNotification($comment));
    }

    public function handleCommentDeleted(Comment $comment)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CommentDeletedNotification($comment));
    }

    public function handleCommentRestored(Comment $comment)
    {
        $admin = $this->fetchByRole(config('app.system.users.roles.administrator'));

        Notification::send($admin, new CommentRestoredNotification($comment));
    }

    public function fetchByRole(string $role)
    {
        return User::role($role)->get();
    }
}
