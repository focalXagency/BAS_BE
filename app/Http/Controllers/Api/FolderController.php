<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use App\Traits\ApiResponse;


class FolderController extends Controller
{
    use ApiResponse;

    //display all the folders
    public function index()
    {
        //get all folders info...
        $folders = Folder::get();

        //in this condition we are checking if the folders table is empty or not.
        if($folders->isNotEmpty())
        {
            return $this->successResponse(FolderResource::collection($folders),'Data fetched successfully',200);
        }

        return $this->errorResponse('there is no data in the table',401);
    }

    //add a new folder
    public function store(FolderRequest $request)
    {

        $val_request = $request->validated();
        $existing_folder= Folder::where('name',$val_request)->first();
        if($existing_folder)
            {
                //check if it's already added before.
            return $this->errorResponse('Folder already exists',401);
            }
        else{
            $newFolder = Folder::create([
                'admin_id' => $val_request['admin_id'],
                'user_id' => $val_request['user_id'],
                'name'    => $val_request['name'],
                'creation_date' => $val_request['creation_date'],
                'size' => $val_request['size']
            ]);
            if($newFolder)
            {//check if it's added successfully.
                return $this->successResponse(new FolderResource($newFolder),'Folder added successfully',201);
            }
            return $this->errorResponse('there was an error adding the folder!',401);
    }
    }

    //show a specicfic folder
    public function show($id)
    {
        $folder = Folder::find($id);
    if ($folder) {
        return $this->successResponse(new FolderResource($folder), 'Folder Retrived Successfully', 200);
    }
    return $this->errorResponse('The folder not found',401);
    }

    //update an exisiting folder
    public function update(FolderRequest $request, $id)
    {
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired folder by id.
        $folder = Folder::find($id);

        //in this condition we are checking if the folder record exits or not.
        if($folder)//if it exists
        {
            $updated_folder = $folder->update($val_request);
            return $this->successResponse($updated_folder,'Folder updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this folder does not exists',401);
    }

    //delete a specific exisiting folder
    public function destroy(string $id)
    {
        $folder = Folder::find($id);
        if (!$folder) {

            return $this->errorResponse('this folder not found',404);
        }
        else {
        $folder->delete();

        return $this->successResponse(new FolderResource($folder), 'folder deleted successfully',200);
        }
    }

    public function destroy_all()
    {
        Folder::truncate();
        return $this->successResponse(null,'All Folders removed successfully',200);
    }
}
