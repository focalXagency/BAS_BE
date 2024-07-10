<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyProfileRequest extends FormRequest
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
    public function rules()
    {
        return [
            'company_name'          => ['required' , 'string'],
            'description'           => ['required','string', 'min:15', 'max:300'],
            'industry'              => ['required' , 'string'],
            'location'              => ['required' , 'string'],
            'intro'                 => ['required','string', 'min:15', 'max:300'],
            'company_problem'       => ['required','string', 'min:15', 'max:300'],
            'logo'                  => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'solution'              => ['required','string', 'min:15', 'max:300'],
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
