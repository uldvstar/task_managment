<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project_type' => $this->project_type,
            'business_service' => new ModularTypeResource($this->businessService),
            'tasks' => MilestoneTaskResource::collection($this->tasks),
            'name' => $this->name,
            'order' => $this->order
        ];
    }
}
