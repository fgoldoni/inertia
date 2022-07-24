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
            'comments' => $this->comments->map(fn($comment) => [
                'id' => $comment->id,
                'content' => $comment->content,
                'reply' => $comment->reply,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'id' => $comment->user->id,
                    'name' => $comment->user->name,
                    'email' => $comment->user->email,
                    'avatar_url' => $comment->user->profile_photo_url,
                ]
            ]),
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
