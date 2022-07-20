<?php

namespace Modules\Attachments\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiAttachmentsResource extends JsonResource
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
            'mime_type' => $this->mime_type,
            'url' => $this->url,
            'created_at' => $this->created_at->format('d, M Y h:m'),
        ];
    }
}
