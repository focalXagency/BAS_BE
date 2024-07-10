<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiResponse;

    //show all the services
    public function index()
    {
        //
        //get all services info
        $services = Service::get();
        //in this condition we are checking if the services table is empty or not.
         if($services->isNotEmpty())
         {
             return $this->successResponse(ServiceResource::collection($services),'Data fetched successfully',200);
         }

         return $this->errorResponse('there is no data in the table',401);

    }


    //show a specific service
    public function show($id)
    {
        //
        try{
            $service= Service::find($id);
            return $this->successResponse(new ServiceResource($service), 'Retrived Successfully');
        }catch(\Exception $exp){
            return $this->errorResponse('The Service is not found',401);
        }
    }


}
