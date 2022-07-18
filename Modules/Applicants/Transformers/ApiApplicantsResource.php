<?php

namespace Modules\Applicants\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiApplicantsResource extends JsonResource
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
