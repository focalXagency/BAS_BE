<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Case_StudyRequest;
use App\Http\Resources\Case_StudyResource;
use App\Models\Case_Study;
use App\Traits\ApiResponse;



class CaseStudyController extends Controller
{
    use ApiResponse;

    //show all the case studies
    public function index()
    {
        $casestudies = Case_Study::with('category')->get();
        if ($casestudies->isNotEmpty()){
            return $this->successResponse(Case_StudyResource::collection($casestudies), 'Data fetched successfully' , 200);
        }
        else{
            return $this->errorResponse('There is no data in the tabele' , 401);
        }
    }

    //add a new case study
    public function store(Case_StudyRequest $request)
    {
        $val_request = $request->validated();
        $newest_order = Case_Study::max('order');//the record that has the maximum order value is the newest
        $casestudy = Case_Study::create([
            'category_id' => $val_request['category_id'],
            'logo' => $val_request['logo'],
            'path' => $val_request['path'],
            'company_name' => $val_request['company_name'],
            'order'   => $newest_order + 1

        ]);

        if ($casestudy) {
            return $this->successResponse(new Case_StudyResource($casestudy), 'the casestudy created successfully', 201);
        } else {
            return $this->errorResponse('There was an error adding this case study',401);
        }
    }

    //show a specific case study by id
    public function show($category_id)
    {
        $casestudy = Case_Study::where('category_id' , $category_id)->get();
    if ($casestudy) {
        return $this->successResponse(Case_StudyResource::collection($casestudy), 'Retrived Successfully');
    }
    return $this->errorResponse('The case study is not found',401);
    }

   //update a specific case study
    public function update(Case_StudyRequest $request,$id)
    {
         $val_request = $request->validated();//this is the new values, we validate them
         $casestudy=Case_Study::find($id);
         $casestudy->update($request->all());

         if($casestudy)//if it exists
         {
             $updated_case = $casestudy->update($val_request);
             return $this->successResponse(new Case_StudyResource($updated_case),'Case Study updated successfully',200);
         }

         //if it does not exist it will break the if statement and return the error response
         return $this->errorResponse('this case study does not exists',401);
    }

    //delete a specific case study by id
    public function destroy($id)
    {
        $casestudy = Case_Study::find($id);
        if (!$casestudy) {

            return $this->errorResponse('this casestudy not found',404);
        }
        else{
        $casestudy->delete();

        return $this->successResponse(new Case_StudyResource($casestudy),'casestudy deleted successfully',200);
        }
    }

    public function destroy_all()
    {
        Case_Study::truncate();
        return $this->successResponse(null,'all case studies removed successfully',200);
    }
}
