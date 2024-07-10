<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProjectLogoResource;
use App\Models\Project_logo;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProjectLogoController extends Controller
{
    use ApiResponse;

    //display all the project logos
    public function index()
    {
         //get all project logos info
         $projectLogos = Project_logo::with('project')->get();

         //in this condition we are checking if the project logo table is empty or not.
         if($projectLogos->isNotEmpty())
         {
             return $this->successResponse(ProjectLogoResource::collection($projectLogos),'Data fetched successfully',200);
         }

         return $this->errorResponse('there is no data in the table',401);
    }



    //show a specific existing project logo
    public function show($project_id)
    {
         //find the existing project by id.
         $projectLogo = Project_logo::where('project_id' , $project_id)->get();
         // Check if any logos exist
       if ($projectLogo->count() > 0) {
           return $this->successResponse(ProjectLogoResource::collection($projectLogo), 'Data fetched successfully', 200);
       }
           //if it does not exist it will break the if statement and return the error response
           return $this->errorResponse('this project doesnt exists',401);
    }

}
