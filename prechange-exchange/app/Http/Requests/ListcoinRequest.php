<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListcoinRequest extends FormRequest
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
            'coinname' => 'required',
            'ticker' => 'required',
            'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',  
            // 'medialink' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'etherumaddress' => 'required',  
            'extrainfo' => 'required'
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
            'coinname.required' => 'Coin name is required',
            'ticker.required' => 'Ticker is required',
            'website.required' => 'Website is required',
            'medialink.required' => 'Media link is required',
            'etherumaddress.required' => 'Etherum address is required',
            'extrainfo.required' => 'Extra information is required',
            
            
        ];
    }
}
