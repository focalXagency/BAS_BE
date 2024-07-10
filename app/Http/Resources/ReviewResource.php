<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            // 'User' => new UserResource($this->user) ,
            'user name' => $this->name ,
            'position' => $this->position ,
            'review' => $this->review ,
            'company name' => $this->companyName ,
            'order' => $this->order
        ];
    }
}
