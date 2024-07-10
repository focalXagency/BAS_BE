<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\faqRequest;
use App\Http\Resources\faqResource;
use App\Models\FAQs;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FAQsController extends Controller
{
    use ApiResponse;

    //showonly the most frequent questions
    public function index()
    {

        //get the most frequent questions info
        $mostFrequentQuestions = FAQs::where('mostFrequent' , true)->get();
        //in this condition we are checking if the faqs table is empty or not.
        if($mostFrequentQuestions->isNotEmpty())
        {
            return $this->successResponse(faqResource::collection($mostFrequentQuestions),'Data fetched successfully',200);
        }

        return $this->errorResponse('there is no data in the table',401);

    }


    //add a new question
    public function store(faqRequest $request)
    {
        $val_request = $request->validated();


            $newQuestion = FAQs::create([
                'question'    => $val_request['question'],
                'answer' => $val_request['answer'],
                // 'mostFrequent' => $val_request['mostFrequent'],
            ]);
            if($newQuestion)
            {//check if it's added successfully.
                return $this->successResponse($newQuestion,'Question added successfully',201);
            }
            return $this->errorResponse('there was an error adding the question!',401);

}
    //show a specific question
    public function show($id)
    {

        try{
            $question = FAQs::find($id);
            return $this->successResponse(new faqResource($question), 'Retrived Successfully');
        }catch(\Exception $exp){
            return $this->errorResponse('The Question is not found',401);
        }
    }

    //update an exisiting question
    public function update(faqRequest $request, $id)
    {
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired question by id.
        $question = FAQs::find($id);

        //in this condition we are checking if the question record exits or not.

        if($question)//if it exists
        {
            $updated_question = $question->update($val_request);
            return $this->successResponse($updated_question,'Question updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this question does not exists',401);
    }

    //delete an specific question
    public function destroy($id)
    {

        //find the desired question by id.
        $question = FAQs::find($id);
        //in this condition we are checking if the question record exits or not.
        if($question)
        {
            $question->delete();
            return $this->successResponse($question,'Question removed successfully',200);
        }
        //if it does not exist it will break the if statement and return the error response

        return $this->errorResponse('this question doesnt exists',401);
    }

    public function destroy_all()
    {
        FAQs::truncate();
        return $this->successResponse(null,'all latest projects removed successfully',200);
    }
}
