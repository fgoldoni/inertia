<?php

namespace Modules\Teams\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeamResourcsec extends JsonResource
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
