<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateProductRequest extends FormRequest
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
            'productName'               =>'required|string',
            'manufacturerName'          =>'required|string',
            'manufacturerShortName'     =>'nullable|string',
            'categoryName'              =>'required|string',
            'currency'                  =>'required|string',
            'price'                     =>'required',
            'per'                       =>'required|string',
            'quantity'                  =>'required|integer',
            'shop_id'                   =>'required',
            'price_id'                  =>'required',
            'product_id'                =>'required'
        ];
    }
}
