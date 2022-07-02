<?php

namespace Modules\Activities\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $causer = $this->causer?->name;

        return [
            'id' => $this->id,
            'event' => $this->event,
            'description' => $this->description . ' by ',
            'date' => Carbon::parse($this->created_at)->diffForHumans(),
            'iconBackground' => $this->color($this->event),
            'href' => 'javascript:;',
            'target' => $causer,
        ];
    }

    private function color(string $event)
    {
        if ($event === 'updated') return 'bg-pink-500';
        if ($event === 'created') return 'bg-blue-500';
        if ($event === 'deleted') return 'bg-rose-500';

        return  'bg-blue-500';
    }
}
