<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneTaskResource extends JsonResource
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
            'milestone_id' => $this->milestone_id,
            'business_service' => new ModularTypeResource($this->milestone->businessService),
            'type_id' => $this->type_id,
            'task_type' => new ModularTypeResource($this->taskType),
            'title' => $this->title,
            'description' => $this->description,
            'assignees' => [
                'departments' => DepartmentResource::collection($this->departments),
                'users' => UserResource::collection($this->users)
            ]

        ];
    }
}
