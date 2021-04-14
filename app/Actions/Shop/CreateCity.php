<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\City;

use Illuminate\Support\Arr;

class CreateCity extends Action
{
    /**
     * Create a new action instance
     *
     * @param City $model
     * @return void
     */
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve City if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|City
     */
    public function execute(array &$data): ?City
    {
        if (!Arr::exists($data, 'city_name') || !Arr::exists($data, 'county_id'))
            return null;

        $city = $this->model->firstOrCreate([
            'name'          => $data['city_name'],
            'county_id'     => $data['county_id']
        ]);

        $data = Arr::add($data, 'city_id', $city->id);

        return $city;
    }
}
