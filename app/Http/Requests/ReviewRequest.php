<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'user_id' => ['required', 'integer', 'exists:users,id'] ,//to make sure that the user does exist.
            'name' => ['required' , 'string'] ,
            'position' => ['required' , 'string'] ,
            'review' => ['required','string', 'min:15', 'max:300'] ,
            'companyName' => ['required' , 'string'] ,
            'order' => ['numeric' , 'integer' , 'min:1' , 'between:1,50']
        ];
    }

       //if there is an error with the validation display the error as a Json response.
       protected function failedValidation(Validator $validator)
       {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422));
       }
}
