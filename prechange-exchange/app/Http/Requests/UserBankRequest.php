<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Traits\AddressValidate;
use Illuminate\Support\Facades\Input;

class UserBankRequest extends FormRequest
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
            'acc_name' => 'required',
            'acc_no' => 'required',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'bank_address' => 'required',
            'swift_code' => 'required'
        ];
    }

    public function messages()
    {

        return [
            'acc_name.required' => 'Account Name is required',
            'acc_no.required' => 'Account Number is required',
            'bank_name.required' => 'Bank Name is required',
            'bank_branch.required' => 'Bank Branch is required',
            'bank_address.required' => 'Bank Address is required',
            'swift_code.required' => 'Swift code is  required'
            
        ];
    }


 }