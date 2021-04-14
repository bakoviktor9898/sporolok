<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'shop_id'           => 'required',
            'price'             => 'required',
            'currency_name'     => 'required',
            'quantity'          => 'required',
            'per'               => 'required',
            'manufacturer_name' => 'required',
            'category_name'     => 'required',
            'product_name'      => 'required',
        ];
    }
}
