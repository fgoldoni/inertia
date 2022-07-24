<?php

namespace Modules\Comments\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiCommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
