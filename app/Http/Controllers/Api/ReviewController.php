<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponse;

    //show all exsisting reviews
    public function index()
    {

        //get all reviews info...
        $reviews = Review::with('user')->get();

        //in this condition we are checking if the reviews table is empty or not.
         if($reviews->isNotEmpty())
         {
             return $this->successResponse(ReviewResource::collection($reviews),'Data fetched successfully',200);
         }

         return $this->errorResponse('there is no data in the table',401);
    }

    //add a new review
    public function store(ReviewRequest $request)
    {

        $val_request = $request->validated();
        $newest_order = Review::max('order');//the record that has the maximum order value is the newest

        $existing_review = Review::where('name',$val_request)->first();
        if($existing_review)
            {//check if it's already added before.
            return $this->errorResponse('Review already exists',401);
            }

        else{
            $newReview = Review::create([
                'user_id' => $val_request['user_id'],
                'name'    => $val_request['name'],
                'position' => $val_request['position'],
                'review' => $val_request['review'],
                'companyName' => $val_request['companyName'],
                'order'       => $newest_order + 1,//increase the order by one so it will become the newest
            ]);
            if($newReview)
            {//check if it's added successfully.
                return $this->successResponse($newReview,'Review added successfully',201);
            }
            return $this->errorResponse('there was an error adding the review!',401);
        }
    }


    //show a specific exsisting review
    public function show($user_id)
    {
        //find the review by id.
        $reviews = Review::where('user_id' , $user_id)->get();
        // Check if any reviews exist
        if ($reviews->count() > 0) {
             return $this->successResponse(ReviewResource::collection($reviews), 'Data fetched successfully', 200);
        }
        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this review doesnt exists',401);

    }

    //update an existing review
    public function update(ReviewRequest $request, $id)
    {
        $val_request = $request->validated();//this is the new values, we validate them
        //find the desired review by id.
        $review = Review::find($id);

        //in this condition we are checking if the review record exits or not.

        if($review)//if it exists
        {
            $updated_review = $review->update($val_request);
            return $this->successResponse($updated_review,'Review updated successfully',200);
        }

        //if it does not exist it will break the if statement and return the error response
        return $this->errorResponse('this review does not exists',401);
    }

    //delete exsiting review
    public function destroy($id)
    {
        //find the desired review by id.
        $review = Review::find($id);
        //in this condition we are checking if the review record exits or not.
        if($review)
        {
            $review->delete();
            return $this->successResponse($review,'Review removed successfully',200);
        }
        //if it does not exist it will break the if statement and return the error response

        return $this->errorResponse('this review doesnt exists',401);
    }

    public function destroy_all()
    {
        Review::truncate();
        return $this->successResponse(null,'all Reviews removed successfully',200);
    }
}
