<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class InboxMessagesRequest extends FormRequest
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
            'admin_id' => ['integer', 'exists:admins,id'] ,//to make sure that the user does exist.
            'service'  => ['required' , 'string'] ,
            'name' => ['required' , 'string'] ,
            'companyName' => ['required' , 'string'] ,
            'number' => [] ,
            'position' => ['required' , 'string'] ,
            'email' => ['required' , 'string'] ,
            'message' => ['required','string', 'min:15', 'max:300']
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
