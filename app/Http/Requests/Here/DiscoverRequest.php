<?php

namespace App\Http\Requests\Here;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class DiscoverRequest extends FormRequest
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
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        $lat = session()->get('position')
            ? session()->get('position')['lat']
            : '';

        $lng = session()->get('position')
            ? session()->get('position')['lng']
            : '';

        $data = array_merge($this->all(), [
            'apiKey' => config('here.api_key')
        ]);

        if ($lat && $lng) {
            $data = array_merge($data, [
                'lat' => $lat,
                'lng' => $lng
            ]);
        }

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q'         => 'required|string',
            'lat'       => 'nullable',
            'lng'       => 'nullable',
            'apiKey'    => 'required'
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        // Insert at key to validated data, as it is
        // required by the HERE Discover API
        $validated = parent::validated();

        if (Arr::has($validated, ['lat', 'lng'])) {
            // Add custom key to validated array created from lat and lng
            $validated = array_merge($validated, [
                'at' => $validated['lat'] . ',' . $validated['lng']
            ]);

            // Remove unused lat and lng items from array
            unset($validated['lat']);
            unset($validated['lng']);
        }

        return $validated;
    }
}
