<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'id' => $this->id ,
            'Company Name' => $this->companyName ,
            'service provided' => $this->serviceProvided ,
            'descirption' => $this->descirption,
            'CEO Name' => $this->CEOName
        ];
    }
}
