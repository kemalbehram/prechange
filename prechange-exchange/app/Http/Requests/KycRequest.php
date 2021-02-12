<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Traits\AddressValidate;
use Illuminate\Support\Facades\Input;

class KycRequest extends FormRequest
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

    use AddressValidate;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        // dd(Input::get('todaddress'));
        Validator::extend('validateaddress', function ($attribute, $value, $parameters, $validator) {
           // dd(Input::get('todaddress'));

               $toAddress   = $this->protect(Input::get('todaddress'));

               $toAddress   = $this->validateBtc($toAddress);

               //dd($toAddress);
               if ($toAddress == 'OK')
               {
                    return TRUE;
               }
               return FALSE;            
        }); 


        

        return [
            'fname' => 'required',
            'lname' => 'required',
            'city' => 'required',
            'address' => 'required',
            'dob' => 'required|date|',
            'country' => 'required',
            'id_type' => 'required',
            'id_number' => 'required', 
            'id_exp' => 'required|date|',
            'front' => 'required|max:10000|mimes:png,jpg,jpeg',
            'back' => 'required|max:10000|mimes:png,jpg,jpeg'
        ];
    }


        /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            'city.required' => 'City is required',
            'address.required' => 'Address is required',
            'dob.required' => 'Date of Birth is required',
            'country.required' => 'Country is  required',
            'id_type.required' => 'Proof of ID Type is required',
            'id_number.required' => 'ID Document Number is required',
            'id_exp.required' => 'Expiry Date is required',
            'front.required' => 'ID Front Document is required',
            'back.required' => 'ID Back Document is required',
            'front.mimes' => 'Only Allowed (png,jpg,jpeg)',
            'back.mimes' => 'Only Allowed (png,jpg,jpeg)',
            
        ];
    }
}
