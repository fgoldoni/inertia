<?php

namespace Modules\Jobs\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'phone' => $this->phone,
            'content' => $this->content,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'salary_type' => $this->salary_type,
            'negotiable' => $this->negotiable,
            'state' => $this->state,
            'avatar_path' => $this->avatar_path,
            'company_id' => $this->company_id,
            'content' => $this->content,
        ];
    }
}
