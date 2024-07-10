<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FileRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Traits\ApiResponse;


class FileController extends Controller
{
    use ApiResponse;

    //display all the files
    public function index()
    {
        //get all files info
        $files = File::with('folder')->get();
        //in this condition we are checking if the files table is empty or not.
        if($files->isNotEmpty())
        {
            return $this->successResponse(FileResource::collection($files),'Data fetched successfully',200);
        }
        return $this->errorResponse('there is no data in the table',401);
    }

    //add a new file
    public function store(FileRequest $request)
    {
        $val_request = $request->validated();


            $newFile = File::create([
                'admin_id' => $val_request['admin_id'],
                'user_id' => $val_request['user_id'],
                'folder_id' => $val_request['folder_id'],
                'name'    => $val_request['name'],
                'date' => $val_request['date'],
                'size' => $val_request['size'],
                'type' => $val_request['type']
            ]);
            if($newFile)
            {//check if it's added successfully.
                return $this->successResponse(new FileResource($newFile),'File added successfully',201);
            }
            return $this->errorResponse('there was an error adding the file!',401);

    }


    //show a specific exisiting file
    public function show($folder_id)
    {
        $file = File::where('folder_id' , $folder_id)->get();
    if ($file) {
        return $this->successResponse(FileResource::collection($file), 'File Retrived Successfully', 200);
    }
    return $this->errorResponse('The file not found', 401);
    }


    //update an exisiting file
    public function update(FileRequest $request,$id)
    {
        $val_request = $request->validated();
        //find the desired file by id.
        $file = File::find($id);

        //in this condition we are checking if the file record exits or not.
        if($file)//if it exists
        {
            $updated_file = $file->update($val_request);
            return $this->successResponse($updated_file,'File updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this file does not exists',401);
    }

   //delete a specific file
    public function destroy($id)
    {
        $file = File::find($id);
        if (!$file) {

            return $this->errorResponse('this file not found',401);
        }
        else{
        $file->delete();

        return $this->successResponse(new FileResource($file),'file deleted successfully',200);
        }
    }

    public function destroy_all()
    {
        File::truncate();
        return $this->successResponse(null,'all files removed successfully',200);
    }
}
