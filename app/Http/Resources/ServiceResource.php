<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
          'logo' => $this->logo ,
          'path' => $this->path ,
          'service_name' => $this->name ,
          'description'  => $this->descirption ,
          'order' => $this->order
        ];
    }
}
