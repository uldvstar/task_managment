<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'type_id' => $this->type_id,
            'project_type' => $this->projectType->name,
            'client_id' => $this->client_id,
            'client' => new ClientResource($this->client),
            'reference' => $this->reference,
            'description' => $this->description,
            'status' => $this->status,
            'current_status' => $this->currentStatus->name
        ];
    }
}
