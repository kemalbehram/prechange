<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class WithdrawRequest extends FormRequest
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
            'amount' => 'required|not_in:0|regex:/^\d+(\.\d{1,5})?$/',
            'toaddress' => 'required',
            // 'external_id' => 'required_if:toaddress,==,3|nullable|integer',
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
            'amount.required' => 'Amount is required',
            'amount.regex' => 'Invalid Amount',
            'amount.not_in' => 'Amount should be greater than zero',
            'toaddress.required' => 'To Wallet Address is required',
            'toaddress.regex' => 'Invalid Address',
            
        ];
    }
}
