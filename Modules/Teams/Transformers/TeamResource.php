<?php

namespace Modules\Teams\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;
use Modules\Teams\Services\Contracts\TeamsServiceInterface;

class TeamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'subdomain' => $this->subdomain,
            'teamInvitations' => $this->teamInvitations,
            'avatar_path' => $this->avatar_path,
            'attachments' => $this->attachments,
            'members' => $this->users,
            'industries' => app(CategoriesRepository::class)->industries(['id', 'name']),
            'categories' => $this->categories,
            'color' => $this->color,

            'logs' => app(ActivitiesRepository::class)->byModel($this),
            'colors' => app(TeamsServiceInterface::class)->colors(),
        ];
    }
}
