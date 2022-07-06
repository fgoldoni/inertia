<?php

namespace Modules\Teams\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;

class ApiTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar_url,
            'image' => $this->attachments->value('url'),
            'display_name' => $this->display_name,
            'subdomain' => $this->subdomain,
        ];
    }
}
