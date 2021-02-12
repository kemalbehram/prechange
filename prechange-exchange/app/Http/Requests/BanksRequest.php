<?php

namespace App\Http\Requests;
 
use Illuminate\Support\Facades\Input;

use Illuminate\Foundation\Http\FormRequest;

class BanksRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {      
           // dd('ddd');   
        return [
            'bank' => 'required|regex:/^[a-zA-Z]+$/u|unique:banks'             
        ];
    }

    public function messages()
    {

        return [
            'bank.required' => 'Bank Name is required',
            'bank.regex' => 'Bank Name must contain letters',
            'bank.unique' => 'Bank Name is already exists'
            
        ];
    }



}
