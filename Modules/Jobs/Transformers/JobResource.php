<?php
namespace Modules\Jobs\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Activities\Repositories\Contracts\ActivitiesRepository;

class JobResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

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
            'company' => $this->company,
            'country_id' => $this->country_id,
            'division_id' => $this->division_id,
            'city_id' => $this->city_id,
            'closing_to' => $this->closing_to,
            'address' => $this->address,
            'iframe' => $this->iframe,

            'categories' => $this->categories,
            'country' => $this->country,
            'city' => $this->city,
            'division' => $this->division,
            'attachments' => $this->attachments,

            'team_id' => $this->team_id,

            'logs' => app(ActivitiesRepository::class)->byModel($this),
        ];
    }
}
