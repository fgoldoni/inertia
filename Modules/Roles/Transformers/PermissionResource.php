<?php
namespace Modules\Roles\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'display_name' => $this->display_name,
            'can_be_removed' => $this->can_be_removed,
            'created_at' => $this->created_at?->formatLocalized('%b %d'),
        ];
    }
}
