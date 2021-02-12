<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Traits\AddressValidate;
use App\Traits\UserInfo;
use Illuminate\Support\Facades\Input;
use App\Commission;

class PasswordResetRequest extends FormRequest
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

    use AddressValidate, UserInfo;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'required',
            'password' => 'required|min:8|max:15',
            'password_confirmation' => 'required|min:8|max:15',
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
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be of minimum 8 characters',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.min' => 'Confirm Password must be of minimum 8 characters',
            'password_confirmation.required' => 'Confirm Password is required'
            
        ];
    }
}
