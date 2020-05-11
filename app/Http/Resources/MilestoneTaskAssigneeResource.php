<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneTaskAssigneeResource extends JsonResource
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
            'assignee_id' => $this->assignee_id,
            'assignee_type' => $this->assignee_type,
            'assignment_id' => $this->assignment_id
        ];
    }
}
