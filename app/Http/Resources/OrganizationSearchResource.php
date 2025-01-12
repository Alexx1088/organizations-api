<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'building' => new BuildingResource($this->whenLoaded('building')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
            'phones' => PhoneResource::collection($this->whenLoaded('phones')),
        ];
    }
}
