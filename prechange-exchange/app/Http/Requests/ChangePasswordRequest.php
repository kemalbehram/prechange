<?php

namespace App\Http\Requests;
 
use Illuminate\Support\Facades\Input;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
               
        return [
            'oldpassword' => 'required', 
            'newpassword' => 'required|min:6', 
            'confirmpassword' => 'required|min:6|same:newpassword'              
        ];
    }

     public function messages()
    {

        return [
            'oldpassword.required' => 'Old Password is required',
            'newpassword.required' => 'New Password is required',
            'newpassword.min' => 'New Password must be :min character',
            'confirmpassword.required' => 'Confirm Password is required',
            'confirmpassword.min' => 'Confirm Password must be :min character',
            'confirmpassword.newpassword' => 'Confirm Password is not matching to New Password',
            
        ];
    }



}
