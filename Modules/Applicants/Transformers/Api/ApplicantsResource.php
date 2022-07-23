<?php
namespace Modules\Applicants\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Jobs\Transformers\ApiJobResource;

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
            'job' => new ApiJobResource($this->job),
            'status' => $this->status,
            'phone' => $this->phone,
            'message' => $this->message,
            'job_id' => $this->job_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->format('d, M Y'),
            'company' => [
                'id' => $this->job->company->id,
                'name' => $this->job->company->name,
            ],
            'candidate' => [
                'id' => $this->candidate->id,
                'name' => $this->candidate->name . ' ( ' . $this->candidate->email . ' ) ',
            ],

            'attachments' => $this->attachments->map(fn($attachment) => [
                'id' => $attachment->id,
                'name' => $attachment->name,
                'mime_type' => $attachment->mime_type,
                'url' => $attachment->url
            ]),
        ];
    }
}
