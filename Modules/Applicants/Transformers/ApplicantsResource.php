<?php

namespace Modules\Applicants\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;

class ApplicantsResource extends JsonResource
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
            'job' => [
                'name' => $this->job->name,
                'city' => $this->job->city?->name,
                'avatar_url' => $this->job->avatar_url,
            ],
            'status' => $this->status,
            'phone' => $this->phone,
            'message' => $this->message,
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->format('d, M Y'),
            'candidate' => $this->candidate,

            'logs' => app(ActivitiesRepository::class)->byModel($this),
        ];
    }
}
