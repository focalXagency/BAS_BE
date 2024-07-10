<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Traits\ApiResponse;


class TeamController extends Controller
{
    use ApiResponse;

    //show all the team members
    public function index()
    {
        //get all team info
        $teams = Team::get();
        //in this condition we are checking if the teams table is empty or not.
        if($teams->isNotEmpty())
        {
            return $this->successResponse(TeamResource::collection($teams),'Data fetched successfully',200);
        }

        return $this->errorResponse('there is no data in the table',401);
    }


    //show a sepcific team member
    public function show($id)
    {

        try{
            $team = Team::find($id);
            return $this->successResponse(new TeamResource($team), 'Retrived Successfully');
        }catch(\Exception $exp){
            return $this->errorResponse('The team member is not found',401);
        }
    }


}
