<?php

namespace Modules\Teams\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Modules\Categories\Entities\Category;
use Modules\Categories\Repositories\Contracts\CategoriesRepository;

class ApiTeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        session()->put('team-id', $this->id);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar_url,
            'image' => $this->imagePreview(),
            'display_name' => $this->display_name,
            'subdomain' => $this->subdomain,
            'color' => $this->color->value,
            'jobTypes' => array_values(app()->make(CategoriesRepository::class)
                ->get(['id', 'name', 'type'])->jobTypes()->toArray()),
            'areas' => Category::has('jobs')
                ->withCount(['jobs' => fn ($query) => $query->published()])
                ->area()
                ->positionAsc()
                ->get()->map(fn ($item) => [
                    'id' => $item->id,
                    'name' => $item->name,
                    'jobs_count' => $item->jobs_count,
                ])->filter(fn ($item) => $item['jobs_count'] > 0),
        ];
    }

    private function imagePreview()
    {
        return match ($this->subdomain) {
            'netflix' => asset('images/preview/netflix.jpg'),
            'tesla' => asset('images/preview/tesla.jpg'),
            'deutsche-bank' => asset('images/preview/deutsche-bank.jpg'),
            default => asset('images/preview/preview.jpg'),
        };
    }
}
