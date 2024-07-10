<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FooterRequest;
use App\Http\Resources\FooterResource;
use App\Models\footer;
use App\Traits\ApiResponse;


class FooterController extends Controller
{
    use ApiResponse;

   //display all the footer info
    public function index()
    {
        //get all footer info...
         $footer= footer::get();
         //in this condition we are checking if the footers table is empty or not.
         if($footer->isNotEmpty())
         {
            return $this->successResponse(FooterResource::collection($footer),'Data fetched successfully',200);
         }

           return $this->errorResponse('there is no data in the table',401);
    }

    //add a new link to the footer
    public function store(FooterRequest $request)
    {
        $val_request = $request->validated();
        $existing_link = footer::where('link',$val_request)->first();
        if($existing_link)
            {
                //check if it's already added before.
            return $this->errorResponse('Link already exists',401);
            }

        else{
            $newLink = footer::create([
                'logo'    => $val_request['logo'],
                'path' => $val_request['path'],
                'link' => $val_request['link']
            ]);
            if($newLink)
            {//check if it's added successfully
                return $this->successResponse(new FooterResource($newLink),'Link added successfully',201);
            }
            return $this->errorResponse('there was an error adding the link!',401);
    }
    }

    //show a specific exisiting link
    public function show($id)
    {
        $footer = footer::find($id);
        if ($footer) {
            return $this->successResponse(new FooterResource($footer), 'Link Retrived Successfully', 200);
        }
        return $this->errorResponse('The footer not found', 401);
    }

    //update an exisiting link
    public function update(FooterRequest $request, $id)
    {
        $val_request = $request->validated();
        //find the desired project by id.
        $link = footer::find($id);

        //in this condition we are checking if the project record exits or not.

        if($link)//if it exists
        {
            $updated_link = $link->update($val_request);
            return $this->successResponse($updated_link,'LInk updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this link does not exists',401);
    }

   //delete a specific link
    public function destroy($id)
    {
        $footer = footer::find($id);
        if (!$footer) {

            return $this->errorResponse('This Footer not found',401);
        }
        else{
            $footer->delete();

            return $this->successResponse(new FooterResource($footer), 'Footer deleted successfully',200);
        }
    }

    public function destroy_all()
    {
        footer::truncate();
        return $this->successResponse(null,'all footer links removed successfully',200);
    }
}
