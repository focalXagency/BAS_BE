<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     *@return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'] ,//to make sure that the user does exist.
            'admin_id' => ['required', 'integer', 'exists:admins,id'] ,//to make sure that the admin does exist.
            'folder_id' => ['required' , 'integer' , 'exists:folders,id'],//to make sure that the folder does exist.
            'name'     => ['required' , 'string'],
            'date'     => ['required'],
            'size'     => ['required' ],
            'type'     => ['required' , 'string'],
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
