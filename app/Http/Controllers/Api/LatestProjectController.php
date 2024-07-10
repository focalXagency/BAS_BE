<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\latest_project;
use App\Traits\ApiResponse;


class LatestProjectController extends Controller
{
    use ApiResponse;

    //show all the latest projects
    public function index()
    {
        //
        //get all projects  info...
        $projects = latest_project::get();

        //in this condition we are checking if the projects table is empty or not.
        if($projects->isNotEmpty())
        {
            return $this->successResponse(ProjectResource::collection($projects),'Data fetched successfully',200);
        }

          return $this->errorResponse('there is no data in the table',401);
    }


    //add a new project
    public function store(ProjectRequest $request)
    {
        //
        $val_request = $request->validated();
        $newest_order = latest_project::max('order');//the record that has the maximum order value is the newest

        $existing_project = latest_project::where('name',$val_request)->first();
        if($existing_project)
            {
                //check if it's already added before.
            return $this->errorResponse('Project already exists',401);
            }

        else{
            $newProject = latest_project::create([
                'companyName'    => $val_request['companyName'],
                'serviceProvided' => $val_request['serviceProvided'],
                'descirption' => $val_request['descirption'],
                'CEOName' => $val_request['CEOName'],
                'order'   => $newest_order + 1

            ]);
            if($newProject)
            {//check if it's added successfully.
                return $this->successResponse($newProject,'Project added successfully',201);
            }
            return $this->errorResponse('there was an error adding the project!',401);
    }
}


    //show a specific project
    public function show($id)
    {
        //
        try{
            $project = latest_project::find($id);
            return $this->successResponse(new ProjectResource($project), 'Retrived Successfully');
        }catch(\Exception $exp){
            return $this->errorResponse('The Project is not found',401);
        }
    }

    //update an exsisting project
    public function update(ProjectRequest $request, $id)
    {
        //
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired project by id.
        $project = latest_project::find($id);

        //in this condition we are checking if the project record exits or not.

        if($project)//if it exists
        {
            $updated_project = $project->update($val_request);
            return $this->successResponse($updated_project,'Project updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this project does not exists',401);
    }

    //delte a specific project
    public function destroy($id)
    {

        //find the desired project by id.
        $project = latest_project::find($id);
        //in this condition we are checking if the Project record exits or not.
        if($project)
        {
            $project->delete();
            return $this->successResponse($project,'Project removed successfully',200);
        }
        //if it does not exist it will break the if statement and return the error response

        return $this->errorResponse('this project doesnt exists',401);
    }

    public function destroy_all()
    {
        latest_project::truncate();
        return $this->successResponse(null,'all latest projects removed successfully',200);
    }
}

