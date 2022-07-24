<?php
namespace Modules\Comments\Observers;

use Modules\Comments\Entities\Comment;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('create', $comment),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function updating(Comment $comment)
    {
        if (auth()->check()) {
            abort_if(
                auth()->user()->cannot('update', $comment),
                403,
                'The user does not have the right permissions to perform an action. Please contact your Support'
            );
        }
    }

    public function deleting(Comment $comment)
    {
        abort_if(
            auth()->user()->cannot('delete', $comment),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function restoring(Comment $comment)
    {
        abort_if(
            auth()->user()->cannot('restore', Comment::class),
            403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }

    public function forceDeleted(Comment $comment)
    {
        abort_if(
            auth()->user()->cannot('forceDelete',
                Comment::class), 403,
            'The user does not have the right permissions to perform an action. Please contact your Support'
        );
    }
}
