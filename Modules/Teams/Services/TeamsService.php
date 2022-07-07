<?php

namespace Modules\Teams\Services;

use App\Models\Team;
use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\WithTrashed;
use App\Services\ServiceAbstract;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;
use Modules\Teams\Transformers\TeamResource;

/**
 * Class TeamsService.
 */
class TeamsService extends ServiceAbstract implements TeamsServiceInterface
{
    protected function repository()
    {
        return TeamsRepository::class;
    }

    public function findTeam(int $id): TeamResource
    {
        return new TeamResource($this->repository->withCriteria([
            new EagerLoad([
                'owner:id,name,email,profile_photo_path',
                'users:id,name,email',
                'activities',
                'teamInvitations',
                'attachments' => function ($query) {
                    $query->select([
                        'id',
                        'name',
                        'filename',
                        'disk',
                        'attachable_id',
                        'attachable_type'
                    ])->where('attachments.disk', config('app.system.disks.uploads'));
                }
            ]),
            new WithTrashed(),
        ])->find($id));
    }
}
