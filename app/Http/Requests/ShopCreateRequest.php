<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopCreateRequest extends FormRequest
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
            'here_map_id'   => 'required|string',
            'street'        => 'required|string',
            'house'         => 'required|string',
            'lat'           => 'required|numeric',
            'lng'           => 'required|numeric',
            'postal_code'   => 'required',
            'city_name'     => 'required|string',
            'county_name'   => 'required|string',
            'state_name'    => 'required|string',
            'country_name'  => 'required|string',
            'country_code'  => 'required|string',
            'name'          => 'required|string'
        ];
    }
}
