<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiCommentsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'reply' => $this->reply,
            'replies' => [],
            'created_at' => $this->created_at->diffForHumans(),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'avatar_url' => $this->user->profile_photo_url,
            ]
        ];
    }
}
