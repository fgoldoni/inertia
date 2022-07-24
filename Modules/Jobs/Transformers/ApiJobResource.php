<?php
namespace Modules\Jobs\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiJobResource extends JsonResource
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
            'content' => $this->content,
            'avatar_url' => $this->avatar_url,
            'slug' => $this->slug,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'salary_type' => $this->salary_type,
            'negotiable' => $this->negotiable,
            'iframe' => $this->iframe,
            'closing_to' => $this->closing_to?->format('d, M Y'),
            'live_at' => $this->live_at?->diffForHumans(),
            'team' => [
                'display_name' => $this->team->display_name
            ],
            'address' => $this->address,
            'company' => [
                'name' => $this->company->name
            ],
            'job_type' => $this->categories->jobTypes()->value('name'),
            'responsibilities' => $this->categories->responsibilities()->pluck('name'),
            'skills' => $this->categories->skills()->pluck('name'),
            'benefits' => $this->categories->benefits()->pluck('name'),
            'view_count' => $this->view_count,
            'tags' => $this->tags->pluck('name'),
        ];
    }
}
