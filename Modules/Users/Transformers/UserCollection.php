<?php

namespace Modules\Users\Transformers;


use Illuminate\Http\Resources\Json\JsonResource;

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
            'role' => $this->roles->value('id'),
            'created_at' => $this->created_at->formatLocalized('%d %B, %Y'),
            'verified' => !is_null($this->email_verified_at),
        ];
    }
}
