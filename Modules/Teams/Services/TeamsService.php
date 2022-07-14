<?php

namespace Modules\Teams\Services;

use App\Repositories\Criteria\EagerLoad;
use App\Repositories\Criteria\WithTrashed;
use App\Services\ServiceAbstract;
use Illuminate\Support\Collection;
use Modules\Teams\Enums\ColorType;
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
                'categories:id,name,type',
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

    public function allOptionsTeams()
    {
        if (auth()->user()->isAdministrator()) {
            return $this->repository->withCriteria([
                new WithTrashed(),
            ])->get(['id', 'name', 'display_name']);
        } else {
            return auth()->user()->allTeams()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'display_name' => $item->display_name,
                ];
            });
        }
    }

    public function colors(): Collection
    {
        return collect([
            [
                'id' => (ColorType::Teal)->value,
                'name' => ucfirst((ColorType::Teal)->value),
            ],
            [
                'id' => (ColorType::Indigo)->value,
                'name' => ucfirst((ColorType::Indigo)->value),
            ],
            [
                'id' => (ColorType::Pink)->value,
                'name' => ucfirst((ColorType::Pink)->value),
            ],
            [
                'id' => (ColorType::Purple)->value,
                'name' => ucfirst((ColorType::Purple)->value),
            ]
        ]);
    }
}
