<?php

namespace Modules\Users\Transformers;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Modules\Roles\Entities\Role;
use Modules\Users\Repositories\Contracts\UsersRepository;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->roles->value('id') ?? Role::where('name', config('app.system.users.roles.manager'))->first()->id,
            'created_at' => $this->created_at?->formatLocalized('%d %B, %Y'),
            'verified' => !is_null($this->email_verified_at),
            'lastLogin' => Carbon::createFromTimestamp($this->sessions->value('last_activity'))->diffForHumans()
        ];
    }
}
