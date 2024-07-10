<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InboxMessagesRequest;
use App\Http\Resources\InboxMessagesresource;
use App\Models\InboxMessages;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class InboxMessagesController extends Controller
{
    use ApiResponse;

    //show all the inbox messages
    public function index()
    {
        //get all inbox messages info...
        $inboxMessages = InboxMessages::with('admin')->get();

        //in this condition we are checking if the inbox_messages table is empty or not.
         if($inboxMessages->isNotEmpty())
         {
             return $this->successResponse(InboxMessagesresource::collection($inboxMessages),'Data fetched successfully',200);
         }

         return $this->errorResponse('there is no data in the table',401);
    }

    //add a new messages through the contact us form
    public function store(InboxMessagesRequest $request)
    {
        $val_request = $request->validated();


            $newMessage= InboxMessages::create([
                'admin_id' => $val_request['admin_id'],
                'service' => $val_request['service'] ,
                'name'    => $val_request['name'],
                'companyName' => $val_request['companyName'],
                'number' => $val_request['number'] ,
                'position' => $val_request['position'],
                'email' => $val_request['email'],
                'message' => $val_request['message']
            ]);
            if($newMessage)
            {//check if it's added successfully.
                return $this->successResponse($newMessage,'Message added successfully',201);
            }
            return $this->errorResponse('there was an error adding the message!',401);

    }

    //show a specific existing inbox message
    public function show($id)
    {
        try{
            $inboxMessage =InboxMessages::find($id);
            return $this->successResponse(new InboxMessagesresource($inboxMessage), 'Retrived Successfully');
        }catch(\Exception $exp){
            return $this->errorResponse('The inbox message is not found',401);
        }
    }


    //update a specific message
    public function update(InboxMessagesRequest $request, $id)
    {
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired review by id.
        $inboxMessage = InboxMessages::find($id);

        //in this condition we are checking if the inbox message record exits or not.

        if($inboxMessage)//if it exists
        {
            $updated_message = $inboxMessage->update($val_request);
            return $this->successResponse($updated_message,'Inbox Message updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this message does not exists',401);
    }

   //delete a specific inbox message
    public function destroy($id)
    {
        //find the desired message by id.
        $inboxMessage = InboxMessages::find($id);
        //in this condition we are checking if the message record exits or not.
        if($inboxMessage)
        {
            $inboxMessage->delete();
            return $this->successResponse($inboxMessage,'Message removed successfully',200);
        }
        //if it does not exist it will break the if statement and return the error response

        return $this->errorResponse('this message doesnt exists',401);
    }

    public function destroy_all()
    {
        InboxMessages::truncate();
        return $this->successResponse(null,'all inbox messages removed successfully',200);
    }
}
