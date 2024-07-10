<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
             'id' => $this->id,
             'name' => $this->name ,
             'size' => $this->size ,
             'creation_date' => $this->creation_date ,
         ];
    }
}
