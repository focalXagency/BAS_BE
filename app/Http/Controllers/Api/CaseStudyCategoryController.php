<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CaseStudyCategoryResource;
use App\Models\CaseStudyCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CaseStudyCategoryController extends Controller
{
    use ApiResponse;

    //show all the catgories with paginate
    public function index()
    {
        $categories = CaseStudyCategory::paginate(3);
        if ($categories->isNotEmpty()){
            return $this->successResponse(CaseStudyCategoryResource::collection($categories), 'Data fetched successfully' , 200);
        }
        else{
            return $this->errorResponse('There is no data in the tabele' , 401);
        }
    }


    //dispaly a specific existing category
    public function show($id)
    {
        //
        $category = CaseStudyCategory::find($id);
        if ($category) {
            return $this->successResponse(new CaseStudyCategoryResource($category), 'Retrived Successfully');
        }
        return $this->errorResponse('The case study category is not found',401);
    }


}
