<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
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
             'company_name' => $this->company_name ,
             'description' => $this->description ,
             'industry' => $this->industry ,
             'location' => $this->location,
             'intro' => $this->intro,
             'company_problem' => $this->company_problem,
             'logo' => $this->logo,
             'solution' => $this->solution
         ];
    }
}
