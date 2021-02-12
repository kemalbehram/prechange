<?php

namespace App\Http\Requests;
 
use Lang;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Userprofile;
use Validator;

class ProfileRequest extends FormRequest
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
        $userprofile = Userprofile::where('user_id', Auth::id() )->first();       

        $rules = [
            'fname' => 'required|regex:/^[\pL\s\-]+$/u|between:4,25', 
            'lname' => 'required|regex:/^[\pL\s\-]+$/u', 
            'country' => 'required', 
        ];        

   
        Validator::extend('checkmobilenumber', function ($attribute, $value, $parameters, $validator) {        
               if ( strlen(Input::get('mobile')) <= 6 || strlen(Input::get('mobile')) > 15)
               {
                    return FALSE;
               }
               return TRUE;            
        });    
        $rules['mobile'] = 'required|numeric|checkmobilenumber';
       

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'fname.required' => "First Name field is required",  
            'fname.regex' => "First Name must contain letters", 
            'fname.between' => "First Name must be :min and :max characters", 

            'lname.required' => "Last Name field is required",  
            'lname.regex' => "Last Name must contain letters",  
            'lname.between' => "Last Name must be :min and :max characters",

            'mobile.required' => "Phone Number field is required ",
            'mobile.checkmobilenumber' => "Invalid Mobile Number"
        ];
    }


}
