<?php

namespace Modules\Comments\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Repositories\Contracts\CommentsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentCommentsRepository extends RepositoryAbstract implements CommentsRepository
{
    public function model(): string
    {
        return Comment::class;
    }
}
