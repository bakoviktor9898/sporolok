<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\Country;

use Illuminate\Support\Arr;

class CreateCountry extends Action
{
    /**
     * Create a new action instance
     *
     * @param Country $model
     * @return void
     */
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve country if exists in the database,
     * create if not.
     * Add country_id to data array
     *
     * @param array $data
     * @return null|Country
     */
    public function execute(array &$data): ?Country
    {
        if (!Arr::exists($data, 'country_name') || !Arr::exists($data, 'country_code'))
            return null;

        $country = $this->model->firstOrCreate([
            'name'  => $data['country_name'],
            'code'  => $data['country_code']
        ]);

        $data = Arr::add($data, 'country_id', $country->id);

        return $country;
    }
}
