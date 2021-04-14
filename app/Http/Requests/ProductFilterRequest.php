<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'q'             => 'nullable',
            'latest'        => 'nullable',
            'category'      => 'nullable',
            'manufacturer'  => 'nullable',
            'priceFrom'     => 'nullable',
            'priceTo'       => 'nullable'
        ];
    }
}
