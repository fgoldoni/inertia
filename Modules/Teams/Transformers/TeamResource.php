<?php

namespace Modules\Teams\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;

class TeamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'subdomain' => $this->subdomain,

            'logs' => app(ActivitiesRepository::class)->byModel($this),
        ];
    }
}
