<?php
namespace Modules\Users\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Modules\Users\Repositories\Contracts\UsersRepository;

class SessionResource extends JsonResource
{
    public function toArray($request)
    {
        $agent = app(UsersRepository::class)->createAgent($this);

        return (object) [
            'agent' => [
                'is_desktop' => $agent->isDesktop(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
            ],
            'ip_address' => $this->ip_address,
            'is_current_device' => $this->id === $request->session()->getId(),
            'last_active' => Carbon::createFromTimestamp($this->last_activity)->diffForHumans(),
        ];
    }
}
