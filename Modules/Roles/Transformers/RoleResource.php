<?php

namespace Modules\Roles\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{

    public function toArray($request)
    {
        $users = $this->users->map(fn ($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'image' => $user->profile_photo_url,
        ]);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'created_at' => $this->created_at?->formatLocalized('%d %B, %Y'),
            'users_count' => $this->users_count,
            'permissions' => $this->permissions->pluck('id'),
            'users' => $users->take(10),
            'users_list' => $this->users->groupByLetter(),
        ];
    }
}
