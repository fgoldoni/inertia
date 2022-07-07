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
        $image = $this->attachments->value('url')
            ?? "https://images.unsplash.com/photo-1533693706533-57740e69765d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2700&amp;q=80";

        $avatar = $this->avatar_path ? $this->avatar_url : asset('images/logo.png');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $avatar,
            'image' => $image,
            'display_name' => $this->display_name,
            'subdomain' => $this->subdomain,
        ];
    }
}
