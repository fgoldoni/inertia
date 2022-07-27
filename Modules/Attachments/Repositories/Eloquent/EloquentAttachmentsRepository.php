<?php

/**
 * Created by PhpStorm.
 * User: goldoni
 * Date: 24.09.18
 * Time: 21:18.
 */

namespace Modules\Attachments\Repositories\Eloquent;

use App\Repositories\RepositoryAbstract;
use Modules\Attachments\Entities\Attachment;
use Modules\Attachments\Repositories\Contracts\AttachmentsRepository;

/**
 * Class EloquentPostsRepository.
 */
class EloquentAttachmentsRepository extends RepositoryAbstract implements AttachmentsRepository
{
    public function model(): string
    {
        return Attachment::class;
    }
}
