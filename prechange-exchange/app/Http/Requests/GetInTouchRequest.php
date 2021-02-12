<?php

namespace App\Http\Requests;
 
use Illuminate\Support\Facades\Input;

use Illuminate\Foundation\Http\FormRequest;

class GetInTouchRequest extends FormRequest
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
            'name' => 'required', 
            'email' => 'required|',
            'subject' => 'required', 
            'message' => 'required|',
            'phone' => 'required|min:10|max:10'              
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'subject.required' => 'Subject is required',
            'message.required' => 'Message is required',
            'phone.required' => 'Phone is required',
            'phone.min' => 'Invalid Phone Number',
            'phone.max' => 'Invalid Phone Number'  
            
        ];
    }



}
