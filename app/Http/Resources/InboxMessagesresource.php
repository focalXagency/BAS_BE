<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InboxMessagesresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'service' => $this->service ,
            'name' => $this->name ,
            'companyName' => $this->companyName,
            'number' => $this->number,
            'position' => $this->position,
            'email' => $this->email,
            'message' => $this->message
        ];
    }
}
