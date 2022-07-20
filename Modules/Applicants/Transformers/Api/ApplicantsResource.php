<?php

namespace Modules\Applicants\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'job_id' => $this->job->id,
            'job_name' => $this->job->name,
            'job_city' => $this->job->city?->name,
            'job_country_emoji' => $this->job->country?->emoji,
            'job_avatar_url' => $this->job->avatar_url,
            'status' => $this->status,
            'phone' => $this->phone,
            'message' => $this->message,
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->format('d, M Y h:m'),
            'candidate_id' => $this->candidate->id,
            'candidate_name' => $this->candidate->name,
            'candidate_email' => $this->candidate->email,
            'candidate_profile_photo_url' => $this->candidate->profile_photo_url,
            'mime_type' => $this->attachments->value('mime_type'),
            'url' => $this->attachments->value('url'),
        ];
    }
}
