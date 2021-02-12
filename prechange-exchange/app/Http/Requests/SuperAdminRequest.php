<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Traits\AddressValidate;
use Illuminate\Support\Facades\Input;

class SuperAdminRequest extends FormRequest
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

    public function rules()
    {

    	return [
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {

        return [
            'email.required' => 'Email ID is required',
            'email.email' => 'Invalid Email ID',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be :min characters'
            
        ];
    }


 }