<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CompanyProfileRequest;
use App\Http\Resources\CompanyProfileResource;
use App\Models\Company_Profile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    use ApiResponse;

    //dispaly all the company profile
    public function index(){
         //get all company profiles info
         $companyProfiles = Company_Profile::get();
         //in this condition we are checking if the company profiles table is empty or not.
         if($companyProfiles->isNotEmpty())
         {
             return $this->successResponse(CompanyProfileResource::collection($companyProfiles),'Data fetched successfully',200);
         }
           return $this->errorResponse('there is no data in the table',401);
    }

    //add a new company profile to the database
    public function store(CompanyProfileRequest $request)
    {
        $val_request = $request->validated();
        $existing_profile = Company_Profile::where('company_problem',$val_request)->first();
        if($existing_profile)
            {      //check if it's already added before.
            return $this->errorResponse('Profile already exists',401);
            }

        else{
            $newProfile = Company_Profile::create([
                'company_name'    => $val_request['company_name'],
                'description' => $val_request['description'],
                'industry' => $val_request['industry'],
                'location' => $val_request['location'],
                'intro'   => $val_request['intro'],
                'company_problem'   => $val_request['company_problem'],
                'logo'   => $val_request['logo'],
                'path'   => $val_request['path'],
                'solution'   => $val_request['solution']
            ]);
            if($newProfile)
            {//check if it's added successfully.
                return $this->successResponse(new CompanyProfileResource($newProfile),'Profile added successfully',201);
            }
            return $this->errorResponse('there was an error adding the profile!',401);
    }
    }

   //show a specidic company profile by id
    public function show($id)
    {
        $companyprofile = Company_Profile::find($id);
    if ($companyprofile) {
        return $this->successResponse(new CompanyProfileResource($companyprofile), 'Company profile retrived Successfully', 200);
    }
    return $this->errorResponse('The Company Profile not found', 401);
    }

    //update a specific exisiting company profile
    public function update(CompanyProfileRequest $request, $id)
    {
         $val_request = $request->validated();
         $companyprofile=Company_Profile::find($id);
         $companyprofile->update($val_request);
         if ($companyprofile) {
             return $this->successResponse(new CompanyProfileResource($companyprofile), 'the companyprofile update', 200);
         }else {
             return $this->errorResponse('the company profile does not exist',401);
         }
    }

    //delete a specific compnay profile
    public function destroy($id)
    {
        $companyprofile = Company_Profile::find($id);
        if (!$companyprofile) {

            return $this->errorResponse('the company profile not found',401);
        }
        else {
        $companyprofile->delete();

        return $this->successResponse(new CompanyProfileResource($companyprofile),'company profile deleted successfully',200);
        }
}
    public function destroy_all()
    {
        Company_Profile::truncate();
        return $this->successResponse(null,'all company profiles removed successfully',200);
    }
}
