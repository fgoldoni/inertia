<?php

namespace Modules\Companies\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiCompanyResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'size' => $this->size,
            'founded' => $this->founded,
            'location' => $this->location,
            'avatar_url' => $this->avatar_url,
            'categories' => $this->categories,
        ];
    }
}
