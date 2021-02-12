<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'heading'     => 'required',
            'description' => 'required',
            // 'language'    => 'required',
        ];
    }

     /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function message()
    {
        return [
            'heading.required' => 'Name is required',
            'description.required' => 'Description is required',
        ];
    }
}
