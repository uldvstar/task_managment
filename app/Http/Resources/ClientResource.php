<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'type' => $this->CustomerType->name,
            'marking' => $this->marking,
            'name' => $this->name,
            'email' => $this->email,
            'wechat_id' => $this->wechat_id
        ];
    }
}
