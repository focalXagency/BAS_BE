<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Case_StudyResource extends JsonResource
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
            'category' => new CaseStudyCategoryResource($this->category),
            'logo' => $this->logo ,
            'company_name' => $this->company_name ,
            'order' => $this->order
        ];
    }
}
